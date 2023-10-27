<?php verificaPermissao(1); ?>
<div class="box-content">
    <i class="fa-solid fa-comment-dots"></i><h2> Adicionar Depoimento</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
            if(isset($_POST['acao'])){
                if(Painel::insert($_POST)){
                    Painel::alert('sucesso','Depoimento cadastrado com sucesso!');
                }else{
                    Painel::alert('erro', 'Campos vazios não são permitidos!');
                }
            }
        ?>

        <div class="form-group">
            <label>Nome da pessoa</label>
            <input type="text" name="login">
        </div><!-- form-group -->

        <div class="form-group">
            <label>Depoimento</label>
            <textarea name="depoimento"></textarea>
        </div><!-- form-group -->

        <div class="form-group">
            <label>Data</label>
            <input formato="data" type="text" name="data">
        </div><!-- form-group -->

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="tb_site.depoimentos" />
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- form-group -->
    </form>
</div>