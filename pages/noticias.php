<?php 
    $url = explode('/', $_GET['url']);
    if(!isset($url[2])){    // noticias[0]/categoria[1]/nome-da-noticia[2]
        $categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
        $categoria->execute(array(@$url[1]));
        $categoria = $categoria->fetch();
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
                        <option value="" selected="">Todas as categorias</option>
                        <?php 
                            $categorias = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ORDER BY order_id ASC");
                            $categorias->execute();
                            $categorias = $categorias->fetchAll();
                            foreach ($categorias as $key => $value) {
                        ?>
                        <option <?php if($value['slug'] == @$url[1]) echo 'selected'; ?> value="<?php echo $value['slug']; ?>"><?php echo $value['nome']; ?></option>
                        <?php } ?>
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
                <?php
                    if(@$categoria['nome'] == ''){
                        echo '<h2>Visualizando todas as notícias</h2>';
                    }else{
                        echo '<h2>Visualizando notícias em <b>'.$categoria['nome'].'</b></h2>';
                    }

                    $query = "SELECT * FROM `tb_site.noticias` ";
                    if(@$categoria['nome'] != ''){
                        $query.="WHERE categoria_id = $categoria[id]";
                    }

                    $valorPorPg = 3;
                    $query1 = "SELECT * FROM `tb_site.noticias` ";
                    if(@$categoria['nome'] != ''){
                       $categoria['id'] = (int)$categoria['id'];
                       $query1.="WHERE categoria_id = $categoria[id]";
                    }
                    $totalPg = MySql::conectar()->prepare($query1);
                    $totalPg->execute();
                    $totalPg = ceil($totalPg->rowCount() / $valorPorPg);

                    if(isset($_GET['pagina'])){
                        $pagina = (int)$_GET['pagina'];
                        if($pagina > $totalPg){
                            $pagina = $totalPg;
                        }else if($pagina <= 0){
                            $pagina = 1;
                        }
                        $queryPg = ($pagina - 1) * $valorPorPg;
                        $query.= " ORDER BY order_id DESC LIMIT $queryPg, $valorPorPg";
                    }else {
                        $pagina = 1;
                        $query.= " ORDER BY order_id DESC LIMIT 0,$valorPorPg";
                    }

                    $sql = MySql::conectar()->prepare($query);
                    $sql->execute();
                    $noticias = $sql->fetchAll();
                ?>
            </div><!-- header-conteudo-portal -->
            <?php 
                foreach ($noticias as $key => $value) {
                    $sql = MySql::conectar()->prepare("SELECT `slug` FROM `tb_site.categorias` WHERE id = ?");
                    $sql->execute(array($value['categoria_id']));
                    $categoriaNome = $sql->fetch()['slug'];
            ?>
            <div class="box-single-conteudo">
                <h2><?php echo date('d/m/Y', strtotime($value['data'])); ?> - <?php echo $value['titulo']; ?></h2>
                <p><?php echo substr(strip_tags($value['conteudo']),0,455).'...'; ?></p>
                <a href="<?php echo INCLUDE_PATH; ?>noticias/<?php echo $categoriaNome; ?>/<?php echo $value['slug']; ?>">Leia mais</a>
            </div><!-- box-single-conteudo -->
            <?php } ?>
            <div class="pages">
                <?php 
                    for ($i=1; $i <= $totalPg; $i++) { 
                        @$catStr = ($categoria['nome'] != '') ? '/'.$categoria['slug'] : '';
                        if(@$pagina == $i){
                            echo '<a class="active-page" href="'.INCLUDE_PATH.'noticias'. $catStr.'?pagina='.$i.'">'.$i.'</a>';
                        }else{
                            echo '<a href="'.INCLUDE_PATH.'noticias'. $catStr.'?pagina='.$i.'">'.$i.'</a>';
                        }
                    }
                ?>
        </div><!-- pages --> 
        </div><!-- conteudo-portal -->   
        <div class="clear"></div>
    </div><!-- center -->
</section><!-- container-portal -->
<?php 
    }else{ 
        include('noticia_single.php');
    }
?>