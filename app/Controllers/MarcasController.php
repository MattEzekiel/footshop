<?php

namespace App\Controllers;

use App\Models\Marca;
use App\View;

class MarcasController
{
    public static function index()
    {
        $marca = new Marca();
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

        $marcas = $marca
            ->withPagination(6)
            ->todo($condiciones);
        $pagination = $marca->getPagination();

        $view = new View();
        $view->render('marcas/index', ['marcas' => $marcas, 'pagination' => $pagination]);
    }
}