<?php

namespace App\Controllers;

use App\Models\Marca;
use App\Router;
use App\Session\Session;
use App\Validation\Validator;
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
            ->withPagination(10)
            ->todo($condiciones);
        $pagination = $marca->getPagination();

        $view = new View();
        $view->render('marcas/index', ['marcas' => $marcas, 'pagination' => $pagination]);
    }

    public static function nuevoForm()
    {
        $oldData = Session::flash('old_data',[]);
        $errores = Session::flash('message',[]);
        $marcas = (new Marca())->todo();
        $view = new View();
        $view->render('marcas/form-crear', ['marcas' => $marcas, 'errores' => $errores, 'oldData' => $oldData]);
    }

    public static function nuevaMarca()
    {
        $validador = new Validator($_POST,[
            'nombre' => ['required','min:1'],
        ]);

        if($validador->fails()){
            Session::set('old_data', $_POST);
            Session::set('error',"alert-danger");
            Session::set('message',$validador->getErrores());
            Router::redirect('/marcas/nuevo');
        }


        $datos = [
            'nombre' => $_POST['nombre'],
        ];

        try {
            (new Marca())->crear($datos);

            Session::set('message', "Su marca ha sido ingresado con éxito");
            Session::set('success', "alert-success");
            Session::delete('old_data');

            Router::redirect('marcas');

        }catch (\Exception $e) {
            Session::set('old_data',$_POST);
            Session::set('messasge',"Hubo un error al momento de generar su marca. Pruebe de nuevo más tarde");
            Session::set('error',"alert-danger");
            Router::redirect('/marcas/nuevo');
            exit;
        }

    }

    public static function editarForm()
    {
        $parametros = Router::getRouteParameters();
        $oldData = Session::flash('old_data',[]);
        $errores = Session::flash('message',[]);
        $marca = new Marca();
        $marca = $marca->getByPk($parametros['id']);
        $view = new View();
        $view->render('marcas/form-editar', ['marca' => $marca, 'errores' => $errores, 'oldData' => $oldData]);
    }

    public static function editar()
    {
        $id_marca = $_POST['id_marca'];

        $validador = new Validator($_POST,[
            'nombre' => ['required','min:1'],
        ]);

        if($validador->fails()){
            Session::set('old_data', $_POST);
            Session::set('error',"alert-danger");
            Session::set('message',$validador->getErrores());
            Router::redirect('/marcas/editar/' . $id_marca);
        }

        $datos = [
            'nombre' => $_POST['nombre'],
        ];

        try {
            (new Marca())->editar((int)$id_marca,$datos);
            Session::set('message', "La marca ha sido editada satisfactoriamente");
            Session::set('success', "alert-success");
            Router::redirect('/marcas');
        } catch (\Exception $e) {
            Session::set('old_data', $_POST);
            Session::set('message', "Hubo un error al intentar editar la marca. Pruebe de nuevo más tarde");
            Session::set('error', "alert-danger");
            Router::redirect('/marcas/editar/' . $id_marca);
        }
    }

    public static function eliminar()
    {
        $parametros = Router::getRouteParameters();

        try {
            (new Marca())->delete($parametros['id']);
            Session::set('message', "La marca fue eliminada de la base de datos");
            Session::set('success', "alert-success");
            Router::redirect('/marcas');
        } catch (\Exception $e) {
            Session::set('message', "Hubo un error al intentar eliminar la marca. Pruebe de nuevo más tarde");
            Session::set('error', "alert-danger");
            Router::redirect('/marcas');
        }
    }
}