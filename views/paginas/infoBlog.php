<p class="info-meta">Escrito el: <span>
        <?php
        //convertir al formto español
        $fechaConv = DateTime::createFromFormat('Y-m-d', $blog->fecha);
        //salga como dia/mes/año  
        echo $fechaConv->format('d-m-Y');
        ?>
    </span>
    por:
    <span>
        <?php
        foreach ($vendedores as $vendedor) {
            if ($blog->id_vendedor === $vendedor->id) {
                echo s($vendedor->nombre) . " " . s($vendedor->apellido);
            }
        }
        ?>
    </span>
</p>