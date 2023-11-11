<?php 
    verificaPermissao(2);
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $slide = Painel::select('tb_site.slides', 'id = ?', array($id));
    }else{
        Painel::alert('erro','É preciso passar o parâmetro ID.');
        die();
    }
?>
<div class="box-content">
    <i class="fa-solid fa-pen"></i><h2> Editar Slide</h2>

    <form method="post" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $imagem = $_FILES['imagem'];
                $imagem_atual = $_POST['imagem_atual'];

                if($imagem['name'] != ''){
                    if(Painel::imagemValida($imagem)){
                        Painel::deleteFile('uploads/sliders', $imagem_atual);
                        $imagem = Painel::updateFile($imagem, 'uploads/sliders');
                        $arr = ['nome'=>$nome, 'slide'=>$imagem, 'id'=>$id, 'nome_tabela'=>'tb_site.slides'];
                        Painel::update($arr);
                        $slide = Painel::select('tb_site.slides', 'id = ?', array($id)); //atualizando
                        Painel::alert('sucesso','Alteração realizada com sucesso!');
                    }else{
                        Painel::alert('erro','Formato de imagem inválido.');
                    }
                }else{
                    $imagem = $imagem_atual;
                    $arr = ['nome'=>$nome, 'slide'=>$imagem, 'id'=>$id, 'nome_tabela'=>'tb_site.slides'];
                    Painel::update($arr);
                    $slide = Painel::select('tb_site.slides', 'id = ?', array($id)); //atualizando
                    Painel::alert('sucesso','Alteração realizada com sucesso!');
                }
            }
        ?>

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" required value="<?php echo $slide['nome']; ?>" >
        </div><!-- form-group -->

        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="imagem"/>
            <input type="hidden" name="imagem_atual" value="<?php echo $slide['slide']; ?>">
        </div><!-- form-group -->

        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar!">
        </div><!-- form-group -->

    </form>
</div><!-- box-content edit-user -->