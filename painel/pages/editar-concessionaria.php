<?php 
    verificaPermissao(2);
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $concess = Painel::select('tb_site.concessionarias','id = ?', array($id));
    }else{
        Painel::alert('erro','É preciso passar o parâmetro ID.');
        die();
    }
?>
<div class="box-content">
    <i class="fa-solid fa-building-flag"></i><h2> Editar Concessionária</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
            if(isset($_POST['acao'])){
                if(Painel::update($_POST)){
                    Painel::alert('sucesso','Os dados da concessionária '.$_POST['nome'].' foram editados com sucesso!');
                    $concess = Painel::select('tb_site.concessionarias','id = ?', array($id));
                }else{
                    Painel::alert('erro','Campos vazios não são permitidos!');
                }
            }
        ?>

        <div class="form-group">
            <label>Nome da Empresa</label>
            <input type="text" name="nome" value="<?php echo $concess['nome']; ?>">
        </div><!-- form-group -->

        <div class="form-group">
            <label>CNPJ</label>
            <input type="text" name="cnpj" value="<?php echo $concess['cnpj']; ?>">
        </div><!-- form-group -->

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nome_tabela" value="tb_site.concessionarias" />
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- form-group -->
    </form>