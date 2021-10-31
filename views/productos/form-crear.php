<?php
/**
 * @var App\Models\Producto[] $productos
 */

use App\Router;

$nombre = $_SESSION['nombre'] ?? null;
$descripcion = $_SESSION['descripcion'] ?? null;
$precio = $_SESSION['precio'] ?? null;

unset($_SESSION['nombre'],$_SESSION['descripcion'],$_SESSION['precio']);

?>
<main class="container py-3 h-100">
    <h1>Sección en construcción</h1>
    <p class="text-white my-4">Todavía no se ha terminado de crear esta sección. <a href="<?= Router::urlTo('/productos') ;?>">Volver atrás</a></p>
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
                                if (isset($nombre)):
                            ?>
                                aria-describedby="error-nombre"
                            <?php
                                endif;
                            ?>
                            value="<?= $_SESSION['old_data']['nombre'] ?? '' ;?>"
                    >
                    <small>El producto debe contener al menos 3 caracteres</small>
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
                    <label for="precio">Precio</label>
                    <input
                            type="number"
                            id="precio"
                            name="precio"
                            class="form-control"
                            placeholder="Ingrese aquí el precio del producto"
                        <?php
                            if (isset($precio)):
                        ?>
                            aria-describedby="error-precio"
                        <?php
                            endif;
                        ?>
                            value="<?= $_SESSION['old_data']['precio'] ?? '' ;?>"
                    >
                    <small>Solo caracteres numéricos están permitidos en este campo</small>
                    <?php
                        if (isset($precio)):
                    ?>
                        <div class="alert alert-danger">
                            <?= $precio ;?>
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
                        if (isset($descripcion)):
                    ?>
                        aria-describedby="error-descripcion"
                    <?php
                        endif;
                    ?>
            ><?= $_SESSION['old_data']['descripcion'] ?? '' ;?></textarea>
            <?php
                if (isset($descripcion)):
            ?>
                <div class="alert alert-danger">
                    <?= $descripcion ;?>
                </div>
            <?php
                endif;
            ?>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-outline-light">Guardar</button>
        </div>
    </form>
</main>
