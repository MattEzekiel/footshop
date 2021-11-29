<?php
/**
 * @var Producto[] $productos
 * @var Marca[] $marcas
 * @var array $pagination
 */

use App\Auth\Auth;
use App\Models\Marca;
use App\Models\Producto;
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
    <form action="<?= Router::urlTo('/productos') ;?>" method="get" class="form-inline">
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
                    <td>
                        <a href="<?= Router::urlTo('productos/' . $producto->getIdZapatilla()) ;?>" role="button" class="btn btn-toolbar btn-outline-info">Ver Detalle</a>
                        <form class="eliminar mt-3" action="<?= Router::urlTo('productos/' . $producto->getIdZapatilla() . '/eliminar') ;?>" method="post">
                            <button class="btn w-100 btn-outline-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        <?php
            if ($pagination['pages'] > 1):
                $url = Router::urlTo('productos') . "?page=";
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
        <h2 class="text-center">El producto que usted intenta buscar no existe</h2>
    <?php
        endif;
    ?>
</main>
<script>
    let eliminar = document.querySelectorAll('.eliminar');

    for (let i = 0; i < eliminar.length; i++){
        eliminar[i].addEventListener('submit', function (e) {
            e.preventDefault();
            if(confirm('¿Desea eliminar la zapatilla de la base de datos?')){
                e.target.submit();
            } else {
                //Nada
            }
        })
    }
</script>