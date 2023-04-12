<?php 
namespace Model;

class Vendedor extends ActiveRecord {
    protected static $tabla = "vendedores";

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
    }
//TODO Validar con expresiones regulares
    public function validarErrores() {
        $errores = [];

        if(!$this->nombre) {
            self::$errores[] = "Debes añadir el nombre";
        }
        if(!$this->apellido) {
            self::$errores[] = "Debes añadir el apellido";
        }
        if(!$this->telefono) {
            self::$errores[] = "El telefono es obligatorio";
        }
        if(!preg_match("/[0-9]{10}/", $this->telefono)) {
            self::$errores[] = "Formato de telefono no valido";
        }

        return self::$errores;
    }
}