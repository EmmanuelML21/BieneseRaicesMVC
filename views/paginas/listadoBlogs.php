<?php foreach ($blogs as $blog): ?>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <img src="/imagenes/<?php echo $blog->imagen ?>" alt="Texto entrada de blog">
                    </picture>
                </div><!--imagen-->
                <div class="texto-entrada">
                    <a href="/entrada?id=<?php echo $blog->id ?>">
                        <h4><?php echo $blog->titulo; ?></h4>
                       <?php include 'infoBlog.php'; ?>
                        <p>
                            <?php echo $blog->descripcionBreve; ?>
                        </p>
                    </a>
                </div><!--texto-entrada-->
            </article><!--entrada-blog-->
        <?php endforeach; ?>