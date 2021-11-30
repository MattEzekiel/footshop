<?php
/**
 * @var Producto[] $productos
 * @var array $buscarValores
 * @var Marca[] $marcas
 * @var array $pagination
 */

use App\Models\Marca;
use App\Models\Producto;
use App\Router;
?>
<main class="container py-5">
    <h1 class="text-uppercase">Tienda Oficial</h1>
    <form action="<?= Router::urlTo('/tienda') ;?>" method="get" class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Buscar nombre de Zapatillas" value="<?= $buscarValores['nombre'] ?? '' ;?>">
            <label for="nombre" class="visually-hidden">Buscar</label>
        </div>
        <div class="form-group">
            <label for="id_marca" class="visually-hidden">Buscar por marca</label>
            <select name="id_marca" id="id_marca" class="form-select-sm">
                <option value="">Todos</option>
                <?php
                    foreach ($marcas as $marca):
                ?>
                <option
                        value="<?= $marca->getIdMarca() ;?>"
                    <?= ($buscarValores['id_marca'] ?? null) == $marca->getIdMarca() ? 'selected' : null ;?>
                >
                    <?= ucfirst($marca->getNombre()) ;?>
                </option>
                <?php
                    endforeach;
                ?>
            </select>
        </div>
        <div class="form-group mt-3">
            <button class="btn btn-outline-light" type="submit">Buscar</button>
        </div>
    </form>
    <?php
        if (count($productos) > 0):
    ?>
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
            <?php
            if ($pagination['pages'] > 1):
                $url = Router::urlTo('tienda') . "?page=";
                ?>
                <nav aria-label="Páginas de resultados" class="my-3">
                    <ul class="pagination justify-content-center">
                        <?php
                        if ($pagination['pageNow'] > 1):
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= $url . ($pagination['pageNow'] - 1) ;?>" aria-label="Volver a la página anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                            </li>
                        <?php
                        else :
                            ?>
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Volver a la página anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                            </li>
                        <?php
                        endif;
                        ?>
                        <?php
                        for($i = 1;$i <= $pagination['pages']; $i++):
                            ?>
                            <?php
                            if ($pagination['pageNow'] != $i):
                                ?>
                                <li class="page-item"><a class="page-link" href="<?= $url . $i ;?>"><?= $i ;?></a></li>
                            <?php
                            else:
                                ?>
                                <li class="page-item active" aria-current="page"><a class="page-link" href="<?= $url . $i ;?>"><?= $i ;?></a></li>
                            <?php
                            endif;
                            ?>
                        <?php
                        endfor;
                        ?>
                        <?php
                        if ($pagination['pageNow'] < $pagination['pages']):
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= $url . ($pagination['pageNow'] + 1) ;?>" aria-label="Ir a la página siguiente">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Siguiente</span>
                                </a>
                            </li>
                        <?php
                        else :
                            ?>
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Ir a la página siguiente">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Siguiente</span>
                                </a>
                            </li>
                        <?php
                        endif;
                        ?>
                    </ul>
                </nav>
            <?php
            endif;
            ?>
    <?php
        else :
    ?>
    <h2 class="text-center">El producto que intenta buscar no existe</h2>
    <?php
        endif;
    ?>
</main>
<pre>

</pre>
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