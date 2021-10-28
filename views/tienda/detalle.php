<?php
/**
 * @var \App\Models\Producto $producto
 */

use App\Router;

?>
<main class="container py-3">
    <h1 class="text-center my-5">Detalle de <span class="text-capitalize"><?= $producto->getNombre() ;?></span></h1>
<article id="tienda-detalle" class="my-3">
    <div id="carta" class="<?= strtolower($producto->getImgAlt()) ;?>">
        <img src="<?= Router::urlTo('imgs/'. $producto->getImg()) ;?>" alt="<?= $producto->getImgAlt() ;?>" class="img-fluid">
        <p class="mt-3"><?= $producto->getDescripcion() ;?></p>
        <p id="precio"><span class="visually-hidden">Precio:</span> $ <?= number_format( $producto->getPrecio(),0,',','.') ;?></p>
        <a href="<?= Router::urlTo('/contacto') ;?>" class="btn btn-lg btn-primary btn-toolbar justify-content-center align-items-center" role="button">Contactanos</a>
    </div>
</article>
</main>