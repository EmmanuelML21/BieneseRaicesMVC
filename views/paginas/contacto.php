<main class="contenedor contenido-centrado">
    <h1>Contactanos</h1>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen contacto">
    </picture>
    <h2>Llene el formulario con sus datos</h2>
    <?php if($statusMensaje):?>
        <p class="alerta exito"><?php echo $statusMensaje ?></p>
    <?php endif;?>
    <form action="/contacto" method="POST" class="formulario">
        <!--Datos personales-->
        <fieldset>
            <legend>Infromacion Personal</legend><!--leyenda del formulario-->
            <!--Nombre-->
            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]" required>
            <!--Mensaje-->
            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>
        <!--Datos propiedad-->
        <fieldset>
            <legend>Informacion sobre Propiedad</legend><!--leyenda del formulario-->
            <!--Venta o contacto-->
            <label for="venta-contacto">Venta o contacto</label>
            <select id="venta-contacto" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vender</option>
            </select>
            <!--Precio o presupuesto-->
            <label for="cantidad">Precio o presupuesto</label>
            <input type="number" placeholder="Tu precio o presupuesto" id="cantidad" name="contacto[precio]" required>
        </fieldset>
        <!--Contacto-->
        <fieldset>
            <legend>Contacto</legend><!--leyenda del formulario-->
            <!--Como desea ser contactado-->
            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <!--Telefono-->
                <label for="contactar-telefono">Telefono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>
                <!--Email-->
                <label for="contactar-email">Email</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
            </div>
            <div id="contacto"></div>
        </fieldset>
      <input type="submit" value="Enviar" class="boton-verde" >
    </form>
</main>