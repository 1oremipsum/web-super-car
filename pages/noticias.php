<?php 
    $url = explode('/', $_GET['url']);
    if(!isset($url[2])){    // noticias[0]/categoria[1]/nome-da-noticia[2]
?>
<section class="header-noticias">
    <div class="center">
        <h2><i class="fa-regular fa-paper-plane"></i></h2> 
        <h2>Acompanhe as últimas <b>notícias do portal</b></h2>
    </div><!-- center -->
</section><!-- header-noticias -->

<section class="container-portal">
    <div class="center">
        <div class="sidebar">
            <div class="box-content-sidebar">
                <h3>Realizar busca <i style="padding: 0 5px" class="fa-solid fa-magnifying-glass"></i></h3>
                <form>
                    <input type="text" name="busca" placeholder="O que deseja pesquisar?" required>
                    <input type="submit" name="acao" value="Buscar!">
                </form>
            </div><!-- box-content-sidebar -->

            <div class="box-content-sidebar">
                <h3>Selecione a categoria <i style="padding: 0 5px" class="fa-solid fa-tags"></i></h3>
                <form>
                    <select name="categoria">
                        <?php 
                            $categorias = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ORDER BY order_id ASC");
                            $categorias->execute();
                            $categorias = $categorias->fetchAll();
                            foreach ($categorias as $key => $value) {
                        ?>
                        <option value="<?php echo $value['slug']; ?>"><?php echo $value['nome']; ?></option>
                        <?php 
                            }
                        ?>
                    </select>
                </form>
            </div><!-- box-content-sidebar -->

            <div class="box-content-sidebar">
                <h3>Sobre o autor <i style="padding: 0 5px" class="fa-solid fa-user"></i></h3>
               <div class="autor-box-portal">
                    <div class="box-img-autor"></div>
                    <div class="texto-autor-portal">
                        <h3>Allan Sanches</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed nisi magnam numquam commodi in culpa consectetur hic enim blanditiis, sunt, voluptates distinctio vitae quisquam aut molestiae. Sapiente deserunt qui exercitationem.</p>
                    </div>
               </div>
            </div><!-- box-content-sidebar -->
        </div><!-- sidebar -->
        <div class="conteudo-portal">
            <div class="header-conteudo-portal">
                <!-- <h2>Visualizando todas as notícias</h2> -->
                <h2>Visualizando Notícias de <b>Automóveis Novos</b></h2>
            </div><!-- header-conteudo-portal -->
            <?php 
                for($i=0;$i<6;$i++){
            ?>
            <div class="box-single-conteudo">
                <h2>19/10/2023 - Conheça os novos modelos de auto...</h2>
                <p> A prática cotidiana prova que a execução dos pontos do programa assume importantes posições no estabelecimento das condições financeiras e administrativas exigidas. Desta maneira, a complexidade dos estudos efetuados maximiza as possibilidades por conta dos procedimentos normalmente adotados. Não obstante, o desenvolvimento contínuo de distintas formas de atuação cumpre um papel essencial na formulação do orçamento set...</p>
                <a href="<?php echo INCLUDE_PATH; ?>noticias/categoria/nome-do-post">Leia mais</a>
            </div><!-- box-single-conteudo -->
            <?php } ?>
        </div><!-- conteudo-portal -->   
        <div class="pages">
                <a class="active-page" href="">1</a>
                <a href="">2</a>
                <a href="">3</a>
                <a href="">4</a>
            </div><!-- pages --> 
        <div class="clear"></div>
    </div><!-- center -->
</section><!-- container-portal -->
<?php 
    }else{ 
        include('noticia_single.php');
    }
?>