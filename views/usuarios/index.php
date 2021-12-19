<?php

/**
 * @var Usuario[] $usuarios
 * @var array $buscarValores
 * @var array $pagination
 */

use App\Auth\Auth;
use App\Models\Usuario;
use App\Router;
$auth = new Auth();
?>
<main class="container py-5">
    <h2>Listado de usuarios</h2>
    <form action="<?= Router::urlTo('/usuarios') ;?>" method="get" class="form-inline mb-5">
        <div class="form-group">
            <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Buscar nombre de Usuario" value="<?= $buscarValores['nombre'] ?? '' ;?>">
            <label for="nombre" class="visually-hidden">Buscar</label>
        </div>
        <div class="form-group mt-3">
            <button class="btn btn-outline-light" type="submit">Buscar usuario</button>
        </div>
    </form>
    <?php
        if (count($usuarios) > 0):
    ?>
    <div class="table-responsive">
        <table id="tabla-usuarios" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Email</th>
                    <?php
                        if ($auth->isAutenticado()):
                    ?>
                        <th scope="col">Acciones</th>
                    <?php
                        endif;
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($usuarios as $usuario):
                ?>
                    <tr>
                        <td><?= $usuario->getIdUsuario() ;?></td>
                        <td><?= $usuario->getNombre() ;?></td>
                        <td><?= $usuario->getApellido() ;?></td>
                        <td><?= $usuario->getEmail() ;?></td>
                        <?php
                            if ($auth->isAutenticado()):
                        ?>
                            <?php
                                if ($auth->getUsuario()->getIdUsuario() === $usuario->getIdUsuario()):
                            ?>
                                    <td class="d-flex justify-content-center align-items-center flex-column py-3">
                                        <a href="<?= Router::urlTo('usuarios/editar/' . $usuario->getIdUsuario()) ;?>" role="button" class="btn btn-outline-warning">Editar perfil</a>
                                    </td>
                            <?php
                                else:
                            ?>
                                    <td><?= 'No tiene permisos para editar este perfil' ;?></td>
                            <?php
                                endif;
                            ?>
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
    <h3 class="text-center h2">El usuario que intenta buscar no existe</h3>
    <?php
        endif;
    ?>
</main>