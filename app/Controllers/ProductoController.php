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
        $view->render('productos/index', ['productos' => $productos, 'marcas' => $marcas, 'pagination' => $pagination]);
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

    public static function editarForm()
    {
        $oldData = Session::flash('old_data',[]);
        $errores = Session::flash('message',[]);
        $parametros = Router::getRouteParameters();
        $producto = new Producto();
        $producto = $producto->getByPk($parametros['id']);
        $marcas = (new Marca())->todo();
        $view = new View();
        $view->render('productos/form-editar', ['producto' => $producto, 'marcas' => $marcas, 'errores' => $errores, 'oldData' => $oldData]);
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

    public static function editar()
    {
        $id_zapatilla = $_POST['id_zapatilla'];

        $validador = new Validator($_POST,[
            'nombre' => ['required','min:3'],
            'descripcion' => ['required','min:11'],
            'precio' => ['required','numeric'],
            'id_marca' => ['required','numeric'],
            'id_zapatilla' => ['required','numeric'],
        ]);

        if($validador->fails()){
            Session::set('old_data', $_POST);
            Session::set('error',"alert-danger");
            Session::set('message',$validador->getErrores());
            Router::redirect('/productos/editar/' . $id_zapatilla);
        }

        $nombre = $_POST['nombre'];

        $datos = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'precio' => $_POST['precio'],
            'imagen_alt' => 'Zapatillas ' . $nombre,
            'id_marca' => $_POST['id_marca'],
        ];

        $imagen = $_FILES['imagen'];
        if (!empty($imagen['tmp_name'])){
            $uploader = new SubirArchivo($_FILES['imagen']);
            $datos['imagen'] = $uploader->guardar(realpath(Router::publicPath('/imgs/')));
        } else {
            $datos['imagen'] = (new Producto())->getByPk($id_zapatilla)->getImg();
        }

        try {
            (new Producto())->editar((int)$id_zapatilla,$datos);
            Session::set('message', "La zapatilla fue editada satisfactoriamente");
            Session::set('success', "alert-success");
            Router::redirect('/productos');
        } catch (\Exception $e) {
            Session::set('old_data', $_POST);
            Session::set('message', "Hubo un error al intentar editar la zapatilla. Pruebe de nuevo más tarde");
            Session::set('error', "alert-danger");
            Router::redirect('/productos/editar/' . $id_zapatilla);
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
