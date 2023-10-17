<div class="box-content">
    <i class="fa-solid fa-newspaper"></i><h2> Cadastrar Notícia</h2>

    <form method="post" enctype="multipart/form-data">

        <?php  
            if(isset($_POST['acao'])){
                $categoria_id = $_POST['categoria_id'];
                $titulo = $_POST['titulo'];
                $conteudo = $_POST['conteudo'];
                $capa = $_FILES['imagem'];

                if($titulo == '' || $conteudo == ''){
                    Painel::alert('erro', 'Campos vazios não são permitidos!');
                }else if($capa['tmp_name'] == ''){
                    Painel::alert('erro', 'Selecione uma imagem de capa!');
                }else{
                    if(Painel::imagemValida($capa)){
                        $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE titulo = ? AND categoria_id = ?");
                        $verificar->execute(array($titulo, $categoria_id));
                        if($verificar->rowCount() == 0){
                            $imagem = Painel::updateFile($capa);
                            $slug = Painel::generateSlug($titulo);
                            $array = ['categoria_id'=>$categoria_id, 'titulo'=>$titulo, 'conteudo'=>$conteudo, 'capa'=>$imagem, 'slug'=>$slug, 'order_id'=>'0', 'nome_tabela'=>'tb_site.noticias'];
                            if(Painel::insert($array)){
                                Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-noticia?sucesso');
                            }
                        }else{
                            Painel::alert('erro', 'Já existe uma notícia com o título "'.$titulo.'".');
                        }
                    }else{
                        Painel::alert('erro', 'Selecione um arquivo de imagem válido!');
                    }
                }
            }
            if(isset($_GET['sucesso'])){
                Painel::alert('sucesso', 'Notícia cadastrada com sucesso!');
            }
        ?>

        <div class="form-group">
            <label>Categoria</label>
            <select name="categoria_id">
                <?php 
                    $categorias = Painel::selectAll('tb_site.categorias'); 
                    foreach ($categorias as $key => $value) {
                ?>
                <option <?php if($value['id'] == @$_POST['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Título</label>
            <input type="text" name="titulo" value="<?php recoverPost('titulo'); ?>">
        </div><!-- form-group -->

        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="conteudo"><?php recoverPost('conteudo'); ?></textarea>
        </div><!-- form-group -->

        <div class="form-group">
            <label>Imagem de Capa</label>
            <input type="file" name="imagem" />
        </div><!-- form-group -->

        <div class="form-group">
            <input type="hidden" name="order_id" value="0" />
            <input type="hidden" name="nome_tabela" value="tb_site.noticias" />
            <input type="submit" name="acao" value="Enviar!" />
        </div><!-- form-group -->
    </form>
</div>