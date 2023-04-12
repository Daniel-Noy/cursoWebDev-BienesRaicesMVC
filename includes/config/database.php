<?php
// Funcion para importar la conexion a la base de datos a cualquier archivos
function conectarDB() : mysqli {
    $db = new mysqli(
        $_ENV["DB_HOST"],
        $_ENV["DB_USER"],
        $_ENV["DB_PASS"],
        $_ENV["DB_NAME"]
    );

    if(!$db) {
        echo "Error, no se pudo conectar a la base de datos";
        exit;
    }

    return $db;
}