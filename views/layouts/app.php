<?php
/** @var string $content */

use App\Auth\Auth;
use App\Router;
use App\Session\Session;

$success = Session::flash('success');
$error = Session::flash('error');
$message = Session::flash('message');

$auth = new Auth();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Foot Shop</title>
    <link href="<?= Router::urlTo('css/bootstrap.min.css') ;?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= Router::urlTo('css/estilos.css') ;?>">
    <link rel="shortcut icon" href="<?= Router::urlTo('/imgs/logo-black-mini.png') ;?>" type="image/x-icon">
    <link rel="icon" href="<?= Router::urlTo('/imgs/logo-black-mini.png') ;?>" type="image/x-icon">
</head>
<body>
    <nav id="thenav" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= Router::urlTo('/') ;?>">FOOTSHOP <img class="img-fluid" src="<?= Router::urlTo('/imgs/') ;?>logo-black-mini.png" alt="Logo Foot SHop"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Abrir/cerrar menú de navegación">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Router::urlTo('/') ;?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Router::urlTo('/sobre-nosotros') ;?>">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Router::urlTo('/influencers') ;?>">Influencers</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Router::urlTo('tienda') ;?>" class="nav-link">Tienda</a>
                    </li>
                    <?php
                        if($auth->isAutenticado()):
                    ?>
                    <li class="nav-item">
                       <a class="nav-link" href="<?= Router::urlTo('productos') ;?>">Listado de Productos</a>
                    </li>
                    <?php
                        endif;
                    ?>
                    <li class="nav-item"><a href="<?= Router::urlTo('contacto') ;?>" class="nav-link">Contacto</a></li>
                    <li class="navbar-nav float-end ms-lg-auto">
                        <ul class="list-unstyled navbar-nav float-end ms-lg-auto">
                            <?php
                            if ($auth->isAutenticado()):
                                ?>
                                <li class="nav-item">
                                    <form action="<?= Router::urlTo('cerrar-sesion') ;?>" method="post">
                                        <button class="btn nav-link" type="submit">Cerrar Sesión (<?= $auth->getUsuario()->getNombre() . " " . $auth->getUsuario()->getApellido() ;?>)</button>
                                    </form>
                                </li>
                            <?php
                            else:
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= Router::urlTo('iniciar-sesion') ;?>">Iniciar Sesión</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= Router::urlTo('registro') ;?>">Registrarse</a>
                                </li>
                            <?php
                            endif;
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
        if($message):
    ?>
    <div class="container-fluid">
        <div class="alert py-3 m-0 h-100 <?= $success ? $success : $error;?>" role="alert">
            <p class="text-center"><?= $message ;?></p>
        </div>
    </div>
    <?php
        endif;
    ?>
    <?php echo $content; ?>
    <footer class="bg-dark py-5">
        <p class="text-center text-white">Todos los derechos reservados FootShop&copy; 2021</p>
    </footer>
    <script src="<?= Router::urlTo('/js/bootstrap.bundle.js') ;?>"></script>
    <script src="<?= Router::urlTo('js/boostrap.js') ;?>"></script>
</body>
</html>
