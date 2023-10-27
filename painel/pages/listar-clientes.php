<?php 
    verificaPermissao(2);
    $clientes = MySql::conectar()->prepare("SELECT * from `tb_site.clientes`");
    $clientes->execute();
    $clientes = $clientes->fetchAll();
?>
<div class="box-content">
    <h2><i class="fa-solid fa-address-card"></i> Clientes Cadastrados</h2>
    <div class="boxes">
        <?php foreach ($clientes as $key => $value) { ?>

            <div class="box-single-wraper">
                <div class="box-single">
                    <div class="box-top">
                        <h2><i class="fa-solid fa-user"></i></h2>
                    </div><!-- box-top -->
                    <div class="box-body">
                        <p><b>Nome:</b> <?php echo $value['nome']?></p>
                        <p><b>E-mail:</b> <?php echo $value['email']?></p>
                        <div class="group-btn">
                            <a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-categoria?id=<?php echo $value['id']; ?>"><i class="fa-solid fa-pen"></i> <b>Editar</b></a>
                            <a actionBtn="delete" class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?excluir=<?php echo $value['id']; ?>"><i class="fa-solid fa-trash-can"></i> <b>Excluir</b></a>
                        </div>
                    </div><!-- box-body -->
                </div><!-- box-single -->
            </div><!-- box-single-wraper -->
            <?php } ?>
            <div class="clear"></div>
    </div><!-- boxes -->
</div><!-- content -->