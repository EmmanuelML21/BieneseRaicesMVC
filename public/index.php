<?php
//incluir include (BD,FUNCIONES Y CLASSE)
require_once __DIR__ . '/../includes/app.php';
//llamar router

use Controllers\BlogController;
use Controllers\LoginController;
use Controllers\PaginasController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;

$router = new Router();
//rutas
//zona admin
//propieades
$router->get('/admin',[PropiedadController::class, 'index']);
$router->get('/propiedades/crear',[PropiedadController::class, 'crear']);
$router->post('/propiedades/crear',[PropiedadController::class, 'crear']);
$router->get('/propiedades/actulizar',[PropiedadController::class, 'actulizar']);
$router->post('/propiedades/actulizar',[PropiedadController::class, 'actulizar']);
$router->post('/propiedades/eliminar',[PropiedadController::class, 'eliminar']);
//vendedor
$router->get('/vendedores/crear', [VendedorController::class, 'crear']);
$router->post('/vendedores/crear', [VendedorController::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);
//Blog
$router->get('/blog/crear', [BlogController::class, 'crear']);
$router->post('/blog/crear', [BlogController::class, 'crear']);
$router->get('/blog/actualizar', [BlogController::class, 'actualizar']);
$router->post('/blog/actualizar', [BlogController::class, 'actualizar']);
$router->post('/blog/eliminar', [BlogController::class, 'eliminar']);
//url visitantes
$router->get('/',[PaginasController::class, 'index']);
$router->get('/nosotros',[PaginasController::class, 'nosotros']);
$router->get('/propiedades',[PaginasController::class, 'propiedades']);
$router->get('/propiedad',[PaginasController::class, 'propiedad']);
$router->get('/blog',[PaginasController::class, 'blog']);
$router->get('/entrada',[PaginasController::class, 'entrada']);
$router->get('/contacto',[PaginasController::class, 'contacto']);
$router->post('/contacto',[PaginasController::class, 'contacto']);

//LOGIN
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);


$router->comprobarRutas();