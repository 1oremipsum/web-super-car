<?php 
    verificaPermissao(2);
    $site = Painel::select('tb_site.config', false);
?>
<div class="box-content">
    <i class="fa-solid fa-wand-magic-sparkles"></i><h2> Editar Conteúdo do site</h2>

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

        <div class="site sobre-nos">
            <div class="form-group">
                <h2>Sobre nós</h2>
                <label>Descrição</label>
                <textarea name="desc_empresa"><?php echo $site['desc_empresa']?></textarea>
            </div><!-- form-group -->
        </div><!-- "site sobre-nos" -->

        <div class="space"></div>

        <div class="site qualidades">
            <h2>Qualidades</h2>
            <?php 
                for($i=1; $i<=3; $i++){ 
            ?>
            <div class="form-group">
                <label>Ícone: <i class="<?php echo $site['icone'.$i]?>"></i></label>
                <input type="text" name="icone<?php echo $i; ?>" value="<?php echo $site['icone'.$i]?>" />
                <label>Qualidade</label>
                <input type="text" name="qualidade<?php echo $i; ?>" value="<?php echo $site['qualidade'.$i]?>" />
            </div><!-- form-group -->

            <div class="form-group">
                <label>Descrição</label>
                <textarea name="descricao<?php echo $i; ?>"><?php echo $site['descricao'.$i]?></textarea>
            </div><!-- form-group -->
            <div class="space"></div>
            <?php } ?>
        </div><!-- site qualidades -->

        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_site.config" />
            <input type="submit" name="acao" value="Atualizar!">
        </div><!-- form-group -->
    </form>
</div>