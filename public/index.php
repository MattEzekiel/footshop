<?php
/**
 * Router de todo el sitio
 */
require_once __DIR__ . "/../vendor/autoload.php";

$basePath = realpath(__DIR__ . "/..");

\App\Env\Loader::cargar($basePath);

use App\Controllers\AuthController;
use App\Controllers\ConsultaController;
use App\Controllers\ContactoController;
use App\Controllers\InicioController;
use App\Controllers\MarcasController;
use App\Controllers\ProductoController;
use App\Controllers\TiendaController;
use App\Controllers\UsuarioController;
use App\Session\Session;

Session::start();

$router = new App\Router($basePath);

/**
 * Home & otras
 */
$router->get('/', [InicioController::class, 'index']);
$router->get('/sobre-nosotros', [InicioController::class, 'sobreNosotros']);
$router->get('/404', [InicioController::class, 'error404']);
$router->get('/influencers', [InicioController::class, 'influencers']);
$router->get('/500', [InicioController::class, 'error500']);

/**
 *Contacto
 */
$router->get('/contacto', [ContactoController::class, 'index']);
$router->post('/enviar-contacto', [ContactoController::class, 'sendContact']);

/**
 * Registro
 */
$router->get('/registro', [AuthController::class, 'registroForm']);
$router->post('/registro', [AuthController::class, 'registro']);

/**
 * Sesiones
 */
$router->get('/iniciar-sesion', [AuthController::class, 'loginForm']);
$router->post('/iniciar-sesion', [AuthController::class, 'login']);
$router->post('/cerrar-sesion', [AuthController::class, 'logout']);

/**
 * ABM Productos
 */
$router->get('/productos', [ProductoController::class, 'index']);
$router->get('/productos/nuevo', [ProductoController::class, 'nuevoForm']);
$router->get('/productos/{id}', [ProductoController::class,'ver']);
$router->get('/productos/editar/{id}', [ProductoController::class,'editarForm']);
$router->post('/productos/{id}/eliminar', [ProductoController::class,'eliminar']);
$router->post('/productos/nuevo', [ProductoController::class,'nuevoProducto']);
$router->post('/productos/editar', [ProductoController::class,'editar']);

/**
 * Tienda Productos
 */
$router->get('/tienda',[TiendaController::class, 'index']);
$router->get('/tienda/{id}', [TiendaController::class,'detalle']);

/**
 * ABM Marcas
 */
$router->get('/marcas', [MarcasController::class, 'index']);
$router->get('/marcas/nuevo', [MarcasController::class, 'nuevoForm']);
$router->get('/marcas/editar/{id}', [MarcasController::class,'editarForm']);
$router->post('/marcas/nuevo', [MarcasController::class,'nuevaMarca']);
$router->post('/marcas/{id}/eliminar', [MarcasController::class,'eliminar']);
$router->post('/marcas/editar', [MarcasController::class,'editar']);

/**
 * AMB de usuarios
 */
$router->get('/usuarios', [UsuarioController::class, 'index']);
$router->get('/usuarios/editar/{id}', [UsuarioController::class, 'editarForm']);
$router->post('/usuarios/editar', [UsuarioController::class,'editar']);

/**
 * AMB de Consultas
 */
$router->get('/consultas', [ConsultaController::class, 'index']);


$router->run();

