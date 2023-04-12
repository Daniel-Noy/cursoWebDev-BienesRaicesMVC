<?php 
    //Obtener a los vendedores de la base

use Model\Vendedor;

$vendedores = Vendedor::all();
?>

<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo</label>
    <input type="text" 
    id="titulo" 
    name="titulo" 
    placeholder="Titulo Propiedad" 
    value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio</label>
    <input type="number" 
    id="precio" 
    name="precio" 
    placeholder="Precio Propiedad" 
    value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen</label>
    <input type="file" 
    id="imagen" 
    name="imagen"
    accept="image/jpeg, image/png">

    <?php if( $propiedad->imagen ) { ?>
        <img src="../../imagenes/<?php echo $propiedad->imagen ?>" alt="">
    <?php } ?>

    <label for="descripcion">Descripcion:</label>
    <textarea 
    id="descripcion" 
    name="descripcion" 
    rows="10"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Informacion Propiedad</legend>

    <label for="habitaciones">habitaciones</label>
    <input type="number" 
    name="habitaciones" 
    id="habitaciones" 
    placeholder="Ej: 3" 
    value="<?php echo s($propiedad->habitaciones); ?>">

    <label for="wc">Baños</label>
    <input type="number" 
    name="wc" id="wc" 
    placeholder="Ej: 2" 
    value="<?php echo s($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamiento</label>
    <input type="number" 
    name="estacionamiento" 
    id="estacionamiento" 
    placeholder="Ej: 2" 
    value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <select name="vendedorId">
        <option disabled selected>--Seleccionar--</option>
        <?php foreach($vendedores as $vendedor) { ?>
            <option 
                <?php 
                    echo $vendedor->id === $propiedad->vendedorId ? 'selected' : ''; ?>  
                    value="<?php echo s($vendedor->id) ?>">
                    <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?>
            </option>
        <?php } ?>
    </select>
</fieldset>