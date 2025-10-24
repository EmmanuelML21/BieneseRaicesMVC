<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];
    public function get($url, $fn)
    {
        //guarda en el arreglo donde la url es la llave y la funcion el valor
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        //guarda en el arreglo donde la url es la llave y la funcion el valor
        $this->rutasPOST[$url] = $fn;
    }
    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;
        //areglo de rutas protegidas
        $rutas_protegidas = [
            '/admin',
            '/propiedades/crear',
            '/propiedades/actualizar',
            '/propiedades/eliminar',
            '/vendedores/crear',
            '/vendedores/actualizar',
            '/vendedores/eliminar',
            '/blog/crear',
            '/blog/actualizar',
            '/blog/eliminar'      
        ];
        //saber que ruta esta
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        //saber que metodo esta usando POST O GET
        $metodo = $_SERVER['REQUEST_METHOD'];
        if ($metodo === 'GET') {
            //si no existe una ruta ponle null
            $fn = $this->rutasGET[$urlActual] ?? null;
        } elseif ($metodo === 'POST') {
            //si no existe una ruta ponle null
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        //proteger las rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /login');
        }
        //la URL existe y tiene una funcion asociada
        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo "ERROR 404: NOT FOUND";
        }
    }
    //muestra una vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            //el key va ser una variable po es el doble $$
            $$key = $value;
        }
        //Amacene en memoria durante un momento..
        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); //limpiar la memoria para liberar al servidor
        include __DIR__ . "/views/layout.php";
    }
}
