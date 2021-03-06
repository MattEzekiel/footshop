<?php

/**
 * @var App\Models\Marca[] $marcas
 * @var array $errors
 * @var array $oldData
 */

use App\Router;

?>
<main class="container py-3 h-100">
    <h1 class="mt-4">Cargue una nueva marca</h1>
    <p class="text-white my-4">Complete el formulario para guardar una nueva marca o si lo desea puede <a href="<?= Router::urlTo('/marcas') ;?>">volver atrás</a></p>
    <form action="<?= Router::urlTo('marcas/nuevo') ;?>" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        class="form-control <?= isset($errores['nombre']) ? 'is-invalid' : '' ;?>"
                        placeholder="Ingrese aquí el nombre de la marca"
                        <?php
                        if (isset($errores['nombre'])):
                            ?>
                            aria-describedby="error-nombre"
                        <?php
                        endif;
                        ?>
                        value="<?= $oldData['nombre'] ?? '' ;?>"
                    >
                    <small>La marca debe contener al menos 1 caracter</small>
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
        </div>
        <div class="form-group my-5">
            <button type="submit" class="btn btn-lg btn-outline-light">Guardar</button>
        </div>
    </form>
</main>
