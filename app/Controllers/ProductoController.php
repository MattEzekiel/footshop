<?php

namespace App\Controllers;

use App\Models\Producto;
use App\Router;
use App\View;

class ProductoController
{
    public static function index()
    {
        $producto = new Producto();
        $productos = $producto->todo();
        $view = new View();
        $view->render('productos/index', ['productos' => $productos]);
    }

    public static function nuevoForm()
    {
        $view = new View();
        $view->render('productos/form-crear');
    }

    public static function ver()
    {
        $parametros = Router::getRouteParameters();
        $producto = new Producto();
        $producto = $producto->getByPk($parametros['id']);
        $view = new View();
        $view->render('productos/detalle', ['producto' => $producto]);
    }

    public static function nuevoProducto()
    {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        self::confirmarNombre($nombre);
        self::confirmarPrecio($precio);
        self::confirmarDescripcion($descripcion);
        self::errores();

        $datos = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
        ];

        try {
            (new Producto())->crear($datos);

            $_SESSION['message'] = "Su producto ha sido ingresado con éxito";
            $_SESSION['success'] = "alert-success";
            unset($_SESSION['old_data']);

            Router::redirect('productos');

        }catch (\Exception $e) {

            $_SESSION['old_data'] = $_POST;
            $_SESSION['message'] = "Hubo un error al momento de generar su producto. Pruebe de nuevo más tarde";
            $_SESSION['error'] = "alert-danger";
            Router::redirect('/productos/nuevo');
            exit;
        }

        }

    /**
     * @param $nombre
     */
    public static function confirmarNombre($nombre)
    {
        if(strlen(trim($nombre)) < 3){
            $_SESSION['nombre'] = "El nombre del producto es demasiado corto.";
        }
    }

    /**
     * @param $precio
     */
    public static function confirmarPrecio($precio){
        if (!is_numeric($precio)){
            $_SESSION['precio'] = "El precio debe ser un número.";
        }
    }

    /**
     * @param $descripcion
     */
    public static function confirmarDescripcion($descripcion)
    {
        if(strlen(trim($descripcion)) < 11){
            $_SESSION['descripcion'] = "La descripción es demasiado corta.";
        }
    }

    public static function errores()
    {
        if(isset($_SESSION['nombre']) || isset($_SESSION['precio']) || isset($_SESSION['descripcion'])){
            $_SESSION['old_data'] = $_POST;
            $_SESSION['message'] = "Hubieron errores al momento de generar su producto";
            $_SESSION['error'] = "alert-danger";
            Router::redirect('/productos/nuevo');
            exit;
        }
    }

}
