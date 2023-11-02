<?php 
    verificaPermissao(2);
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $cliente = Painel::select('tb_site.clientes', 'id = ?', array($id));
    }else{
        Painel::alert('erro','É preciso passar o parâmetro ID.');
        die();
    }
?>
<div class="box-content">
    <i class="fa-solid fa-pen"></i><h2> Editar Cliente</h2>

    <form class="ajax" atualizar method="post" action="<?php INCLUDE_PATH_PAINEL ?>ajax/forms.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>" />
        </div><!-- form-group -->

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $cliente['email']; ?>" />
        </div><!-- form-group -->

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password" value="<?php echo $cliente['senha']; ?>" />
        </div><!-- form-group -->

        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="img"/>
        </div><!-- form-group -->

        <div class="form-group">
            <input type="hidden" name="imagem_original" value="<?php echo $cliente['img'];?>">
        </div>

        <div class="form-group">
            <input type="hidden" name="tipo_acao" value="editar_cliente">
        </div>

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
        </div>

        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar!"/>
        </div><!-- form-group -->
    </form>
</div><!-- box-content edit-user -->