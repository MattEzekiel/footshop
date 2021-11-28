<?php
/**
 * @var \App\Models\Producto $producto
 * @var \App\Models\Influencer[] $influencers
 */

use App\Router;

/*echo '<pre>';
var_dump($influencers);
echo '</pre>';*/

?>

<main class="container-fluid">
    <section id="promo" class="<?= strtolower($producto->getImgAlt()) ;?> py-5">
        <h1 class="text-uppercase">Foot Shop</h1>
        <!--<p>Lo mejor para tus pies</p>-->
        <div class="container contenedor-inicio">
            <div class="imgBx">
                <img class="img-fluid" src="<?= Router::urlTo('/imgs/') . $producto->getImg() ;?>" alt="<?= $producto->getImgAlt() ;?>">
            </div>
            <div class="text">
                <h2><?= $producto->getNombre() ;?></h2>
                <p><?= $producto->getDescripcion() ;?></p>
                <a href="<?= Router::urlTo('tienda/') . $producto->getIdZapatilla() ;?>" role="button" class="btn btn-lg">Ver detalle</a>
            </div>
            <ul class="rrss">
                <li><a href="#"><img src="<?= Router::urlTo('/imgs/rrss/') ;?>facebook.png" alt="Facebook"></a></li>
                <li><a href="#"><img src="<?= Router::urlTo('/imgs/rrss/') ;?>instagram.png" alt="Instagram"></a></li>
                <li><a href="#"><img src="<?= Router::urlTo('/imgs/rrss/') ;?>twitter.png" alt="Twitter"></a></li>
            </ul>
        </div>
    </section>
    <section id="influencers" class="container py-5">
        <h2>Quienes confían en nosotros</h2>
        <p style="max-width: 500px" class="text-white mb-4">Foot Shop, Inc. es una empresa nacional dedicada al rediseño, desarrollo, fabricación y comercialización de equipamiento deportivo de terceros, más que nada calzado deportivo</p>
        <div class="row d-flex justify-content-around flex-wrap">
            <?php
                foreach ($influencers as $influencer):
            ?>
              <a class="col-lg-4 <?= $influencer->getImgAlt() ;?>" href="<?= Router::urlTo('/influencers') ;?>">
                  <h3><?= $influencer->getNombre() ;?></h3>
                  <img src="<?= Router::urlTo('/imgs/influencers/') . $influencer->getImg() ;?>" alt="<?= $influencer->getImgAlt() ;?>">
              </a>
            <?php
                endforeach;
            ?>
        </div>
    </section>
    <section id="nosotros" class="container py-5">
        <h2>¿Quienes somos?</h2>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="row">
                        <div class="col-8 w-100 text-center d-flex justify-content-center">
                            <img style="max-height: 300px" class="m-auto text-center img-fluid" src="<?= Router::urlTo('/imgs/influencers/') ;?>random.png" alt="Personaje oculto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tarjeta m-auto d-flex justify-content-center align-items-center flex-column">
            <a class=" mt-4 text-uppercase btn btn-lg btn-outline-light text-center justify-content-center align-items-center" href="<?= Router::urlTo('/sobre-nosotros') ;?>">Conocenos</a>
        </div>
    </section>
    <aside id="consultas">
        <div class="row">
            <div class="imgbox col-md-6">
                <img class="img-fluid" src="<?= Router::urlTo('/imgs/') ;?>logo.png" alt="Logo Foot Shop">
            </div>
            <div class="detalles col-md-6">
                <div class="contenido">
                    <h2 class="text-dark">Contactanos</h2>
                    <p>
                        Foot Shop Argentina de seguro querrás utilizar uno de nuestros productos, así que, nuestros medios de contacto:
                    </p>
                    <p>Otro medio de contacto muy importante es la dirección donde se encuentra ubicada la empresa y sus sucursales. He querido dejar este punto después de los medios online porque el sitio web nos será de mucha ayuda.</p>

                    <p>Para comenzar te comparto la dirección que nos brinda en una de sus páginas como parte de la asistencia internacional. Esto nos da a entender que es la central de Foot Shop o uno de sus puntos más importantes en Argentina. La dirección es la siguiente:</p>

                    <p><i>Buenos Aires: Avenida del Libertador 2442 – Sexto piso (1636) Olivos</i></p>

                    <p>Ahora si quiere conocer otros puntos en el mismo país te invito a que realices una búsqueda en el siguiente link: Buscar sucursales de Foot Shop en Argentina.</p>

                    <p>Allí podrás ver un mapa con la dirección exacta de cada uno de los puntos ubicado en Argentina. Solo es cuestión de que ubiques el mapa del país sudamericano.</p>

                    <p>Con esto es suficiente, ya tienes a la mano más de un medio de contacto para estar comunicado con esta gran empresa. No hay excusa así que toma el teléfono, computador… o lo que sea y comunícate ya.</p>
                    <a href="<?= Router::urlTo('/contacto') ;?>" class="btn btn-toolbar btn-lg btn-primary">Contactanos</a>
                </div>
            </div>
        </div>
    </aside>
</main>
