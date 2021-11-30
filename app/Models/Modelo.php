<?php

namespace App\Models;

use App\DB\Connection;
use PDO;
use PDOException;

class Modelo
{
    /**
     * @var string
     */
    protected $tabla = "";

    /**
     * @var string
     */
    protected $primaryKey = "";

    /**
     * @var array
     */
    protected $atributos = [];

    /**
     * @var array
     */
    protected $relaciones = [
        '1-1' => [],
        '1-n' => [],
        'n-1' => [],
        'n-n' => [],
    ];

    protected $pagination = [
        'pagination' => false,
        'rows' => null,
        'total' => null,
        'offset' => null,
        'pages' => null,
        'pageNow' => 1,
    ];

    /**
     * @param array $buscar
     * @return static[]
     */
    public function todo(array $buscar = []) : array
    {
        $db = Connection::getConnection();
        $query = "SELECT * FROM " .$this->tabla;
        $buscarValores = [];
        $queryValues = '';
        if (count($buscar) > 0){
            $buscarData = [];
            foreach ($buscar as $buscarItem){
                $buscarData[] = $buscarItem[0] . " " . $buscarItem[1] . " :" . $buscarItem[0];
                $buscarValores[$buscarItem[0]] = $buscarItem[2];
            }
            $queryValues = " WHERE " . implode(" AND ", $buscarData);
            $query .= $queryValues;
        }
        if ($this->pagination['pagination']){
            $this->queryPaginador($queryValues, $buscarValores);
            $query .= " LIMIT " . $this->pagination['offset'] . ', ' . $this->pagination['rows'];
        }
        $stmt = $db->prepare($query);
        $stmt->execute($buscarValores);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, static::class);
        return $stmt->fetchAll();
    }

    /**
     * @param int $rows
     * @return static
     */
    public function withPagination(int $rows): self
    {
        $this->pagination['pagination'] = true;
        $this->pagination['rows'] = $rows;
        $this->pagination['pageNow'] = (int) ($_GET['page'] ?? 1);
        $this->pagination['offset'] = ($rows * $this->pagination['pageNow']) - $rows;
        return $this;
    }

    /**
     * @param string $query
     * @param array $values
     */
    protected function queryPaginador(string $query = "", array $values = [])
    {
        $db = Connection::getConnection();
        $query = "SELECT COUNT(*) AS total FROM ". $this->tabla . " " . $query;
        $stmt = $db->prepare($query);
        $stmt->execute($values);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->pagination['total'] = $resultado['total'];
        $this->pagination['pages'] = ceil($resultado['total'] / $this->pagination['rows']);
    }

    /**
     * @param int $id
     * @param array $relaciones
     * @return static|null
     */
    public function getByPk(int $id, array $relaciones = []): ? Modelo
    {
        $db = Connection::getConnection();
        $query = "SELECT * FROM " . $this->tabla . "
                   WHERE " . $this->primaryKey . " = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS,static::class);
        $modelo = $stmt->fetch();

        if(!$modelo){
            return null;
        }

        $modelo->cargarRelaciones($relaciones);

        return $modelo;
    }

    /**
     * @param array $relations
     */
    public function cargarRelaciones(array $relations = [])
    {
        foreach($relations as $relation) {
            if(isset($this->relations['n-1'][$relation])) {
                $relationData = $this->relations['n-1'][$relation];
                /** @var Modelo $relationObj */
                $relationObj = new $relation;
                $fk = $this->{$relationData['fk']};
                $obj = $relationObj->getByPk($fk);
                $this->{$relationData['prop']} = $obj;
            }
        }
    }

    /**
     * @param $datos
     * @throws PDOException
     */
    public function crear($datos)
    {
        $db = Connection::getConnection();

        $setCampos = $this->getCampos($datos);
        $insertHolders = array_fill(0,count($setCampos),'?');
        $insertValores = $this->getValores($setCampos, $datos);

        $listaCampos = implode(', ', $setCampos);
        $listaHolders = implode(', ', $insertHolders);

        $query = "INSERT INTO " . $this->tabla . " (". $listaCampos . ")
                    VALUES (". $listaHolders . ")";
        $stmt = $db->prepare($query);
        $stmt->execute($insertValores);
    }

    /**
     * @param array $datos
     * @return array
     */
    protected function getCampos(array $datos): array
    {
        $campos = [];
        foreach ($datos as $key => $valores){
            if(in_array($key,$this->atributos)){
                $campos[] =  $key;
            }
        }
        return $campos;
    }

    /**
     * @param array $campos
     * @param array $data
     * @return array
     */
    protected function getValores(array $campos, array $data): array
    {
        $valores = [];
        foreach ($campos as $campo){
            $valores[] = $data[$campo];
        }
        return $valores;
    }

    /**
     * @param $pk
     * @throws PDOException
     */
    public function delete($pk): void
    {
        $db = Connection::getConnection();
        $query = "DELETE FROM " . $this->tabla . "
                  WHERE " . $this->primaryKey . " = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$pk]);
    }

    public function getPagination(): array
    {
        return $this->pagination;
    }
}