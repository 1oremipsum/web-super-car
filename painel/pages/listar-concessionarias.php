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
        if(isset($_GET['deletar'])){
            $id = (int)$_GET['deletar'];
            $conces = MySql::conectar()->prepare("SELECT `logo` FROM `tb_site.concessionarias` WHERE id = $id");
            $conces->execute();
            $conces = $conces->fetch();
            @unlink(BASE_DIR_PAINEL.'/uploads/concessionarias/'.$conces['logo']);

            MySql::conectar()->exec("DELETE FROM `tb_site.concessionarias` WHERE id = $id");
            Painel::alert('sucesso', 'A concessionária foi deletada com sucesso!');
        }
    ?>    

    <?php 
        $query = "";
        if(isset($_POST['acao'])){
            $busca = $_POST['busca'];
            $query = " WHERE nome LIKE '%$busca%' OR cnpj LIKE '%$busca%'";
        }
        $conces = MySql::conectar()->prepare("SELECT * from `tb_site.concessionarias` $query");
        $conces->execute();
        $conces = $conces->fetchAll();

        if(isset($_POST['acao'])){
            $resultados = count($conces);
            if($resultados == 1){
                echo '<div class="busca-result"><p>Apenas <b>'.$resultados.'</b> resultado encontrado.</p></div>';
            }else if ($resultados > 1) {
                echo '<div class="busca-result"><p>Sua pesquisa encontrou <b>'.$resultados.'</b> resultados.</p></div>';
            }else {
                echo '<div class="busca-result"><p>Não encontramos nenhuma <b>concessionária</b> com <b>nome ou CNPJ</b> semelhante a <b>"'.$_POST['busca'].'"</b>.</p></div>';
            }
        }
    ?>

    <div class="boxes">
        <?php foreach ($conces as $key => $value) { ?>
            
            <div class="box-single-wraper">
                <div class="box-single" style="height: 255px;">
                    <div class="box-top" style="height: 150px">
                        <img style="width: 160px; height: 132px; border: 1px solid white; border-radius: 8px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/concessionarias/<?php echo $value['logo'];?>">
                    </div><!-- box-top -->
                    <div class="box-body" style="height: 100px;">
                        <p><b>Concessionária: </b> <?php echo $value['nome']?></p>
                        <p><b>CNPJ: </b> <?php echo $value['cnpj']?></p>
                        <div class="group-btn">
                            <a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-concessionaria?id=<?php echo $value['id']; ?>"><i class="fa-solid fa-pen"></i> Editar</a>
                            
                            <a class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-concessionarias?deletar=<?php echo $value['id']; ?>"><i class="fa-solid fa-trash-can"></i> <b>Excluir</b></a>
                        </div>
                    </div><!-- box-body -->
                </div><!-- box-single -->
            </div><!-- box-single-wraper -->
        <?php } ?>
    </div><!-- boxes -->
</div><!-- box-content -->