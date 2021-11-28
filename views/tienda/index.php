<?php
/**
 * @var App\Models\Producto[] $productos
 */

use App\Router;
?>
<main class="container py-5">
    <h1 class="text-uppercase">Tienda Oficial</h1>
    <div class="row gy-3 gy-lg-5 mt-2 mt-lg-3">
        <?php
            foreach ($productos as $producto):
        ?>
            <div class="col-lg-4 col-md-6">
                <article class="card <?= strtolower($producto->getImgAlt()) ;?>">
                    <div class="card-header">
                        <h2 class="card-title">
                            <?= $producto->getNombre(); ;?>
                        </h2>
                    </div>
                    <div class="circle"><span class="visually-hidden">Circulo</span></div>
                    <img class="img-fluid p-3" src="<?= Router::urlTo('/imgs/').$producto->getImg() ;?>" alt="<?= $producto->getImgAlt() ;?>">
                    <div class="card-body w-100">
                       <a role="button" class="btn btn-primary btn-lg btn-toolbar align-items-center justify-content-center" href="<?= Router::urlTo('tienda/' . $producto->getIdZapatilla()) ;?>">Ver más</a>
                    </div>
                </article>
            </div>
        <?php
            endforeach;
        ?>
    </div>
</main>
<script src="<?= Router::urlTo('js/vanilla-tilt.min.js') ;?>"></script>
<script>
    VanillaTilt.init(document.querySelector(".card"), {
        max: 25,
        speed: 400,
        transition: true,
        easing: "cubic-bezier(.03,.98,.52,.99)",
        glare: true,
        "max-glare": 0.2,
        reset: true,
    });

    //It also supports NodeList
    VanillaTilt.init(document.querySelectorAll(".card"));
</script>
