<?php

/**
 * @var Contacto[] $consultas
 * @var array $buscarValores
 * @var array $pagination
 */

use App\Models\Contacto;
use App\Router;

?>
<main class="container py-5">
    <h2>Listado de consultas</h2>
    <form action="<?= Router::urlTo('/consultas') ;?>" method="get" class="form-inline mb-5">
        <div class="form-group">
            <input type="text" class="form-control form-control-lg" id="asunto" name="asunto" placeholder="Buscar por asunto de consulta" value="<?= $buscarValores['asunto'] ?? '' ;?>">
            <label for="asunto" class="visually-hidden">Buscar</label>
        </div>
        <div class="form-group mt-3">
            <button class="btn btn-outline-light" type="submit">Buscar consulta</button>
        </div>
    </form>
    <?php
    if (count($consultas) > 0):
        ?>
        <div class="table-responsive">
            <table id="tabla-usuarios" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Asunto</th>
                    <th scope="col">Email</th>
                    <th scope="col">Consulta</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($consultas as $consulta):
                ?>
                    <tr>
                        <td><?= $consulta->getIdConsulta() ;?></td>
                        <td><?= $consulta->getNombre() ;?></td>
                        <td><?= $consulta->getAsunto() ;?></td>
                        <td><?= $consulta->getEmail() ;?></td>
                        <td><?= $consulta->getConsulta() ;?></td>
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
        <h3 class="text-center h2">El usuario que intenta buscar no existe</h3>
    <?php
    endif;
    ?>
</main>