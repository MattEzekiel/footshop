<?php
/**
 * @var \App\Models\Producto $producto
 */
?>

<main class="container py-3">
    <h1>Detalle de <span class="text-capitalize"><?= $producto->getNombre() ;?></span></h1>
    <dl>
        <dt>Imagen</dt>
        <dd><img style="max-width: 260px" class="card-img" src="<?= \App\Router::urlTo('/imgs/') . $producto->getImg() ;?>" alt="<?= $producto->getImgAlt() ;?>"></dd>
        <dt>Descripción</dt>
        <dd><?= $producto->getDescripcion() ;?></dd>
        <dt>Precio</dt>
        <dd>$ <?= number_format($producto->getPrecio(),0,',','.') ;?></dd>
    </dl>
    <div>
        <a href="<?= \App\Router::urlTo('productos') ;?>" role="button" class="btn btn-outline-light">Volver</a>
    </div>
</main>