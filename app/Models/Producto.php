<?php

namespace App\Models;

use App\DB\Connection;

class Producto extends Modelo
{
    protected $tabla = 'zapatillas';
    protected $primaryKey = 'id_zapatilla';
    protected $atributos = ['id_marca','nombre','descripcion','precio','imagen','imagen_alt'];
    protected $relaciones = [
        'n-1' => [
            Marca::class => [
                'fk' => 'id_marca',
                'prop' => 'marca',
            ],
        ]
    ];

    protected $id_zapatilla;
    protected $nombre;
    protected $descripcion;
    protected $precio;
    protected $imagen;
    protected $imagen_alt;
    protected $id_marca;

    /**
     * @var Marca
     */
    protected $marca;


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
     * @return int last ID
     */
    public function lastId(): int
    {
        $db = Connection::getConnection();
        $query = "SELECT MAX(id_zapatilla) FROM " . $this->tabla;
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * @param int $pk
     * @param array $data
     * @return void
     */
    public function editar(int $pk, array $data)
    {
        $db = Connection::getConnection();
        $query = "UPDATE zapatillas 
                  SET nombre = :nombre, descripcion = :descripcion, precio = :precio, imagen = :imagen, imagen_alt = :imagen_alt, id_marca = :id_marca
                  WHERE id_zapatilla = " . $pk;
        $stmt = $db->prepare($query);
        $stmt->execute([
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'precio' => $data['precio'],
            'imagen' => $data['imagen'],
            'imagen_alt' => $data['imagen_alt'],
            'id_marca' => $data['id_marca'],
        ]);
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

    /**
     * @return Marca
     */
    public function getMarca(): Marca
    {
        return $this->marca;
    }

    /**
     * @return mixed
     */
    public function getIdMarca()
    {
        return $this->id_marca;
    }

    /**
     * @param Marca $marca
     */
    public function setMarca(Marca $marca): void
    {
        $this->marca = $marca;
    }

}