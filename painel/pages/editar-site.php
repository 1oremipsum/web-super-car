<?php 
    verificaPermissao(2);
    $site = Painel::select('tb_site.config', false);
?>
<div class="box-content">
    <i class="fa-solid fa-wand-magic-sparkles"></i><h2> Editar Conteúdo da Home</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
            if(isset($_POST['acao'])){
                if(Painel::update($_POST, true)){
                    Painel::alert('sucesso','Alteração realizada com sucesso!');
                    $site = Painel::select('tb_site.config', false);
                }else{
                    Painel::alert('erro','Não foi possível realizar a alteração!');
                }
            }
        ?>

        <div class="site cabecalho">
            <div class="form-group">
                <h2>Cabeçalho</h2>
                <label>Título</label>
                <input type="text" name="titulo" value="<?php echo $site['titulo']?>" />
            </div><!-- form-group -->
        </div><!-- site cabecalho -->

        <div class="space"></div>

        <div class="form-group">
            <h2>Mensagem do Banner</h2>
            <label>Título</label>
            <input name="titulo_msg_banner" type="text" value="<?php echo $site['titulo_msg_banner']?>" />
        </div><!-- form-group -->

        <div class="form-group">
            <label>Descrição</label>
            <input name="msg_banner" type="text" value="<?php echo $site['msg_banner']?>" />
        </div><!-- form-group -->

        <div class="space"></div>

        <div class="form-group">
            <h2>Mensagem do Carrosel</h2>
            <label>Descrição</label>
            <textarea name="descricao1"><?php echo $site['descricao1']?></textarea>"
        </div><!-- form-group -->

        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_site.config" />
            <input type="submit" name="acao" value="Atualizar!">
        </div><!-- form-group -->
    </form>
</div>