<?php 
    verificaPermissao(2);
    if(isset($_GET['excluir'])){
        $id = (int)$_GET['excluir'];
        $logo = MySql::conectar()->prepare("SELECT `logo` FROM `tb_site.concessionarias` WHERE id = $id");
        $logo->execute();
        $logo = $logo->fetch();
        @unlink(BASE_DIR_PAINEL.'/uploads/concessionarias/'.$logo['logo']);

        $automoveis = MySql::conectar()->prepare("SELECT * FROM `tb_site.automoveis` WHERE id_concessionaria = $id");
        $automoveis->execute();
        $automoveis = $automoveis->fetchAll();
        foreach ($automoveis as $key => $auto) {
            $imagens = MySql::conectar()->prepare("SELECT * FROM `tb_site.imagens_automoveis` WHERE automovel_id = $auto[id]");
            $imagens->execute();
			$imagens = $imagens->fetchAll();
            foreach ($imagens as $key2 => $img) {
                @unlink(BASE_DIR_PAINEL.'/uploads/automoveis/'.$img['imagem']);
                MySql::conectar()->exec("DELETE FROM `tb_site.imagens_automoveis` WHERE id = $img[id]");
            }
        }
        MySql::conectar()->exec("DELETE FROM `tb_site.automoveis` WHERE id_concessionaria = $id");
        MySql::conectar()->exec("DELETE FROM `tb_site.concessionarias` WHERE id = $id");
        Painel::alert('sucesso', "A concessionária foi removida com sucesso!");
    }
?>
<div class="box-content">
    <h2><i class="fa-solid fa-building-circle-check"></i> Concessionárias Cadastradas</h2>

    <div class="search-box">
        <form method="post">
        <input class="search-txt" type="text" name="busca" placeholder="Realizar pesquisa por nome ou CNPJ">
        <button class="search-btn" type="submit" name="acao">
                <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        </form>
    </div><!-- search-box -->
    <div class="clear"></div>
    <?php 
        $query = "";
        if(isset($_POST['acao'])){
            $busca = $_POST['busca'];
            $query = " WHERE nome LIKE '%$busca%' OR cnpj LIKE '%$busca%' OR fone LIKE '%$busca%'";
        }
        $conces = MySql::conectar()->prepare("SELECT * from `tb_site.concessionarias` $query ORDER BY order_id ASC");
        $conces->execute();
        $conces = $conces->fetchAll();

        if(isset($_POST['acao'])){
            $resultados = count($conces);
            if($resultados == 1){
                echo '<div class="busca-result"><p>Apenas <b>'.$resultados.'</b> resultado encontrado.</p></div>';
            }else if ($resultados > 1) {
                echo '<div class="busca-result"><p>Sua pesquisa encontrou <b>'.$resultados.'</b> resultados.</p></div>';
            }else {
                echo '<div class="busca-result"><p>Não encontramos nenhuma <b>concessionária</b> com <b>nome, CNPJ ou número</b> semelhante a <b>"'.$_POST['busca'].'"</b>.</p></div>';
            }
        }
    ?>

    <div class="boxes">
        <?php foreach ($conces as $key => $value) { ?>
            
            <div id="item-<?php echo $value['id']; ?>" class="box-single-wraper">
                <div class="box-single" style="height: 300px;">
                    <div class="box-top" style="height: 155px">
                        <img style="width: 188px; height: 138px; border: 1px solid white; border-radius: 8px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/concessionarias/<?php echo $value['logo'];?>">
                    </div><!-- box-top -->
                    <div class="box-body" style="height: 100px;">
                        <p><b>Nome: </b> <span><?php echo $value['nome']?></span></p>
                        <p><b>CNPJ: </b> <span><?php echo $value['cnpj']?></span></p>
                        <p><b>Fone: </b> <span><?php echo $value['fone']?></span></p>
                        <div class="group-btn">
                            <a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-concessionaria?id=<?php echo $value['id']; ?>"><i class="fa-solid fa-pen"></i> Editar</a>
                            
                            <a actionBtn="delete" class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-concessionarias?excluir=<?php echo $value['id']; ?>"><i class="fa-solid fa-trash-can"></i> Excluir</a>

                            <a class="btn-view" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-info-concessionaria/<?php echo $value['id']; ?>"><i class="fa-solid fa-eye"></i> Visualizar Informações</a>
                        </div>
                    </div><!-- box-body -->
                </div><!-- box-single -->
            </div><!-- box-single-wraper -->
        <?php } ?>
    </div><!-- boxes -->
</div><!-- box-content -->