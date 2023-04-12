<fieldset>
    <legend>Informacion del vendedor</legend>

    <label for="nombre">Nombre</label>
    <input type="text" 
    id="nombre"
    name="nombre"
    placeholder="Nombre"
    value="<?php echo s($vendedor->nombre)?>">

    <label for="apellido">Apellido</label>
    <input type="text" 
    id="apellido"
    name="apellido"
    placeholder="Apellido"
    value="<?php echo s($vendedor->apellido)?>">
    
    <label for="telefono">Telefono</label>
    <input type="tel" 
    id="telefono"
    name="telefono"
    placeholder="Telefono"
    value="<?php echo s($vendedor->telefono)?>">
</fieldset>