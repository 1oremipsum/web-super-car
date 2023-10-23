<?php 
    $slugCategoria = explode('/',$_GET['url'])[1];
    $verificaCategoria = MySql::conectar()->prepare("SELECT `slug`, `id` FROM `tb_site.categorias` WHERE slug = ?");
    $verificaCategoria->execute(array($url[1]));

    if($verificaCategoria->rowCount() == 0){
        Painel::redirect(INCLUDE_PATH.'noticias');
    }

    $categoriaInfo = $verificaCategoria->fetch();
    $noticia = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE slug = ? AND categoria_id = ?");
    $noticia->execute(array($url[2], $categoriaInfo['id']));

    if($noticia->rowCount() == 0){
        Painel::redirect(INCLUDE_PATH.'noticias');
    }

    $noticia = $noticia->fetch();
?>
<section class="noticia-single">
    <div class="center">
        <header>
            <h1 class="data right"><i class="fa-regular fa-calendar-days"></i> <?php echo $noticia['data'];?></h1>
            <h1><?php echo $noticia['titulo'];?></h1>
        </header>
        <article>
            <?php echo $noticia['conteudo'];?>
        </article>
    </div><!-- center -->
</section><!-- noticia-single -->