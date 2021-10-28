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
}
