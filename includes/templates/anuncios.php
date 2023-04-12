<?php

use Model\Propiedad;

if($_SERVER["SCRIPT_NAME"] === "/anuncios.php") {
    $propiedades = Propiedad::all();
} else {
    $propiedades = Propiedad::get($limite);
}

?>


<div class="anuncios-contenedor">
    <?php foreach( $propiedades as $propiedad) { ?>
        <div class="anuncio">
            <figure>
                <img src="/imagenes/<?php echo $propiedad->imagen ;?>" alt="Imagen casa lago" loading="lazy">
            </figure>
            <div class="anuncio-informacion">
                <h3><?php echo $propiedad->titulo ; ?></h3>
                <p class="descripcion"><?php echo $propiedad->descripcion ; ?></p>
                <p class="costo">$<?php echo $propiedad->precio ; ?></p>

                <div class="habitaciones">
                    <div class="habitacion">
                        <img src="./build/img/iconos/icono_dormitorio.svg" alt="Icono dormitorio">
                        <p><?php echo $propiedad->habitaciones ; ?></p>
                    </div> <!--habitacion-->

                    <div class="habitacion">
                        <img src="./build/img/iconos/icono_estacionamiento.svg" alt="Icono estacionamiento">
                        <p><?php echo $propiedad->estacionamiento ; ?></p>
                    </div> <!--habitacion-->

                    <div class="habitacion">
                        <img src="./build/img/iconos/icono_wc.svg" alt="Icono baño">
                        <p><?php echo $propiedad->wc ; ?></p>
                    </div> <!--habitacion-->
                </div>  <!--habitaciones-->

                <a href="/anuncio.php?id=<?php echo $propiedad->id ;?>" class="ver-anuncio || boton-amarillo-block">Ver propiedad</a>
            </div> <!--informacion-->
        </div> <!--anuncio-->
    <?php } ?>
</div>
