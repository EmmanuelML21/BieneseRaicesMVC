<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo"> Titulo:</label>
    <input type="text" id="titulo" name="blog[titulo]" placeholder="Titulo de la blog" value="<?php echo s($blog->titulo) ?>">

</fieldset>

<fieldset>
    <legend>Contenido del Blog</legend>

    <label for="imagen"> Imagen:</label>
    <input type="file" id="imagen" name="blog[imagen]" accept="image/jpeg , image/png">
    <?php if ($blog->imagen): ?>
        <img src="/imagenes/<?php echo $blog->imagen ?>" class="imagen-actulizar" alt="Imagen de la propiedad">
    <?php endif; ?>

    <label for="descripcionBreve"> Descripcion:</label>
    <textarea class="breve" id="descripcionBreve" name="blog[descripcionBreve]"> <?php echo s($blog->descripcionBreve) ?></textarea>

    <label for="descripcion"> Contenido del blog:</label>
    <textarea id="descripcion" name="blog[descripcion]"> <?php echo s($blog->descripcion) ?></textarea>
</fieldset>
<fieldset>
    <legend>Autor del blog</legend>
    <label for="vendedor"> autores </label>
    <select name="blog[id_vendedor]" id="vendedor">
        <option value="" selected> >--SELECCIONE--< </option>
                <?php foreach ($vendedores as $vendedor): ?>
        <option
            <?php echo $blog->id_vendedor === $vendedor->id ? 'selected' : ''; ?>
            value="<?php echo s($vendedor->id) ?>">
            <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido) ?>
        </option>
    <?php endforeach; ?>
    </select>
</fieldset>