<?php

namespace App\Controllers;

use App\Models\Producto;
use App\Router;
use App\Session\Session;
use App\Validation\Validator;
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
        $oldData = Session::flash('old_data',[]);

        /**
         * @var {String} Errores = Message
         */
        $errores = Session::flash('message',[]);

        $view = new View();
        $view->render('productos/form-crear', ['errores' => $errores, 'oldData' => $oldData]);
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
        $validador = new Validator($_POST,[
            'nombre' => ['required','min:3'],
            'descripcion' => ['required','min:11'],
            'precio' => ['required','numeric'],
        ]);

        if($validador->fails()){
            Session::set('old_data', $_POST);
            Session::set('error',"alert-danger");
            Session::set('message',$validador->getErrores());
            Router::redirect('/productos/nuevo');
        }

        $datos = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'precio' => $_POST['precio'],
        ];

        try {
            (new Producto())->crear($datos);

            Session::set('message', "Su producto ha sido ingresado con éxito");
            Session::set('success', "alert-success");
            Session::delete('old_data');

            Router::redirect('productos');

        }catch (\Exception $e) {
            Session::set('old_data',$_POST);
            Session::set('messasge',"Hubo un error al momento de generar su producto. Pruebe de nuevo más tarde");
            Session::set('error',"alert-danger");
            Router::redirect('/productos/nuevo');
            exit;
        }

    }

    public static function eliminar()
    {
        $parametros = Router::getRouteParameters();

        try {
            (new Producto())->delete($parametros['id']);

            Session::set('message', "La zapatilla fue borrada de la base de datos");
            Session::set('success', "alert-success");
            Router::redirect('/productos');
        } catch (\Exception $e) {
            Session::set('message', "Hubo un error al intentar borrar la zapatilla. Pruebe de nuevo más tarde");
            Session::set('error', "alert-danger");
            Router::redirect('/productos');
        }
    }

}
