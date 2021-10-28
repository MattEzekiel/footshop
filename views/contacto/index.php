<?php
/**
 * Página de contacto
 */

use App\Auth\Auth;
use App\Models\Usuario;
use App\Router;

$nombre = $_SESSION['nombre-contacto'] ?? null;
$asunto = $_SESSION['asunto'] ?? null;
$email = $_SESSION['email-contacto'] ?? null;
$consulta = $_SESSION['consulta'] ?? null;

$auth = new Auth();
$usuario = new Usuario();

unset($_SESSION['nombre-contacto'],$_SESSION['asunto'],$_SESSION['email-contacto'],$_SESSION['consulta']);

?>
<main id="contacto" class="container-fluid">
    <div class="container py-lg-5 my-3">
        <h1 class="text-uppercase">Contacto</h1>
        <form action="<?= Router::urlTo('enviar-contacto') ;?>" method="post" class="mt-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Ingrese su Nombre <sup>* <span class="visually-hidden">Campo requerido</span></sup></label>
                        <input
                                type="text"
                                name="nombre"
                                id="nombre"
                                placeholder="Ingrese su nombre"
                                class="form-control"
                            <?php
                                if($auth->isAutenticado()):
                            ?>
                                value="<?= $auth->getUsuario()->getNombre() . " " . $auth->getUsuario()->getApellido() ;?>"
                            <?php
                                else:
                            ?>
                                value="<?= $_SESSION['old_data']['nombre'] ?? '' ;?>"
                            <?php
                                endif;
                            ?>
                            <?php
                                if (isset($nombre)):
                            ?>
                                aria-describedby="error-nombre"
                            <?php
                                endif;
                            ?>
                        >
                        <small>El nombre debe tener al menos 3 caracteres</small>
                        <?php
                        if (isset($nombre)):
                            ?>
                            <div class="alert alert-danger">
                                <?= $nombre ;?>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="asunto">Ingrese el Asunto <sup>* <span class="visually-hidden">Campo requerido</span></sup></label>
                        <input type="text" name="asunto" id="asunto" placeholder="Ingrese el asunto de su consulta" class="form-control" value="<?= $_SESSION['old_data']['asunto'] ?? '' ;?>">
                        <small>El asunto debe contener al menos 4 caracteres</small>
                    </div>
                    <?php
                    if (isset($asunto)):
                        ?>
                        <div class="alert alert-danger">
                            <?= $asunto ;?>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Ingrese su Email <sup>* <span class="visually-hidden">Campo requerido</span></sup></label>
                <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Ingrese su email"
                        class="form-control"
                    <?php
                    if($auth->isAutenticado()):
                        ?>
                        value="<?= $auth->getUsuario()->getEmail() ;?>"
                    <?php
                    else:
                        ?>
                        value="<?= $_SESSION['old_data']['email'] ?? '' ;?>"
                    <?php
                    endif;
                    ?>
                >
            </div>
            <?php
            if (isset($email)):
                ?>
                <div class="alert alert-danger">
                    <?= $email ;?>
                </div>
            <?php
            endif;
            ?>
            <div class="form-group">
                <label for="consulta">Su Consulta <sup>* <span class="visually-hidden">Campo requerido</span></sup></label>
                <textarea name="consulta" id="consulta" class="form-control" rows="5"><?= $_SESSION['old_data']['consulta'] ?? '' ;?></textarea>
                <small>Su consulta debe tener al menos 10 caracteres para no ser considerada como spam.</small>
                <?php
                if (isset($consulta)):
                    ?>
                    <div class="alert alert-danger">
                        <?= $consulta ;?>
                    </div>
                <?php
                endif;
                ?>
            </div>
            <button class="btn btn-lg btn-outline-light float-lg-right mt-4" type="submit">Enviar Consulta</button>
        </form>
    </div>
</main>