<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {

    public static function index(Router $router) {

        $inicio = true;
        $limite = 3;
        $propiedades = Propiedad::get($limite);

        $router->render("/paginas/index", [
            "inicio" => $inicio,
            "limite" => $limite,
            "propiedades" => $propiedades
        ]);
    }

    public static function nosotros(Router $router) {
        $router->render("/paginas/nosotros");
    }

    public static function propiedades(Router $router) {

        $limite = 10;
        $propiedades = Propiedad::get($limite);

        $router->render("/paginas/propiedades", [
            "limite" => $limite,
            "propiedades" => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {
        
        $id = validarORedireccionar("/propiedades");
        $propiedad = Propiedad::find($id);

        $router->render("/paginas/propiedad", [
            "propiedad" => $propiedad
        ]);
    }

    public static function blog(Router $router) {
        $router->render("/paginas/blog");
    }

    public static function entrada(Router $router) {
        $router->render("/paginas/entrada");
    }

    public static function contacto(Router $router) {

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $datos = $_POST;

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "sandbox.smtp.mailtrap.io";
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = "9221adb293d6ee";
            $mail->Password = "4fd4e01c68916b";
            $mail->SMTPSecure = "tls";

            //* Configuracion del email
            $mail->setFrom("admin@bienesraices.com");
            $mail->addAddress("admin@bienesraices.com", "BienesRaices.com");
            $mail->Subject = "Tienes un Nuevo Mensaje";
            $mail->isHTML();
            $mail->CharSet = "UTF-8";

            //* Contenido del email
            $contenido = "<html>";
            $contenido .= "<p>Tienes un nuevo mensaje</p>";
            $contenido .= "<p>!Hola {$datos["nombre"]}¡</p>";
            $contenido .= "<p>Recibimos el sig. mensaje de tu parte:</p>";
            $contenido .= "<p>{$datos["mensaje"]}</p>";

            if($datos["metodo-contacto"] === "telefono") {
                $contenido .= "<p>Enviamos este mensaje para que estes al pendiente de tu telefono: {$datos["telefono"]}</p>";
                $contenido .= "<p>el dia {$datos["fecha"]} para que podamos hablar contigo</p>";
            } else {
                $contenido .= "<p>Como elegiste que te contactemos por email estaremos al pendiente de tus preguntas por este medio</p>";
            }
            $contenido .= "</html>";
            
            $mail->Body = $contenido;

            if($mail->send()) {
                echo "Mensaje enviado";
            } else {
                echo "El mensaje no se puedo enviar";
            }
        }

        $router->render("/paginas/contacto");
    }

}