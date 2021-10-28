<?php
/**
 * @var App\Models\Producto[] $productos
 */

use App\Auth\Auth;
use App\Router;

$auth = new Auth;
?>
<main class="container py-3">
    <h1 class="text-uppercase">Listado de Zapatillas</h1>
    <?php
        if ($auth->isAutenticado()):
    ?>
    <div class="my-4">
        <a href="<?= Router::urlTo('productos/nuevo') ;?>" role="button" class="btn btn-outline-light">Ingresar una nueva zapatilla</a>
    </div>
    <?php
        endif;
    ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($productos as $producto): ?>
                <tr>
                    <td><?= $producto->getIdZapatilla();?></td>
                    <td><?= $producto->getNombre();?></td>
                    <td><?= $producto->getDescripcion();?></td>
                    <td class="text-center precio-lista">$ <?= number_format($producto->getPrecio(),0,',','.');?></td>
                    <td><img class="img-fluid" src="<?= Router::urlTo('/imgs/') . $producto->getImg();?> " alt="<?= $producto->getImgAlt() ;?>"></td>
                    <td><a href="<?= Router::urlTo('productos/' . $producto->getIdZapatilla()) ;?>" role="button" class="btn btn-toolbar btn-outline-info">Ver Detalle</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
