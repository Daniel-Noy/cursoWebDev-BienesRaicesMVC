<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {
        session_start();
        $auth = $_SESSION["login"] ?? null;

        $rutasProtegidas = ["/admin", "/propiedades/crear", "/propiedades/editar"];


        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];

        if($metodo === "GET") {
            $fn = $this->rutasGET[$urlActual] ?? NULL;
        }
        if($metodo === "POST") {
            $fn = $this->rutasPOST[$urlActual] ?? NULL;
        }

        if(in_array($urlActual, $rutasProtegidas) && !$auth) {
            header("Location: /login");
        }
        

        if($fn) {
            call_user_func($fn, $this);
        } else {
            header("Location: /");
        }
    }

    public function render($view, $datos = []) {

        foreach($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/{$view}.php";

        $contenido = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }
}