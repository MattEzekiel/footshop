<?php

use App\Auth\Auth;
use App\Models\Marca;
use App\Router;

/**
 * @var Marca[] $marcas
 * @var array $pagination
 */

$auth = new Auth();
?>
<div class="container-fluid" id="marcas">
    <main class="container py-3">
        <h1>Listado de Marcas</h1>
        <?php
        if ($auth->isAutenticado()):
            ?>
            <div class="my-4">
                <a href="<?= Router::urlTo('marcas/nuevo') ;?>" role="button" class="btn btn-outline-light">Ingresar una nueva marca</a>
            </div>
        <?php
        endif;
        ?>
        <form action="<?= Router::urlTo('/marcas') ;?>" method="get">
            <div class="form-group">
                <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Buscar nombre de Marcas" value="<?= $buscarValores['nombre'] ?? '' ;?>">
                <label for="nombre" class="visually-hidden">Buscar</label>
            </div>
            <div class="form-group mt-3">
                <button class="btn btn-outline-light" type="submit">Buscar</button>
            </div>
        </form>
        <?php
        if (count($marcas) > 0):
            ?>
            <div class="table-responsive mt-5">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <?php
                        if ($auth->isAutenticado()):
                            ?>
                            <th>Acciones</th>
                        <?php
                        endif;
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($marcas as $marca):
                        ?>
                        <tr>
                            <td class="text-center"><?= $marca->getIdMarca() ;?></td>
                            <td class="text-center"><?= ucfirst($marca->getNombre()) ;?></td>
                            <?php
                            if ($auth->isAutenticado()):
                                ?>
                                <td class="d-flex justify-content-center align-items-center flex-column py-3">
                                    <a href="<?= Router::urlTo('marcas/editar/' . $marca->getIdMarca()) ;?>" role="button" class="btn mb-3 btn-outline-warning">Editar</a>
                                    <form action="<?= Router::urlTo('marcas/' . $marca->getIdMarca() . '/eliminar') ;?>" method="post" class="eliminar">
                                        <button class="btn m-auto btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            <?php
                            endif;
                            ?>
                        </tr>
                    <?php
                    endforeach;
                    ?>
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
        else:
            ?>
            <h2 class="text-center">La marca que usted intenta buscar no existe</h2>
        <?php
        endif;
        ?>
    </main>
</div>