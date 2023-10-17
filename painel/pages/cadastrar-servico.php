<div class="box-content">
    <i class="fa-solid fa-comment-dollar"></i><h2> Adicionar Serviço</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
            if(isset($_POST['acao'])){
                if(Painel::insert($_POST)){
                    Painel::alert('sucesso','Descrição do serviço cadastrado com sucesso!');
                }else{
                    Painel::alert('erro', 'É preciso descrever o serviço!');
                }
            }
        ?>

        <div class="form-group">
            <label>Descrição do serviço</label>
            <textarea name="servico"></textarea>
        </div><!-- form-group -->

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="tb_site.servicos" />
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- form-group -->
    </form>
</div>