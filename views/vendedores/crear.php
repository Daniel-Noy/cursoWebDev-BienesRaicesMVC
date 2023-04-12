<main class="contenedor seccion">
    <h1>Añadir vendedor</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php } ?>

    <form class="formulario" method="POST">    
        <?php include "formulario.php" ?>
        
        <input type="submit" value="Añadir vendedor" class="boton boton-verde">
    </form>
    
</main>