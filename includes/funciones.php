<?php 
// Crea constantes que apunten a los archivos correspondientes sin tener que escribir todo el directorio
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER["DOCUMENT_ROOT"] . '/imagenes/');

function incluirTemplate(string $nombre, $inicio = false, $empty = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

// Control de la sesion del usuario
function autenticarSesion($private = false) {
    if(!$_SESSION) {
        session_start();
    }

    $auth = $_SESSION["login"];

    if($private) {
        if(!$auth) {
            header("Location: /");
            return;
        }
    }

    if($auth) {
        return true;
    }

    return false;

}

// Helpers
function debuguear($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';

    exit;
}

function s($html) {
    $s = htmlspecialchars($html);
    return $s;
}

function validarTipoContenido($tipo) {
    $tipos = ["propiedad", "vendedor"];

    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo) {
    $mensaje = "";

    switch ($codigo) {
        case 1:
            $mensaje = "Propiedad publicada";
            break;
        case 2:
            $mensaje = "Propiedad actualizada";
            break;
        case 3:
            $mensaje = "Propiedad eliminada correctamente";
            break;
        case 4:
            $mensaje = "Vendedor creado";
            break;
        case 5:
            $mensaje = "Vendedor actualizado";
            break;
        case 6:
            $mensaje = "Vendedor eliminado";
            break;
        default:
            $mensaje = NULL;
            break;
    }

    return $mensaje;
}

function validarORedireccionar(string $url, string $metodo = "GET") {

    if($metodo === "GET") {
        $id = $_GET["id"];
    } else {
        $id = $_POST["id"];
    }

    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: {$url}");
    }

    return $id;
}

function current_page(string $path) : bool {
    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path);
}