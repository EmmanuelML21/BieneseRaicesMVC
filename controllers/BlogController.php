<?php

namespace Controllers;

use Intervention\Image\Colors\Rgb\Channels\Red;
use Model\Blog;
use Model\Vendedor;
use MVC\Router;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class BlogController
{
    public static function crear(Router $router)
    {
        $blog = new Blog;
        $errores = Blog::getErrores();
        $vendedores = Vendedor::all();
        //POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $blog = new Blog($_POST['blog']);
            //crear un nombre unico a la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //verificar si existe un imagen
            if ($_FILES['blog']['tmp_name']['imagen']) {
                $mager = new Image(Driver::class);
                //lea la imagen y le assigne un tamaño de 800px de ancho * 600px de alto
                $imagen = $mager->read($_FILES['blog']['tmp_name']['imagen'])->cover(800, 600);
                //asignamos el nombre unico a la imagen
                $blog->setImagen($nombreImagen);
            }
            //validar errores
            $errores = $blog->validar();
            if (empty($errores)) {
                /*SUBIDA DE ARCHIVOS*/
                if (!is_dir(carperta_imagenes)) { //si no exite creala
                    mkdir(carperta_imagenes);
                }
                //guardar imagen en el servidor
                $imagen->save(carperta_imagenes . $nombreImagen);
                $blog->guardar();
            }
        }
        $router->render('blog/crear', [
            'blog' => $blog,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {
        //validar id 
        $id = ValidarORedireccionar('/admin');
        //buscar id
        $blog = Blog::find($id);
        //llamar errores
        $errores = Blog::getErrores();
        //llamar vendedores
        $vendedores = Vendedor::all();
        //POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['blog'];
            $blog->sincronizar($args);
            //Validar
            //buscar errores
            $errores = $blog->validar();
            /*PASAR IMAGEN*/
            //generar nombre Unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //validar archivos
            if ($_FILES['blog']['tmp_name']['imagen']) {
                $mager = new Image(Driver::class);
                //lea la imagen y le assigne un tamaño de 800px de ancho * 600px de alto
                $imagen = $mager->read($_FILES['blog']['tmp_name']['imagen'])->cover(800, 600);
                $blog->setImagen($nombreImagen);
            }
            //revisar que el array de errores este vacio
            if (empty($errores)) {
                //si existe la imagen alamcenarla
                if ($_FILES['blog']['tmp_name']['imagen']) {
                    $imagen->save(carperta_imagenes . $nombreImagen);
                }
                //Actualizar datos
                $blog->guardar();
            }
        }
        $router->render('blog/actualizar', [
            'blog' => $blog,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }
    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //obtener id
            $id = $_POST['id'];
            //validar que se aentero
            $id = filter_var($id, FILTER_VALIDATE_INT);
            //si existe
            if($id){
                //buscar tipo
                $tipo = $_POST['tipo'];
                //validar si el tipo existe
                if(validarTipoContenido($tipo)){
                    //guardar el id en memoria
                    $blog = Blog::find($id);
                    //eliminar blog
                    $blog->eliminar();
                }
            }
            
        }

    }
}
