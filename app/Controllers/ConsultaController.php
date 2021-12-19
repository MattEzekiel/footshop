<?php

namespace App\Controllers;

use App\Models\Contacto;
use App\View;

class ConsultaController
{
    public static function index()
    {
        $consulta = new Contacto();
        $buscarValores = [];
        $condiciones = [];

        if (!empty($_GET['asunto'])){
            $buscarValores['asunto'] = $_GET['asunto'];
            $condiciones[] = ['asunto','LIKE','%' . $_GET['asunto'] . '%'];
        }

        $consultas = $consulta
            ->withPagination(6)
            ->todo($condiciones);
        $pagination = $consulta->getPagination();

        $view = new View();
        $view->render('consultas/index', ['consultas' => $consultas, 'pagination' => $pagination ,'buscarValores' => $buscarValores]);
    }
}