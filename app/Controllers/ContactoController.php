<?php

namespace App\Controllers;

use App\Models\Contacto;
use App\View;

class ContactoController
{
    /**
     * @view Contacto
     */
    public static function index()
    {
        $view = new View();
        $view->render('contacto/index', ['titulo' => 'Pagina de Contacto']);
    }

    /**
     * Consulta a base de datos
     */
    public static function sendContact()
    {
        $nombre = $_POST['nombre'];
        $asunto = $_POST['asunto'];
        $email = $_POST['email'];
        $consulta = $_POST['consulta'];

        self::confirmarNombre($nombre);
        self::confirmarAsunto($asunto);
        self::confirmarEmail($email);
        self::confirmarConsulta($consulta);
        self::errores();


        $contacto = new Contacto();
        $contacto->enviarConsulta([
            'nombre' => $nombre,
            'asunto' => $asunto,
            'email' => $email,
            'consulta' => $consulta,
            'usuario_id' => $_SESSION['id_usuario'] ?? null,
        ]);

        if($contacto === null){
            self::errores();
        }

        $_SESSION['message'] = "Su consulta ha sido enviada con éxito";
        $_SESSION['success'] = "alert-success";
        unset($_SESSION['old_data']);

        header('Location: contacto');
        exit;
    }


    /**
     * Errores viejo
     */
    public static function errores()
    {
        if(isset($_SESSION['nombre-contacto']) || isset($_SESSION['asunto']) || isset($_SESSION['email-contacto']) || isset($_SESSION['consulta'])){
            $_SESSION['old_data'] = $_POST;
            $_SESSION['message'] = "Ocurrió un error al momento de generar su consulta";
            $_SESSION['error'] = "alert-danger";
            header('Location: contacto');
            exit;
        }
    }

    public static function confirmarNombre(string $nombre)
    {
        if(strlen(trim($nombre)) < 3){
            $_SESSION['nombre-contacto'] = "El nombre es demasiado corto";
        }
    }

    public static function confirmarAsunto(string $asunto){
        if(strlen(trim($asunto)) < 4){
            $_SESSION['asunto'] = "El motivo de su consulta es demasiado corto.";
        }
    }

    public static function confirmarEmail(string $email)
    {
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $_SESSION['email-contacto'] = "Su email no es válido";
        }
    }

    public static function confirmarConsulta(string $consulta)
    {
        if(strlen(trim($consulta)) < 6){
            $_SESSION['consulta'] = "Su consulta es demasiado corta y podría considerarse spam.";
        }
    }
}