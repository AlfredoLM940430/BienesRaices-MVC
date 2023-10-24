<?php 

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router){

        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router){
        
        $router->render('paginas/nosotros');
    }

    public static function anuncios(Router $router){

        $propiedades = Propiedad::get(10);
        $router->render('paginas/anuncios', [
            'propiedades' => $propiedades
        ]);
    }

    public static function anuncio(Router $router){

        //Valida ID valido
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header('Location: /');
        }

        $propiedad = Propiedad::find($id);

        $router->render('paginas/anuncio', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router){
        
        $router->render('paginas/blog');
    }
    

    public static function contacto(Router $router){

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuestas = $_POST['contacto'];
            
            //Crear instacia phpmailer
            $mail = new PHPMailer(true);

            //Configurar SMPT *protocolo envio de emails
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth	= true;
            $mail->Username = '16323b864a8056';
            $mail->Password = '61c257944c7da2';
            $mail->SMTPSecure = 'tls';
            $mail->Port = '2525';

            //Configurar contenido email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje </p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';

            //Envios condicionales
            if($respuestas['contacto'] === 'telefono'){
                //Telefoon
                $contenido .= '<p> Contactar mediante Telefono </p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha de Contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora de Contacto: ' . $respuestas['hora'] . '</p>';

            } else {
                //Email
                $contenido .= '<p> Contactar mediante Email </p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>precio: $ ' . $respuestas['precio'] . '</p>';
            $contenido .= '<p>Preferencia: ' . $respuestas['contacto'] . '</p>';

            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'texto alternativo';
            
            //Enviar email
            if($mail->send()){
                $mensaje = 'mensaje enviado';
            }else{
                $mensaje = 'error';
            }

        }
        
        $router->render('paginas/contacto',[
            'mensaje' => $mensaje
        ]);
    }
}