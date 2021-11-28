<?php

use App\Models\Marca;

/**
 * @var App\Models\Producto[] $productos
 * @var array $errors
 * @var array $oldData
 * @var array $marcas
 */

use App\Router;

?>
<main class="container py-3 h-100">
    <h1>Cargue el nuevo producto</h1>
    <p class="text-white my-4">Complete el formulario para guardar un nuevo producto o si lo desea puede <a href="<?= Router::urlTo('/productos') ;?>">volver atrás</a></p>
    <form action="<?= Router::urlTo('productos/nuevo') ;?>" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="form-control"
                            placeholder="Ingrese aquí el nombre del producto"
                            <?php
                                if (isset($errores['nombre'])):
                            ?>
                                aria-describedby="error-nombre"
                            <?php
                                endif;
                            ?>
                            value="<?= $oldData['nombre'] ?? '' ;?>"
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input
                            type="number"
                            id="precio"
                            name="precio"
                            class="form-control"
                            placeholder="Ingrese aquí el precio del producto"
                        <?php
                            if (isset($errores['precio'])):
                        ?>
                            aria-describedby="error-precio"
                        <?php
                            endif;
                        ?>
                            value="<?= $oldData['precio'] ?? '' ;?>"
                    >
                    <small>Solo caracteres numéricos están permitidos en este campo</small>
                    <?php
                        if (isset($errores['precio'])):
                    ?>
                        <div class="alert alert-danger"  id="error-precio">
                            <span class="visually-hidden">Error: </span><?= $errores['precio'][0] ;?>
                        </div>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea
                    name="descripcion"
                    id="descripcion"
                    class="form-control"
                    cols="30"
                    rows="10"
                    placeholder="Ingrese aquí la descripción del producto"
                    <?php
                        if (isset($errores['descripcion'])):
                    ?>
                        aria-describedby="error-descripcion"
                    <?php
                        endif;
                    ?>
            ><?= $oldData['descripcion'] ?? '' ;?></textarea>
            <?php
                if (isset($errores['descripcion'])):
            ?>
                <div class="alert alert-danger" id="error-descripcion">
                    <span class="visually-hidden">Error: </span><?= $errores['descripcion'][0];?>
                </div>
            <?php
                endif;
            ?>
        </div>
        <div class="form-group">
            <label for="id_marca">Marca</label>
            <select
                    name="id_marca"
                    id="id_marca"
                <?= isset($errors['id_marca']) ? 'aria-describedby="error-id_marca"' : '';?>
            >
                <?php
                foreach ($marcas as $marca):
                    ?>
                    <option
                            value="<?= $marca->getIdMarca() ;?>"
                    >
                        <?= ucfirst($marca->getMarca()) ;?>
                    </option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-outline-light">Guardar</button>
        </div>
    </form>
</main>
