<?php

namespace App\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use App\Router;
use App\View;

class TiendaController
{
    public static function index()
    {
        $producto = new Producto();
        $productos = $producto->todo();
        $view = new View();
        $view->render('tienda/index', ['productos' => $productos]);
    }

    public static function detalle()
    {
        $parametros = Router::getRouteParameters();
        $producto = new Producto();
        $producto = $producto->getByPk($parametros['id']);
        $prodMarca = $producto->getIdMarca();
        $marca = new Marca();
        $marca = $marca->getById($prodMarca);
        $view = new View();
        $view->render('tienda/detalle', ['producto' => $producto, 'marca' => $marca]);
    }
}