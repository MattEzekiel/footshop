<?php

/**
 * @var array $errors
 * @var array $oldData
 * @var Marca[] $marca
 */

use App\Models\Marca;
use App\Router;

?>
<main class="container py-3 h-100">
    <h1 class="mt-4">Editar marca: <?= $marca->getNombre() ;?></h1>
    <p class="text-white my-4">Complete el formulario para editar la marca o si lo desea puede <a href="<?= Router::urlTo('/marcas') ;?>">volver atrás</a></p>
    <form action="<?= Router::urlTo('marcas/editar') ;?>" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        class="form-control <?= isset($errores['nombre']) ? 'is-invalid' : '' ;?>"
                        placeholder="Ingrese aquí el nombre del producto"
                        <?php
                        if (isset($errores['nombre'])):
                            ?>
                            aria-describedby="error-nombre"
                        <?php
                        endif;
                        ?>
                        value="<?= $oldData['nombre'] ?? $marca->getNombre() ;?>"
                    >
                    <small>El producto debe contener al menos 3 caracteres</small>
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
        <div class="visually-hidden">
            <label for="id_marca">id zapatilla</label>
            <input type="text" id="id_marca" name="id_marca" value="<?= $marca->getIdMarca() ;?>">
        </div>
        <div class="form-group my-5">
            <button type="submit" class="btn btn-lg btn-outline-light">Confirmar cambios</button>
        </div>
    </form>
</main>
