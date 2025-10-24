<main class="contenedor seccion">
    <h1>Admistrador de Bienes Raices</h1>
    <?php
    //que lea que resultado es y que lo convierta a int
    $mensaje = mostrarNotificaciones(intval($resultado));
    if ($mensaje):
    ?>
        <p class="alerta exito"><?php echo s($mensaje) ?></p>
    <?php endif; ?>
    <h2>Propiedades</h2>
    <a href="/propiedades/crear" class="boton boton-amarillo"> Nueva Propiedad</a>
   
    <table class="propiedades"><!--mostrar resultados-->
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($propiedades as $propiedad):  ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen tabla"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/propiedades/actulizar?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Vendedores</h2>
     <a href="/vendedores/crear" class="boton boton-amarillo"> Nuevo(a) Vendedor</a>
    <table class="propiedades"><!--mostrar resultados-->
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $vendedor):  ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                            <input type="hidden" name="tipo" value="vendedor">
                        </form>
                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Blogs</h2>
    <a href="/blog/crear" class="boton boton-amarillo"> Nuevo Blog</a>
   
    <table class="propiedades"><!--mostrar resultados-->
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blogs as $blog):  ?>
                <tr>
                    <td><?php echo $blog->id; ?></td>
                    <td><?php echo $blog->titulo; ?></td>
                    <td><img class="imagen-tabla" src="/imagenes/<?php echo $blog->imagen; ?>" alt="imagen tabla"></td>
                    <td> <?php echo $blog->fecha; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/blog/eliminar">
                            <input type="hidden" name="id" value="<?php echo $blog->id ?>">
                            <input type="hidden" name="tipo" value="blog">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/blog/actualizar?id=<?php echo $blog->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>