<?php
/**
 * Router de todo el sitio
 */
require_once __DIR__ . "/../vendor/autoload.php";

session_start();

$basePath = realpath(__DIR__ . "/..");


use App\Controllers\AuthController;
use App\Controllers\ContactoController;
use App\Controllers\InicioController;
use App\Controllers\ProductoController;
use App\Controllers\TiendaController;

$router = new App\Router($basePath);

/**
 * Home & otras
 */
$router->get('/', [InicioController::class, 'index']);
$router->get('/sobre-nosotros', [InicioController::class, 'sobreNosotros']);
$router->get('/404', [InicioController::class, 'error404']);
$router->get('/influencers', [InicioController::class, 'influencers']);

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
$router->post('/productos/nuevo', [ProductoController::class,'nuevoProducto']);

/**
 * Tienda Productos
 */
$router->get('/tienda',[TiendaController::class, 'index']);
$router->get('/tienda/{id}', [TiendaController::class,'detalle']);

$router->run();

