<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController
{

    public static function crear(Router $router)
    {
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();
        //POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vendedor = new Vendedor($_POST['vendedor']);
            //Verificar errores
            $errores = $vendedor->validar();
            //no hay errores
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }
        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = ValidarORedireccionar('/admin');
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();
        //POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //guarde los datos del POST
            $args = $_POST['vendedor'];
            //Sincronizar objeto en memoria con lo que el usario escribio
            $vendedor->sincronizar($args);
            //VALIDAR DATOS
            $errores = $vendedor->validar();
            //si errores esta vacio
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }
        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Obtener Id
            $id = $_POST['id'];
            //validar que se entero
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id){
                //buscamos que tipo es (vendedro, propiedad)
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}
