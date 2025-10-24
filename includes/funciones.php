<?php

define('templates_url', __DIR__ . '/templates');
define('funciones_url', __DIR__ . 'funciones.php');
define('carperta_imagenes', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
function incluirTemplate(string $nombre, bool $inicio = false)
{
    include templates_url . "/{$nombre}.php";
}
function validarSeccion()
{
    session_start();
    if (!$_SESSION['login']) {
        header('Location: /');
    }
}
function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
//ecapa /sanitizar HTML
function s($html)
{
    $s = htmlspecialchars($html);
    return $s;
}
//validar tipo de contenido
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad', 'blog'];
    return in_array($tipo, $tipos);
}
//Muestra los mensajes
function mostrarNotificaciones($codigo)
{
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actulizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}
function ValidarORedireccionar(string $url)
{
    //validar id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header("Location: {$url}");
    }
    return $id;
}
