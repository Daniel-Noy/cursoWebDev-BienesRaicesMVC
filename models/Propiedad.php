<?php 
namespace Model;

class Propiedad extends ActiveRecord {
    protected static $tabla = "propiedades";

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? "";
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamiento = $args["estacionamiento"] ?? "";
        $this->creado = date("Y-m-d");
        $this->vendedorId = $args["vendedorId"] ?? "";
    }

    public function validarErrores() {
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }
        if(!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }
        if(!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }
        if(strlen($this->descripcion) < 50 ) {
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$this->habitaciones) {
            self::$errores[] = "El número de habitaciones es obligatorio";
        }
        if(!$this->wc) {
            self::$errores[] = "El número de baños es obligatorio";
        }
        if(!$this->estacionamiento) {
            self::$errores[] = "El numero de estacionamientos es obligatorio";
        }
        if(!$this->vendedorId) {
            self::$errores[] = "Debes elegir al vendedor";
        }

        return self::$errores;
    }

    //*Imagenes
    public function setImage($imagen) {
        $this->borrarImagen();
        $this->imagen = $imagen;
    }
    public function borrarImagen() {
        if($this->id) {
            $existeImagen = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeImagen) {
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }
    }

    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $res = self::$db->query($query);
        
        if($res) {

        if(static::$tabla === "propiedades"){
            Propiedad::borrarImagen();
            header('Location: /admin?resultado=3');

        } else if (static::$tabla === "vendedores") {
            header('Location: /admin?resultado=6');
        }
        }
    }
}