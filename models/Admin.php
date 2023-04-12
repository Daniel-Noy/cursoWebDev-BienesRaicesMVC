<?php
namespace Model;

class Admin extends ActiveRecord {
    protected static $tabla = 'usuarios';

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? null;
        $this->password = $args["password"] ?? null;
    }

    public function validarErrores() {
        if(!$this->email) {
            self::$errores[] = "El email es obligatorio";
        }
        if(!$this->password) {
            self::$errores[] = "El email es obligatorio o no es valido";
        }

        return self::$errores;
    }

    public function existeUsuario($email) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE email = '$email' LIMIT 1";
        $res = self::consultaSQL($query);


        if(empty($res)) {
            self::$errores[] = "Usuario no encontrado";
        }

        return array_shift($res);
    }

    public function comprobarContraseña ($usuario) {
        $autenticado =  password_verify($this->password, $usuario->password);

        if(!$autenticado) {
            self::$errores[] = "Contraseña incorrecta";
        } else {
        }

        return $autenticado;
    }

    public function autenticarUsuario() {
        session_start();

        $_SESSION["usuario"] = $this->email;
        $_SESSION["login"] = true;

        header("Location: /admin");
    }
}