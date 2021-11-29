<?php

namespace App\Controllers;

use App\Files\SubirArchivo;
use App\Models\Marca;
use App\Models\Producto;
use App\Router;
use App\Session\Session;
use App\Validation\Validator;
use App\View;

class ProductoController
{
    public static function index()
    {
        $productos = (new Producto())->todo();
        $view = new View();
        $view->render('productos/index', ['productos' => $productos]);
    }

    public static function nuevoForm()
    {
        $oldData = Session::flash('old_data',[]);
        $errores = Session::flash('message',[]);
        $marcas = (new Marca())->todo();
        $view = new View();
        $view->render('productos/form-crear', ['marcas' => $marcas, 'errores' => $errores, 'oldData' => $oldData]);
    }

    public static function ver()
    {
        $parametros = Router::getRouteParameters();
        $producto = new Producto();
        $producto = $producto->getByPk($parametros['id']);
        $prodMarca = $producto->getIdMarca();
        $marca = new Marca();
        $marca = $marca->getByPk($prodMarca);
        $view = new View();
        $view->render('productos/detalle', ['producto' => $producto, 'marca' => $marca]);
    }

    public static function nuevoProducto()
    {
        $validador = new Validator($_POST,[
            'nombre' => ['required','min:3'],
            'descripcion' => ['required','min:11'],
            'precio' => ['required','numeric'],
            'id_marca' => ['required','numeric'],
        ]);

        if($validador->fails()){
            Session::set('old_data', $_POST);
            Session::set('error',"alert-danger");
            Session::set('message',$validador->getErrores());
            Router::redirect('/productos/nuevo');
        }

        $nombre = $_POST['nombre'];

        $datos = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'precio' => $_POST['precio'],
            'imagen' => '',
            'imagen_alt' => 'Zapatillas ' . $nombre,
            'id_marca' => $_POST['id_marca'],
        ];

        $imagen = $_FILES['imagen'];
        if (!empty($imagen['tmp_name'])){
            $uploader = new SubirArchivo($_FILES['imagen']);
            $datos['imagen'] = $uploader->guardar(realpath(Router::publicPath('/imgs/')));
        } else {
            $validador = new Validator($_POST,[
                'imagen' => ['required'],
            ]);

            if($validador->fails()){
                Session::set('old_data', $_POST);
                Session::set('error',"alert-danger");
                Session::set('message',$validador->getErrores());
                Router::redirect('/productos/nuevo');
            }
        }

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
