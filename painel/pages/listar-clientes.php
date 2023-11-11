<?php 
    verificaPermissao(2);
?>
<div class="box-content">
    <h2><i class="fa-solid fa-address-card"></i> Clientes Cadastrados</h2>

    <div class="search-box">
        <form method="post">
           <input class="search-txt" type="text" name="busca" placeholder="Realizar pesquisa por nome ou e-mail">
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
            $query = " WHERE nome LIKE '%$busca%' OR email LIKE '%$busca%'";
        }
        $clientes = MySql::conectar()->prepare("SELECT * from `tb_site.clientes` $query");
        $clientes->execute();
        $clientes = $clientes->fetchAll();

        if(isset($_POST['acao'])){
            $resultados = count($clientes);
            if($resultados == 1){
                echo '<div class="busca-result"><p>Apenas <b>'.$resultados.'</b> resultado encontrado.</p></div>';
            }else if ($resultados > 1) {
                echo '<div class="busca-result"><p>Sua pesquisa encontrou <b>'.$resultados.'</b> resultados.</p></div>';
            }else {
                echo '<div class="busca-result"><p>Não encontramos nenhum <b>cliente</b> com <b>nome ou e-mail</b> semelhante a <b>"'.$_POST['busca'].'"</b>.</p></div>';
            }
        }
    ?>

    <div class="boxes">
        <?php foreach ($clientes as $key => $value) { ?>

            <div class="box-single-wraper">
                <div class="box-single">
                    <div class="box-top">
                        <?php if($value['img'] == ''){?>
                            <h2><i class="fa-solid fa-user"></i></h2>
                        <?php }else {?>
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/clientes/<?php echo $value['img'];?>">
                        <?php } ?>
                    </div><!-- box-top -->
                    <div class="box-body">
                        <p><b>Nome:</b> <?php echo $value['nome']?></p>
                        <p><b>E-mail:</b> <?php echo $value['email']?></p>
                        <div class="group-btn">
                            <a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-cliente?id=<?php echo $value['id']; ?>"><i class="fa-solid fa-pen"></i> Editar</a>
                            
                            <a class="btn-delete" item_id="<?php echo $value['id']; ?>" href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fa-solid fa-trash-can"></i> <b>Excluir</b></a>
                        </div>
                    </div><!-- box-body -->
                </div><!-- box-single -->
            </div><!-- box-single-wraper -->
            
        <?php } ?>
            <div class="clear"></div>
    </div><!-- boxes -->
</div><!-- content -->