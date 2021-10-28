<?php
/**
 * @var App\Models\Producto[] $productos
 */

use App\Router;

?>
<main class="container py-3 h-100">
    <h1>Sección en construcción</h1>
    <p class="text-white my-4">Todavía no se ha terminado de crear esta sección. <a href="<?= Router::urlTo('/productos') ;?>">Volver atrás</a></p>
    <div class="w-100">
        <img class="img-fluid" src="<?= Router::urlTo('/imgs/') ;?>working.jpg" alt="Sección en construcción">
    </div>
</main>
