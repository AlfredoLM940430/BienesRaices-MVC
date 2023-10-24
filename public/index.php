<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;
use Controllers\LoginController;

$router = new Router();

$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/propiedad/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedad/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedad/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedad/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedad/eliminar', [PropiedadController::class, 'eliminar']);

$router->get('/vendedor/crear', [VendedorController::class, 'crear']);
$router->post('/vendedor/crear', [VendedorController::class, 'crear']);
$router->get('/vendedor/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedor/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedor/eliminar', [VendedorController::class, 'eliminar']);

// Paginas publicas
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/anuncios', [PaginasController::class, 'anuncios']);
$router->get('/anuncio', [PaginasController::class, 'anuncio']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

// Login
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->comprobarRutas();



