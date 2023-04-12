<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>


    <?php if($resultado) { 
        $mensaje = mostrarNotificacion(intval($resultado));
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo $mensaje; ?></p>
    <?php }} ?>
    
    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>
    
    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>    
                <td>ID</td>
                <td>Titulo</td>
                <td>Imagen</td>
                <td>Precio</td>
                <td>Acciones</td>
            </tr>
        </thead>

        <tbody>
            <?php foreach( $propiedades as $propiedad) {  //Crea una propiedad en la tabla por cada propiedad que haya en la base de datos?>
            <tr>
                <td><?php echo $propiedad->id ?></td>
                <td><?php echo $propiedad->titulo ?></td>
                <td><img class="imagen-tabla" <?php echo "src=/imagenes/{$propiedad->imagen}" ?> alt="Imagen propiedad"></td>
                <td>$<?php echo $propiedad->precio ?></td>
                <td>
                    <form method="POST" action="/propiedades/eliminar">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                        
                    <a class="boton-amarillo-block" href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>
    <!--//TODO Cambiar el nombre de la clase en sass para que las dos tablas tengan las mismas propiedades -->
    <table class="propiedades"> 
        <thead>
            <tr>    
                <td>ID</td>
                <td>Nombre</td>
                <td>Telefono</td>
                <td>Acciones</td>
            </tr>
        </thead>

        <tbody>
            <?php foreach( $vendedores as $vendedor) { ?>
            <tr>
                <td><?php echo $vendedor->id ?></td>
                <td><?php echo "{$vendedor->nombre} {$vendedor->apellido}" ?></td>
                <td><?php echo $vendedor->telefono ?></td>
                <td>
                    <form method="POST" action="/vendedores/eliminar">
                        <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                        
                    <a class="boton-amarillo-block" href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>">Actualizar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</main>