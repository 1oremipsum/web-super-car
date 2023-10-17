<?php 
    $usuariosOnline = Painel::listarUsuariosOnline();

    $visitasTotais = Painel::getVisitasTotais();
    $visitasTotais = $visitasTotais->rowCount();

    $visitasHoje = Painel::getVisitasHoje();
    $visitasHoje = $visitasHoje->rowCount();
?>
<div class="box-content left w100">

    <h2><i class="fa-solid fa-house-chimney"></i>
        Painel de controle - <?php echo NOME_EMPRESA; ?>
    </h2>

    <div class="box-metricas">
        <div class="left box-metrica-single">
            <div class="box-metrica-wrapper">
                <h3>Usuários online</h3>
                <p><?php echo count($usuariosOnline); ?> <i class="fa-solid fa-user"></i></p>
            </div><!-- box-metrica-wrapper -->
        </div><!-- box-metrica-single -->

        <div class="left box-metrica-single">
            <div class="box-metrica-wrapper">
                <h3>Total de visitas</h3>
                <p><?php echo $visitasTotais; ?> <i class="fa-solid fa-users"></i></p>
            </div><!-- box-metrica-wrapper -->
        </div><!-- box-metrica-single -->

        <div class="left box-metrica-single">
            <div class="box-metrica-wrapper">
                <h3>Visitas hoje</h3>
                <p><?php echo $visitasHoje; ?> <i class="fa-solid fa-eye"></i></p>
            </div><!-- box-metrica-wrapper -->
        </div><!-- box-metrica-single -->
    </div><!-- box-metricas -->
    <div class="clear"></div>
</div><!-- box-content left w100 -->

<div class="box-content w100 left">
    <h2><i class="fa-solid fa-globe"></i> Usuários Online no Site</h2>
    <div class="wrapper-table">
        <div class="table-responsive">
            <div class="row">
                <div class="col">
                    <span>IP</span>
                </div><!-- col -->
                <div class="col">
                    <span>Última Ação</span>
                </div><!-- col -->
                <div class="clear"></div>
            </div><!-- row -->

            <?php
                foreach($usuariosOnline as $key => $value){
            ?>
            <div class="row">
                <div class="col">
                    <span><?php echo $value['ip']; ?></span>
                </div><!-- col -->
                <div class="col">
                    <span><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao'])); ?></span>
                </div><!-- col -->
                <div class="clear"></div>
            </div><!-- row -->
            <?php } ?>
        </div><!-- table-responsive -->
    </div><!-- wrapper-table -->
</div><!-- box-content left w100 -->

<div class="box-content w100 right">
    <h2><i class="fa-solid fa-user-gear"></i> Usuários do Painel</h2>
    <div class="wrapper-table">
        <div class="table-responsive">
            <div class="row">
                <div class="col">
                    <span>User</span>
                </div><!-- col -->
                <div class="col">
                    <span>Cargo</span>
                </div><!-- col -->
                <div class="clear"></div>
            </div><!-- row -->

            <?php
                $usuariosPainel = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
                $usuariosPainel->execute();
                $usuariosPainel = $usuariosPainel->fetchAll();
                foreach($usuariosPainel as $key => $value){
            ?>
            <div class="row">
                <div class="col">
                    <span><?php echo $value['user']; ?></span>
                </div><!-- col -->
                <div class="col">
                    <span><?php echo getCargo($value['cargo']); ?></span>
                </div><!-- col -->
                <div class="clear"></div>
            </div><!-- row -->
            <?php } ?>
        </div><!-- table-responsive -->
    </div>
</div><!-- box-content left w100 -->