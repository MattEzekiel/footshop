<?php

namespace App\Controllers;

use App\Auth\Auth;
use App\Models\Usuario;
use App\View;

class AuthController
{
    public static function loginForm()
    {
        $view = new View();
        $view->render('auth/login');
    }

    public static function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $auth = new Auth();

        if(!$auth->login(['email' => $email, 'password' => $password])){
            $_SESSION['old_data'] = $_POST;
            $_SESSION['error'] = "alert-danger";
            $_SESSION['message'] = "Fallo al iniciar sesión. No se ha encontrado su usuario en nuestra base de datos.";
            header('Location: iniciar-sesion');
            exit;
        }

        $_SESSION['success'] = "alert-success";
        $_SESSION['message'] = "¡Bienvenido " . $auth->getUsuario()->getNombre() . " " . $auth->getUsuario()->getApellido() . "!";
        header('Location: productos');
        exit;
    }

    public static function logout()
    {
        $auth = new Auth();

        $auth->logout();

        $_SESSION['success'] = "alert-success";
        $_SESSION['message'] = "¡Sesión cerrada exitosamente!";
        header('Location: iniciar-sesion');
    }

    public static function registroForm()
    {
        $view = new View();
        $view->render('auth/registro');
    }

    public static function registro()
    {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        self::confirmNombre($nombre);
        self::confirmApellido($apellido);
        self::confirmEmail($email);
        self::confirmPassword($password);
        self::confirmPasswordTwo($password_confirm,$password);

        self::errores();

        $usuario = new Usuario();
        $usuario = $usuario->crear([
           'nombre' => $nombre,
           'apellido' => $apellido,
           'email' => $email,
           'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        if($usuario === null){
            $_SESSION['old_data'] = $_POST;
            $_SESSION['message'] = "Ocurrió un error al momento de generar su usuario";
            $_SESSION['error'] = "alert-danger";

            header('Location: registro');
            exit;
        }

        $auth = new Auth();
        var_dump($usuario);
        $auth->autenticar($usuario);

        $_SESSION['message'] = "Su usuario ha sido creado exitosamente";
        $_SESSION['success'] = "alert-success";

        header('Location: productos');
        exit;
    }

    public static function errores()
    {
        if(isset($_SESSION['nombre-registro']) || isset($_SESSION['apellido-registro']) || isset($_SESSION['email-registro']) || isset($_SESSION['password-confirm']) || isset($_SESSION['password-registro'])){
            $_SESSION['old_data'] = $_POST;
            $_SESSION['message'] = "Ocurrió un error al momento de generar su consulta";
            $_SESSION['error'] = "alert-danger";
            header('Location: registro');
            exit;
        }else{
            return null;
        }
    }

    /**
     * @param string $nombre
     */
    public static function confirmNombre(string $nombre){
        if(strlen(trim($nombre)) < 3){
            $_SESSION['nombre-registro'] = "El nombre es demasiado corto";
        }
    }

    /**
     * @param string $apellido
     */
    public static function confirmApellido(string $apellido){
        if(strlen(trim($apellido)) < 3){
            $_SESSION['apellido-registro'] = "El apellido es demasiado corto.";
        }
    }

    /**
     * @param string $email
     */
    public static function confirmEmail(string $email){
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $_SESSION['email-registro'] = "Su email no es válido";
        }
    }

    /**
     * @param string $password
     */
    public static function confirmPassword(string $password){
        if(strlen(trim($password)) < 4){
            $_SESSION['password-registro'] = "Su contraseña es demasiado corta";
        }
    }

    /**
     * @param string $passoword_confirm
     * @param string $password
     */
    public static function confirmPasswordTwo(string $passoword_confirm, string $password){
        if($password !== $passoword_confirm){
            $_SESSION['password-confirm'] = "Las contraseñas no coinciden";
        }
    }
}
