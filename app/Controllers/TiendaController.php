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
        $buscarValores = [];
        $condiciones = [];

        if (!empty($_GET['nombre'])){
            $buscarValores['nombre'] = $_GET['nombre'];
            $condiciones[] = ['nombre','LIKE','%' . $_GET['nombre'] . '%'];
        }
        if (!empty($_GET['id_marca'])){
            $buscarValores['id_marca'] = $_GET['id_marca'];
            $condiciones[] = ['id_marca','=',$_GET['id_marca']];
        }

        $productos = $producto
            ->withPagination(6)
            ->todo($condiciones);
        $pagination = $producto->getPagination();
        $marcas = (new Marca())->todo();
        $view = new View();
        $view->render('tienda/index', ['productos' => $productos, 'pagination' => $pagination, 'marcas' => $marcas,'buscarValores' => $buscarValores]);
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