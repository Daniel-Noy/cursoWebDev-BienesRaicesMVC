<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error) {?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php } ?>
    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email"  placeholder="Tu E-mail" required>
            
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password"  placeholder="Tu Contraseña" required>
        </fieldset>

        <input type="submit" value="Iniciar sesion" class="boton-verde">
    </form>
    <p>Admin: admin@correo.com</p>
    <p>Contraseña: 123456</p>
</main>