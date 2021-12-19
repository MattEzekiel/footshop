<?php

/**
 * @var array $errors
 * @var array $oldData
 * @var Usuario[] $usuario
 */

use App\Models\Usuario;
use App\Router;

?>
<main class="container py-3 h-100">
    <h1 class="mt-4">Editar perfil: <?= $usuario->getNombre() ;?></h1>
    <p class="text-white my-4">Complete el formulario para editar sus datos o si lo desea puede <a href="<?= Router::urlTo('/usuarios') ;?>">volver atrás</a></p>
    <form action="<?= Router::urlTo('usuarios/editar') ;?>" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        class="form-control <?= isset($errores['nombre']) ? 'is-invalid' : '' ;?>"
                        placeholder="Ingrese aquí su nombre"
                        <?php
                            if (isset($errores['nombre'])):
                        ?>
                            aria-describedby="error-nombre"
                        <?php
                            endif;
                        ?>
                        value="<?= $oldData['nombre'] ?? $usuario->getNombre() ;?>"
                    >
                    <small>El nombre debe contener al menos 3 caracteres</small>
                    <?php
                        if (isset($errores['nombre'])):
                    ?>
                        <div class="alert alert-danger" id="error-nombre">
                            <span class="visually-hidden">Error: </span><?= $errores['nombre'][0] ;?>
                        </div>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input
                            type="text"
                            id="apellido"
                            name="apellido"
                            class="form-control <?= isset($errores['apellido']) ? 'is-invalid' : '' ;?>"
                            placeholder="Ingrese aquí su apellido"
                        <?php
                        if (isset($errores['apellido'])):
                            ?>
                            aria-describedby="error-apellido"
                        <?php
                        endif;
                        ?>
                            value="<?= $oldData['apellido'] ?? $usuario->getApellido() ;?>"
                    >
                    <small>El apellido debe contener al menos 3 caracteres</small>
                    <?php
                    if (isset($errores['apellido'])):
                        ?>
                        <div class="alert alert-danger" id="error-apellido">
                            <span class="visually-hidden">Error: </span><?= $errores['apellido'][0] ;?>
                        </div>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control <?= isset($errores['email']) ? 'is-invalid' : '' ;?>"
                            placeholder="Ingrese aquí su email"
                        <?php
                        if (isset($errores['email'])):
                            ?>
                            aria-describedby="error-email"
                        <?php
                        endif;
                        ?>
                            value="<?= $oldData['email'] ?? $usuario->getEmail() ;?>"
                    >
                    <small>El email debe ser válido</small>
                    <?php
                    if (isset($errores['email'])):
                        ?>
                        <div class="alert alert-danger" id="error-email">
                            <span class="visually-hidden">Error: </span><?= $errores['email'][0] ;?>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control <?= isset($errores['password']) ? 'is-invalid' : '' ;?>"
                            placeholder="Ingrese su contraseña aquí"
                        <?php
                        if (isset($errores['password'])):
                            ?>
                            aria-describedby="error-password"
                        <?php
                        endif;
                        ?>
                    >
                    <?php
                    if (isset($errores['password'])):
                        ?>
                        <div class="alert alert-danger" id="error-password">
                            <span class="visually-hidden">Error: </span><?= $errores['password'][0] ;?>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password-confirm">Contraseña:</label>
                    <input
                            type="password"
                            id="password-confirm"
                            name="password-confirm"
                            class="form-control <?= isset($errores['password_confirm']) ? 'is-invalid' : '' ;?>"
                            placeholder="Ingrese su contraseña aquí"
                        <?php
                        if (isset($errores['password_confirm'])):
                            ?>
                            aria-describedby="error-password-confirm"
                        <?php
                        endif;
                        ?>
                    >
                    <?php
                    if (isset($errores['password_confirm'])):
                        ?>
                        <div class="alert alert-danger" id="error-password-confirm">
                            <span class="visually-hidden">Error: </span><?= $errores['password_confirm'][0] ?? $errores['password_confirm'] ;?>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
            <div class="visually-hidden">
                <label for="id_usuario">id usuario</label>
                <input type="text" id="id_usuario" name="id_usuario" value="<?= $usuario->getIdUsuario() ;?>">
            </div>
            <div class="form-group my-5">
                <button type="submit" class="btn btn-lg btn-outline-light">Guardar</button>
            </div>
    </form>
</main>