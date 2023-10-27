<?php 
    verificaPermissao(2);
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $servico = Painel::select('tb_site.servicos','id = ?', array($id));
    }else{
        Painel::alert('erro','É preciso passar o parâmetro ID.');
        die();
    }
?>
<div class="box-content">
    <i class="fa-solid fa-comment-dollar"></i><h2> Editar Serviço</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
            if(isset($_POST['acao'])){
                if(Painel::update($_POST)){
                    Painel::alert('sucesso','Descrição do serviço foi editado com sucesso!');
                    $servico = Painel::select('tb_site.servicos','id = ?', array($id));
                }else{
                    Painel::alert('erro','É preciso descrever o serviço!');
                }
            }
        ?>

        <div class="form-group">
            <label>Descrição do Serviço</label>
            <textarea name="servico"><?php echo $servico['servico']; ?></textarea>
        </div><!-- form-group -->

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nome_tabela" value="tb_site.servicos" />
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- form-group -->
    </form>