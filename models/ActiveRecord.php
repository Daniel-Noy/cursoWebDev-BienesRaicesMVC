<?php
namespace Model;

class ActiveRecord {
    protected static $db;
    protected static $errores = [];
    protected static $tabla = "";

    public $id = "";

    public static function setDB($database) {
        self::$db = $database;
    }
    
    public function sanitizarDatos() {
        $datos = get_object_vars($this);
        $sanitizados = [];

        foreach($datos as $key=>$value) {
            if($key === "id") continue;
            $sanitizados[$key] = self::$db->escape_string($value);
        }

        return $sanitizados;
    }

    //* Manejo de errores
    public static function getErrores() {
        return static::$errores;
    }

    //*Active record
    public static function consultaSQL($query) {
        $res = self::$db->query($query);

        $arr = [];

        while($registro = $res->fetch_assoc()) {
            $arr[] = static::crearObjeto($registro);
        }

        $res->free();

        return $arr;
    }
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
        $res = self::consultaSQL($query);

        return array_shift($res);
    }

    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }


    //* CRUD
    public function guardar() {

        $atributos = $this->sanitizarDatos();
        $keys = join(", ", array_keys($atributos));
        $values = join("', '", array_values($atributos));

        $query = "INSERT INTO " . static::$tabla . " ({$keys}) VALUES ('{$values}')";

        $res = self::$db->query($query);
        return $res;
    }

    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;
        $res = self::consultaSQL($query);

        return $res;
    }
    public static function get($limite){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $limite;
        $res = self::consultaSQL($query);

        return $res;
    }
    
    public function actualizar() {
        $atributos = $this->sanitizarDatos();
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }
        $valores = join(", ", $valores);
        
        $query = "UPDATE ". static::$tabla . " SET {$valores} WHERE id = {$this->id} LIMIT 1";
        $res = self::$db->query($query);

        if($res) {
            if(static::$tabla === "propiedades") {
                header('Location: /admin?resultado=2');
            } else if(static::$tabla === "vendedores") {
                header('Location: /admin?resultado=5');
            }
            
        }
    }

    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $res = self::$db->query($query);
        
        if($res) {

        if(static::$tabla === "propiedades"){
            //TODO Propiedad::borrarImagen();
            header('Location: /admin?resultado=3');

        } else if (static::$tabla === "vendedores") {
            header('Location: /admin?resultado=6');
        }
        }
    }
}