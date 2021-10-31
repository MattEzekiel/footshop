<?php

namespace App\Models;

use App\DB\Connection;
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
     * @return static[]
     */
    public function todo() : array
    {
        $db = Connection::getConnection();
        $query = "SELECT * FROM " .$this->tabla;
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, static::class);
        return $stmt->fetchAll();
    }

    /**
     * @param int $id
     * @return static|null
     */
    public function getByPk(int $id): ? Modelo
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

        return $modelo;
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
}