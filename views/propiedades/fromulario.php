<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo"> Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo de la propiedad" value="<?php echo s($propiedad->titulo) ?>">

    <label for="precio"> Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio de la propiedad" value="<?php echo s($propiedad->precio) ?>">

    <label for="imagen"> Imagen:</label>
    <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg , image/png">
    <?php if ($propiedad->imagen): ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-actulizar" alt="Imagen de la propiedad">
    <?php endif; ?>

    <label for="descripcion"> Descripcion:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"> <?php echo s($propiedad->descripcion) ?></textarea>
</fieldset>

<fieldset>
    <legend>Informacion propiedad</legend>

    <label for="habitaciones"> Numero de habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej:3" min="1" max="9" value="<?php echo s($propiedad->habitaciones) ?>">

    <label for="WC"> Numero de baños:</label>
    <input type="number" id="WC" name="propiedad[WC]" placeholder="Ej:3" min="1" max="9" value="<?php echo s($propiedad->WC) ?>">

    <label for="estacionamientos"> Numero de estacionamientos:</label>
    <input type="number" id="estacionamientos" name="propiedad[estacionamientos]" placeholder="Ej:3" min="1" max="9" value="<?php echo s($propiedad->estacionamientos) ?>">
</fieldset>
<fieldset>
    <legend>vendedor</legend>
    <label for="vendedor"> Vendedor</label>
    <select name="propiedad[vendedorId]" id="vendedor">
        <option value="" selected>>--SELECCIONE--<</option>
                <?php foreach ($vendedores as $vendedor): ?>
        <option
            <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : ''; ?>
            value="<?php echo s($vendedor->id) ?>">
            <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido) ?>
        </option>
    <?php endforeach; ?>
    </select>
</fieldset>