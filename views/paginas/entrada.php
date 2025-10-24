<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $blog->titulo ?></h1>

    <picture>
        <img loading="lazy" src="/imagenes/<?php echo $blog->imagen ?>" alt="imagen de propiedad en venta">
    </picture>
    <?php include 'infoBlog.php' ?>
    <div class="resumen-propiedad">
        <p>
            <?php echo $blog->descripcion ?>
        </p>
    </div>
</main>