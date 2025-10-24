<fieldset>
    <legend>Informacion General del vendedor</legend>

    <label for="nombre"> Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido"> Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido del vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">

</fieldset>
<fieldset>
    <legend>Datos de Contacto</legend>
     <label for="telefono"> Telefono:</label>
    <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="Numero de telefono del vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>