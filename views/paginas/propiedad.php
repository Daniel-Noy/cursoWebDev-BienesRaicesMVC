<main class="propiedad || seccion">
        <h1><?php echo $propiedad->titulo ; ?></h1>
        
        <div class="propiedad-contenedor || contenedor contenido-centrado">
            <img src="/imagenes/<?php echo $propiedad->imagen ; ?>" alt="Imagen casa">
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
            <div class="anuncio-informacion">
            <?php echo $propiedad->descripcion ; ?>
            </div>
        </div>
    </main>