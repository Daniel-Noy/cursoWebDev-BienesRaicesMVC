<?php
namespace Controllers;

use Model\Propiedad;
use Model\Vendedor;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;


class PropiedadController {
    public static function index(Router $router)
    {
        isAuth();

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET["resultado"] ?? null;

        $router->render("propiedades/admin", [
            "propiedades" => $propiedades,
            "resultado" => $resultado,
            "vendedores" => $vendedores
        ]);
    }

    public static function crear(Router $router)
    {
        isAuth();
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $propiedad = new Propiedad($_POST);
    
            // Generar nombre unico a las imagenes
            $imagen = $_FILES["imagen"];

            $extensionImagen = pathinfo($imagen["name"], PATHINFO_EXTENSION);
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".{$extensionImagen}";
            
            if($imagen["tmp_name"]) {
                // Se cambia el tamaño de la imagen
                $image = Image::make($imagen["tmp_name"])->fit(800, 600);
                $propiedad->setImage($nombreImagen);
            }
            
            // Valida que no haya errores antes de enviar la peticion a la base de datos
            $errores = $propiedad->validarErrores();
            if(empty($errores)){
        
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                
                $resultado = $propiedad->guardar();
        
                if($resultado) {
                    header('Location: /admin?resultado=1');
                }
            }   
        }


        $router->render('propiedades/crear', [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);

        
    }

    public static function actualizar(Router $router)
    {
        isAuth();
        $id = validarORedireccionar("/admin");

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        
        if($_SERVER["REQUEST_METHOD"] === 'POST') {
            
            $imagen = $_FILES["imagen"];
            $args = [];
            
            foreach($_POST as $key => $value) {
                $args[$key] = $_POST[$key] ?? NULL;
            }
            
            $propiedad->sincronizar($args);
            $errores = $propiedad->validarErrores();

            if(empty($errores)){
                if($imagen["tmp_name"]) {
                    $extensionImagen = pathinfo($imagen["name"], PATHINFO_EXTENSION);
                    $nombreImagen = md5( uniqid( rand(), true ) ) . ".{$extensionImagen}";
    
                    $image = Image::make($imagen["tmp_name"])->fit(800, 600);
                    $propiedad->setImage($nombreImagen);
        
                    //Crear una carpeta
                    if(!is_dir(CARPETA_IMAGENES)) {
                        mkdir(CARPETA_IMAGENES);
                    }
                    $image->save(CARPETA_IMAGENES . $nombreImagen); 
                }
                
                $propiedad->actualizar();
            }   
            
        }    

        $router->render("propiedades/actualizar", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }

    public static function eliminar()
    {
        isAuth();
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
            $id = validarORedireccionar("/admin", "POST");

            if($id) {
                $tipo = $_POST["tipo"];
                if(validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }


        }
    }
}