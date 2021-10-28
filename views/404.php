<?php
/**
 * Error 404
 */

use App\Router;

?>
<main class="container-fluid py-5" id="error-page">
    <div class="container">
        <div class="row flex-column-reverse flex-md-row justify-content-center align-items-center">
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                <h1>Error 404</h1>
                <p class="text-white">El destino que solicitó no existe <br> ¿Desea volver al inicio?</p>
                <a role="button" href="<?= Router::urlTo('/') ;?>" class="btn btn-outline-light btn-lg">Volver al inicio</a>
            </div>
            <div class="col-md-8 text-center">
                <img class="img-fluid" src="<?= Router::urlTo('/imgs/') ;?>shoes-error.png" alt="Error en la búsqueda">
            </div>
        </div>
    </div>
</main>
