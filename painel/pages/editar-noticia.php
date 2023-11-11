<?php 
    verificaPermissao(2);
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $noticia = Painel::select('tb_site.noticias', 'id = ?', array($id));
    }else{
        Painel::alert('erro','É preciso passar o parâmetro ID.');
        die();
    }
?>
<div class="box-content">
    <i class="fa-solid fa-pen"></i><h2> Editar Notícia</h2>

    <form method="post" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
                $titulo = $_POST['titulo'];
                $conteudo = $_POST['conteudo'];
                $categoria_id = $_POST['categoria_id'];
                $imagem = $_FILES['imagem'];
                $imagem_atual = $_POST['imagem_atual'];

                $slug = Painel::generateSlug($titulo);
                $verifica = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.noticias` WHERE titulo = ? AND categoria_id = ? AND id != ?");
                $verifica->execute(array($titulo, $categoria_id, $id));

                if($verifica->rowCount() == 0){
                    if($imagem['name'] != ''){
                        if(Painel::imagemValida($imagem)){
                            Painel::deleteFile('uploads/noticias', $imagem_atual);
                            $imagem = Painel::updateFile($imagem, 'uploads/noticias');
                            $arr = ['titulo'=>$titulo, 'conteudo'=>$conteudo, 'data'=>date('Y-m-d'), 'categoria_id'=>$categoria_id, 'capa'=>$imagem, 'slug'=>$slug, 'id'=>$id, 'nome_tabela'=>'tb_site.noticias'];
                            Painel::update($arr);
                            $noticia = Painel::select('tb_site.noticias', 'id = ?', array($id)); //update
                            Painel::alert('sucesso','Alteração realizada com sucesso!');
                        }else{
                            Painel::alert('erro','Formato de imagem inválido.');
                        }
                    }else{
                        $imagem = $imagem_atual;
                        $arr = ['titulo'=>$titulo, 'conteudo'=>$conteudo, 'categoria_id'=>$categoria_id, 'capa'=>$imagem, 'slug'=>$slug, 'id'=>$id, 'nome_tabela'=>'tb_site.noticias'];
                        Painel::update($arr);
                        $noticia = Painel::select('tb_site.noticias', 'id = ?', array($id)); //atualizando
                        Painel::alert('sucesso','Alteração realizada com sucesso!');
                    }
                }else{
                    Painel::alert('erro', 'Já existe uma notícia com o título "'.$titulo.'".');
                }
            }
        ?>

        <div class="form-group">
            <label>Notícia</label>
            <input type="text" name="titulo" required value="<?php echo $noticia['titulo']; ?>" >
        </div><!-- form-group -->

        <div class="form-group">
            <label>Conteúdo</label>
            <textarea class="tinymce" name="conteudo"><?php echo $noticia['conteudo']; ?></textarea>
        </div><!-- form-group -->

        <div class="form-group">
            <label>Categoria</label>
            <select name="categoria_id">
                <?php 
                    $categorias = Painel::selectAll('tb_site.categorias'); 
                    foreach ($categorias as $key => $value) {
                ?>
                <option <?php if($value['id'] == $noticia['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Capa</label>
            <input type="file" name="imagem"/>
            <input type="hidden" name="imagem_atual" value="<?php echo $noticia['capa']; ?>">
        </div><!-- form-group -->

        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar!">
        </div><!-- form-group -->

    </form>
</div><!-- box-content edit-user -->