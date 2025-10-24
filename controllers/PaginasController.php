<?php

namespace Controllers;

use Model\Blog;
use Model\Propiedad;
use Model\Vendedor;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $blogs = Blog::get(2);
        $vendedores = Vendedor::all();
        //variable para que muestre nuestro banner
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio,
            'blogs' => $blogs,
            'vendedores' => $vendedores
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }
    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router)
    {
        //obtner el id de la URL y validarlo
        $id = ValidarORedireccionar('/propiedades');
        //si es valido buscalo
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router)
    {
        $vendedores = Vendedor::all();
        $blogs = Blog::all();
        $router->render('paginas/blog', [
            'vendedores' => $vendedores,
            'blogs' => $blogs
        ]);
    }
    public static function entrada(Router $router)
    {
        $id = ValidarORedireccionar('/blog');
        $blog = Blog::find($id);
        $vendedores = Vendedor::all();

        $router->render('paginas/entrada', [
            'blog' => $blog,
            'vendedores' => $vendedores
        ]);
    }
    public static function contacto(Router $router)
    {
        $statusMensaje = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];
            //crear un instancia de PHPMailer
            $mail = new PHPMailer();
            //configurar SMTP(protocolo)
            $mail->isSMTP();
            $mail->Host = 'host';
            $mail->SMTPAuth = true;
            $mail->Username = 'user';
            $mail->Password = 'password';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com'); //quien envia
            $mail->addAddress('admin@bienesesraices.com', 'BienesRaices.com'); //quien recibe
            $mail->Subject = 'tienes un nuevo menseaje'; //Asunto

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            //Definir contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o compra: ' . $respuestas['tipo'] . '</p>';
            if($respuestas['tipo'] === 'Vende'){
                $contenido .= '<p>Tiene un precio de: $' . $respuestas['precio'] . '</p>';
            }else{
                $contenido .= '<p>Tiene un presupuesto de: $' . $respuestas['precio'] . '</p>';
            }
            
            $contenido .= '<p>Desea ser contactado por ' . $respuestas['contacto'] . '</p>';
            
            //enviar de forma condicional algunos campos
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Desea agendar un cita el dia: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>En el horario de las: ' . $respuestas['hora'] . '</p>';
            } else {
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            }

            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'sin HTML';
            //enviar email
            if ($mail->send()) {
                $statusMensaje =  'Su mensaje se envio de forma correcta';
            } else {
                $statusMensaje = 'Su mensaje no se envio de forma correcta';
            }
        }
        $router->render('paginas/contacto', [
            'statusMensaje' => $statusMensaje
        ]);
    }
}
