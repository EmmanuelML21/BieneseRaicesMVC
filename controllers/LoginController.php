<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = Admin::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);

            $errores = $auth->validar();

            //si errores esta vacio
            if (empty($errores)) {
                //validar que exista
                $resultado = $auth->existeUsuario();
                if (!$resultado) {
                    $errores = Admin::getErrores();
                } else {
                    //validar password
                    $autenticado = $auth->comprobarPassword( $resultado);
                    //autenticar usuario
                    if($autenticado){
                        $auth->autentificar();
                    }else{
                        //si esta mal el password 
                        $errores = Admin::getErrores();
                    }
                    
                }
                
            }
        }
        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }
    public static function logout()
    {
        session_start();
        $_SESSION = [];

        header('Location: /');
    }
}
