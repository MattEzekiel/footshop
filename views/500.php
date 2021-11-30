<?php
/**
 * Error 500
 */

use App\Router;

?>
<main class="container-fluid py-5" id="error-page">
    <div class="container">
        <div class="row flex-column-reverse flex-md-row justify-content-center align-items-center">
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                <h1>Error 500</h1>
                <p class="text-white">No se pudo conectar a la base de datos</p>
                <p class="text-white">Vuelva a ingresar más tarde</p>
            </div>
            <div class="col-md-8 text-center">
                <img class="img-fluid" src="<?= Router::urlTo('/imgs/') ;?>working.jpg" alt="Error interno">
            </div>
        </div>
    </div>
</main>
