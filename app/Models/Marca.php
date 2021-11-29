<?php

namespace App\Models;


use App\DB\Connection;

class Marca extends Modelo
{
    protected $tabla = "marcas";
    protected $primaryKey = "id_marca";
    protected $atributos = ["nombre"];

    /**
     * @var int
     */
    protected $id_marca;

    /**
     * @var string
     */
    protected $nombre;


    /**
     * @param int $id
     * @return \App\Models\Marca|null
     */
    public function getById(int $id): ? Marca
    {
        $db = Connection::getConnection();
        $query = "SELECT * FROM marcas
                   WHERE id_marca = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();
    }

    /**
     * @return int
     */
    public function getIdMarca(): int
    {
        return $this->id_marca;
    }

    /**
     * @param int $id_marca
     */
    public function setIdMarca(int $id_marca): void
    {
        $this->id_marca = $id_marca;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
}
