<?php
/**
 * Página de Registro
 */

$nombre = $_SESSION['nombre-registro'] ?? null;
$apellido = $_SESSION['apellido-registro'] ?? null;
$email = $_SESSION['email-registro'] ?? null;
$password = $_SESSION['password-registro'] ?? null;
$password_confirm = $_SESSION['password-confirm'] ?? null;

unset($_SESSION['nombre-registro'],$_SESSION['apellido-registro'],$_SESSION['email-registro'],$_SESSION['password-registro'],$_SESSION['password-confirm']);

?>
<main id="registrarse" class="container-fluid py-5">
    <div class="container mt-2">
        <h1 class="text-uppercase">Registrarse</h1>
        <p class="text-white">Creá tu cuenta sencilla y rápidamente</p>
        <form action="<?= \App\Router::urlTo('registro') ;?>" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        class="form-control"
                        placeholder="Ingrese su nombre aquí"
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
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input
                        type="text"
                        id="apellido"
                        name="apellido"
                        class="form-control"
                        placeholder="Ingrese su apellido aquí"
                    <?php
                        if (isset($apellido)):
                    ?>
                        aria-describedby="error-apellido"
                    <?php
                    endif;
                    ?>
                >
                <small>El apellido debe tener al menos 3 caracteres</small>
                <?php
                    if (isset($apellido)):
                ?>
                    <div class="alert alert-danger">
                        <?= $apellido ;?>
                    </div>
                <?php
                    endif;
                ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Ingrese su email aquí"
                    <?php
                        if (isset($email)):
                    ?>
                        aria-describedby="error-email"
                    <?php
                        endif;
                    ?>
                >
                <?php
                    if (isset($email)):
                ?>
                    <div class="alert alert-danger">
                        <?= $email ;?>
                    </div>
                <?php
                    endif;
                ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Ingrese su contraseña aquí"
                    <?php
                        if (isset($password)):
                    ?>
                        aria-describedby="error-password"
                    <?php
                        endif;
                    ?>
                >
                <small>La contraseña debe tener al menos 4 caracteres</small>
                <?php
                    if (isset($password)):
                ?>
                    <div class="alert alert-danger">
                        <?= $password ;?>
                    </div>
                <?php
                    endif;
                ?>
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirmar Contraseña</label>
                <input
                        type="password"
                        id="password_confirm"
                        name="password_confirm"
                        class="form-control"
                        placeholder="Confirme su contraseña"
                    <?php
                        if (isset($password_confirm)):
                    ?>
                        aria-describedby="error-password"
                    <?php
                        endif;
                    ?>
                >
                <small>En este campo debe repetir la contraseña del campo anterior</small>
                <?php
                    if (isset($password_confirm)):
                ?>
                    <div class="alert alert-danger">
                        <?= $password_confirm ;?>
                    </div>
                <?php
                    endif;
                ?>
            </div>
            <button class="mt-4 btn btn-outline-light text-uppercase" type="submit">Registrarse</button>
        </form>
    </div>
</main>
