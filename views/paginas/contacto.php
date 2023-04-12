<main class="contenedor || seccion">
    <h1>Contacto</h1>

    <div class="contacto || contenido-centrado contenedor">
        <img src="./build/img/destacada3.webp" alt="Imagen de una casa">

        <h2>Llena el formulario de contacto</h2>

        <form class="formulario" method="POST">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre">

                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje" rows="10"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre Propiedad</legend>

                <label for="tipo-operacion">Vende o Compra</label>
                <select name="tipo-operacion" id="tipo-operacion">
                    <option value="default" disabled selected>--Seleccione--</option>
                    <option value="venta">Venta</option>
                    <option value="compra">Compra</option>
                </select>

                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" value="0" min="0">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>
                <label for="metodo-telefono">Telefono</label>
                <input type="radio" value="telefono" name="metodo-contacto" id="metodo-telefono">

                <label for="metodo-email">Email</label>
                <input type="radio" value="email" name="metodo-contacto" id="metodo-email" checked>

                <div class="inputs-contacto">
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" id="email" placeholder="Tu Correo Electronico">
                </div>
            </fieldset>
            
            <input type="submit" value="Enviar" class="boton boton-verde">
        </form>
    </div>
</main>