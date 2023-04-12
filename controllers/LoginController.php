<?php
namespace Controllers;

use Model\Admin;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $empty = true;
        $errores = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $auth = new Admin($_POST);
            $errores = $auth->validarErrores();

            if(empty($errores)) {
                $usuario = $auth->existeUsuario($auth->email);

                if(!$usuario) {
                    $errores = Admin::getErrores();
                } else {
                    $passauth = $auth->comprobarContraseña($usuario);

                    if(!$passauth) {
                        $errores = Admin::getErrores();
                    } else {
                        $auth->autenticarUsuario();
                    }
                }


            }
        }

        $router->render("/auth/login", [
            "empty" => $empty,
            "errores" => $errores
        ]);
    }
    
    public static function logout() {
        session_start();
        $_SESSION = [];
        header("Location: /");
    }

}