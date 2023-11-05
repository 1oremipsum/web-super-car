<?php 
    verificaPermissao(2);
?>
<div class="box-content">
    <i class="fa-solid fa-building-flag"></i><h2> Cadastrar Concessionária</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
            if(isset($_POST['acao'])){
                if(Painel::insert($_POST)){
                    $nome = $_POST['nome'];
                    Painel::alert('sucesso','Concessionária '.$nome.' cadastrada com sucesso!');
                }else{
                    Painel::alert('erro', 'É preciso descrever o serviço!');
                }
            }
        ?>

        <div class="form-group">
            <label>Nome da Empresa</label>
            <input type="text" name="nome" />
        </div><!-- form-group -->

        <div class="form-group">
            <label>CNPJ</label>
            <input type="text" name="cnpj">
        </div>

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="tb_site.concessionarias" />
            <input type="submit" name="acao" value="Cadastrar!"/>
        </div><!-- form-group -->
    </form>
</div><!-- box-content edit-user -->