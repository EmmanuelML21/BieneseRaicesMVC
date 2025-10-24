<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar sesíon</h1>
    <?php foreach($errores as $error): ?>
        <p class="alerta error"><?php echo $error; ?></p>
    <?php endforeach;?>
    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <!--Email-->
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Tu email" id="email" required>
            <!--Nombre-->
            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Tu contraseña" id="password" required>
        </fieldset>
        <input type="submit" value="Iniciar Sesíon" class="boton boton-verde">
    </form>
</main>