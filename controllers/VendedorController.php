<?php
namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function crear(Router $router) {
        
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $vendedor = new Vendedor($_POST);
            
            $errores = $vendedor->validarErrores();
            if(empty($errores)) {
        
                $res = $vendedor->guardar();
        
                if($res) {
                    header("Location: /admin?resultado=4");
                }
            }
        }

        $router->render("/vendedores/crear", [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router) {

        $id = validarORedireccionar("/admin");

        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $args = $_POST;
            $vendedor->sincronizar($args);
        
            $errores = $vendedor->validarErrores();
            if(empty($errores)) {
                $vendedor->actualizar();
            }
        }

        $router->render("/vendedores/actualizar", [
            "vendedor" => $vendedor,
            "errores" => $errores

        ]);
    }

    public static function eliminar() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
            $id = validarORedireccionar("/admin", "POST");

            if($id) {
                $tipo = $_POST["tipo"];
                if(validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}