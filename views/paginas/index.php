<main class="contenedor">
    <?php include 'iconos.php'; ?>
</main>
<section class="seccion contenedor">
    <h2>Casa y departamentos en Venta</h2>

    <?php
    include 'listado.php';
    ?>

    <div class="alinear-derecha">
        <a href="/propiedades" class="boton-verde">Ver Todas</a>
    </div>
</section>

<section class="imagen-contanto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el fromulario de contacto y un asesor se pondra en contacto contigo a la brevedad</p>
    <a href="/contacto" class="boton-amarillo">Contactanos</a>
</section>

<div class="contenedor seccion inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>
        <?php include 'listadoBlogs.php'; ?>
    </section><!--blog-->
    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonal">
            <blockquote>
                El personal se comporto de una forma excelete, muy buena atencion y la
                casa que me ofrecieron cumplio todas mis expectativas
            </blockquote>
            <p>- Emmmanuel Meneses</p>
        </div>
    </section>
</div>