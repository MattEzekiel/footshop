<?php

namespace App\Models;

use App\DB\Connection;

class Producto extends Modelo
{
    protected $tabla = 'zapatillas';
    protected $primaryKey = 'id_zapatilla';
    protected $atributos = ['nombre','descripcion','precio'];

    protected $id_zapatilla;
    protected $nombre;
    protected $descripcion;
    protected $precio;
    protected $imagen;
    protected $imagen_alt;


    /**
     * @return int
     */
    public function countRows(): int
    {
        $db = Connection::getConnection();
        $query = "SELECT * FROM zapatillas";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * @return mixed
     */
    public function getIdZapatilla()
    {
        return $this->id_zapatilla;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->imagen;
    }

    /**
     * @return mixed
     */
    public function getImgAlt()
    {
        return $this->imagen_alt;
    }
}