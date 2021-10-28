<?php

namespace App\Controllers;

use App\Models\Influencers;
use App\Models\Producto;
use App\View;

class InicioController
{
    public static function index()
    {
        $productos = new Producto();
        $numeros = $productos->countRows();
        $numeroAleatoreo = rand(1, $numeros);
        $producto = $productos->getByPk($numeroAleatoreo);

        $influencer = new Influencers();
        $influencers = $influencer->randomHome();

        $view = new View();
        $view->render('inicio', ['producto' => $producto, 'influencers' => $influencers]);
    }

    public static function influencers()
    {
        $influencer = new Influencers();
        $influencers = $influencer->todos();
        $view = new View();
        $view->render('influencers', ['influencers' => $influencers]);
    }

    public static function sobreNosotros()
    {
        $view = new View();
        $view->render('sobre-nosotros', ['titulo' => 'About us']);
    }

    public static function error404()
    {
        $view = new View();
        $view->render('404', ['Titulo' => 'Error 404']);
    }
}
