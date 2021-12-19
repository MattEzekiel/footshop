<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Router;
use App\Session\Session;
use App\Validation\Validator;
use App\View;

class UsuarioController
{
    public static function index()
    {
        $usuario = new Usuario();
        $buscarValores = [];
        $condiciones = [];

        if (!empty($_GET['nombre'])){
            $buscarValores['nombre'] = $_GET['nombre'];
            $condiciones[] = ['nombre','LIKE','%' . $_GET['nombre'] . '%'];
        }

        $usuarios = $usuario
            ->withPagination(6)
            ->todo($condiciones);
        $pagination = $usuario->getPagination();

        $view = new View();
        $view->render('usuarios/index', ['usuarios' => $usuarios, 'pagination' => $pagination ,'buscarValores' => $buscarValores]);
    }

    public static function editarForm()
    {
        $parametros = Router::getRouteParameters();
        $oldData = Session::flash('old_data',[]);
        $errores = Session::flash('message',[]);
        $usuario = new Usuario();
        $usuario = $usuario->getByPk($parametros['id']);
        $view = new View();
        $view->render('usuarios/form-editar', ['usuario' => $usuario, 'errores' => $errores, 'oldData' => $oldData]);
    }

    public static function editar()
    {
        $id_usuario = $_POST['id_usuario'];

        $validador = new Validator($_POST,[
            'nombre' => ['required','min:3'],
            'apellido' => ['required','min:3'],
            'email' => ['required'],
        ]);

        if($validador->fails()){
            Session::set('old_data', $_POST);
            Session::set('error',"alert-danger");
            Session::set('message',$validador->getErrores());
            Router::redirect('/usuarios/editar/' . $id_usuario);
        }

        if ($_POST['password-confirm'] !== $_POST['password']){
            Session::set('old_data', $_POST);
            Session::set('error',"alert-danger");
            Session::set('message',['password_confirm' => ['Las contraseñas no coinciden']]);
            Router::redirect('/usuarios/editar/' . $id_usuario);
        }

        $datos = [
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'email' => $_POST['email'],
            'password' => empty($_POST['password']) ? (new Usuario())->getByPk($id_usuario)->getPassword() : password_hash($_POST['password'],PASSWORD_DEFAULT),
        ];

        try {
            (new Usuario())->editar((int)$id_usuario,$datos);
            Session::set('message', "Sus datos han sido editado satisfactoriamente");
            Session::set('success', "alert-success");
            Router::redirect('/usuarios');
        } catch (\Exception $e) {
            Session::set('old_data', $_POST);
            Session::set('message', "Hubo un error al intentar editar sus datos. Pruebe de nuevo más tarde");
            Session::set('error', "alert-danger");
            Router::redirect('/usuarios/editar/' . $id_usuario);
        }
    }
}