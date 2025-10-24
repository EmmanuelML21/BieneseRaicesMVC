<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;
use Model\Blog;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $blogs = Blog::all();
        
        $resultado = $_GET['resultado'] ?? null; //si no exite que se null 
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores,
            'blogs' => $blogs
        ]);
    }
    public static function crear(Router $router)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        //verificar que de se post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //clase
            $propiedad = new Propiedad($_POST['propiedad']);
            /*PASAR IMAGEN*/
            //generar nombre Unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $mager = new Image(Driver::class);
                //lea la imagen y le assigne un tamaño de 800px de ancho * 600px de alto
                $imagen = $mager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
            //verificar que no existan errores
            $errores = $propiedad->validar();
            //revisar que el array de errores este vacio
            if (empty($errores)) {
                /*SUBIDA DE ARCHIVOS*/
                if (!is_dir(carperta_imagenes)) { //si no exite creala
                    mkdir(carperta_imagenes);
                }
                //guardar imagen en el servidor
                $imagen->save(carperta_imagenes . $nombreImagen);
                $propiedad->guardar();
            }
        }
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actulizar(Router $router)
    {
        $id = ValidarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();
        //Metodo Post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //asignar los atributos
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);
            //Validar
            //buscar errores
            $errores = $propiedad->validar();
            /*PASAR IMAGEN*/
            //generar nombre Unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //validar archivos
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $mager = new Image(Driver::class);
                //lea la imagen y le assigne un tamaño de 800px de ancho * 600px de alto
                $imagen = $mager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
            //revisar que el array de errores este vacio
            if (empty($errores)) {
                //alamcenar la imagen
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $imagen->save(carperta_imagenes . $nombreImagen);
                }
                //Actualizar datos
                $propiedad->guardar();
            }
        }
        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }
    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    //pasar id y guardar en memoria
                    $propiedad = Propiedad::find($id);
                    //elimar propiedad
                    $propiedad->eliminar();
                }
            }
        }
    }
}
