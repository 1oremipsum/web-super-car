<?php 
    if(!\view\Login::logado())
        die("Realize login para ter acesso as suas aquisições!");

    $client = \view\Cliente::getClienteByEmail($_SESSION['email']);
    $acquisitions = \view\Cliente::getAllshopping($client['id']);
    $total = \view\Cliente::getTotalAcquisitions($acquisitions);
    $completed = \view\Venda::getVendasConcluidas($client['id']);
    $result = count($acquisitions); 
?>

<?php 
    if(isset($_GET['cancelar'])){
        $id = (int)$_GET['cancelar'];
        \view\Venda::cancelarPedidoById($id);
        Painel::redirect(INCLUDE_PATH.'gerenciar-compras');
    }

    if(isset($_GET['remover'])){
        $id = (int)$_GET['remover'];
        \view\Venda::removerPedidoById($id);
        Painel::redirect(INCLUDE_PATH.'gerenciar-compras');
    }
?>

<section class="acquisitions">
    <?php if($result != 0){?>
    <div class="acquisitions-header">
        <h1>Minhas Aquisições</h1>
        <p><?php echo $completed;?> Aquisições.
            <?php if(\view\Cliente::getInProcess($client['id'])){ 
                echo '<span>Seu automóvel ainda está em processo de confirmação de venda com a concessionária e os demais responsáveis pelo serviço!</span>';
            }?>
        </p>
    </div><!-- acquisitions-header -->
    
    <div class="box-total-aquisitions">
        <div class="total-info">
            <p>Total:</p>
            <h1>R$ <?php echo Painel::convertMoney($total);?></h1>
        </div>
    </div><!-- box-total-aquisitions -->

    <?php foreach ($acquisitions as $key => $value) {
            $automovel = \view\Automovel::getAutomovelById($value['id_automovel']);    
            $concess = \view\Automovel::getConcessionaria($automovel['id_concessionaria']);
            $img = \view\Automovel::getFirstImg($automovel['id']);
    ?>
        <div class="aquisition-single">
            <img src="<?php echo INCLUDE_PATH_PAINEL.'uploads/automoveis/'.$img['imagem']?>">

            <div class="title">
                <h2><?php echo $automovel['marca']; ?> - <?php echo $automovel['versao']; ?></h2>
            </div>

            <div class="aquisition-info">
                <div class="aquisition-desc">
                    <p>Quilometragem: <?php echo Painel::convertKm($automovel['quilometragem']); ?>Km</p>
                    <p>Concessionária: <?php echo $concess['nome']; ?></p>
                    <p>Requisição de compra: <?php echo Painel::convertDate($value['data_pedido']); ?></p>
                    <?php if($value['status_venda'] == 1){?>
                        <p>Comprado em: <?php echo Painel::convertDate($value['data_pedido']); ?></p>
                    <?php } ?>
                </div>
                <div class="aquisition-status">
                    <p>Estado atual da compra:</p>
                    <?php 
                        if($value['status_venda'] == 0){
                            echo '<h1><span class="in-process">Em Andamento</span></h1>';
                        }else if($value['status_venda'] == 1){
                            echo '<h1><span class="concluded">Concluído</span></h1>';
                        }else if($value['status_venda'] == 2){
                            echo '<h1><span class="canceled">Cancelado</span></h1>';
                        }
                    ?>
                </div>
                <div class="aquisition-price">
                    <p>R$ <?php echo Painel::convertMoney($automovel['preco']); ?> <i class="fa-solid fa-tag"></i></p>
                    <div class="cancel-btn">
                        <?php if($value['status_venda'] == 0 || $value['status_venda'] == 1){?>
                            <a href="<?php echo INCLUDE_PATH ?>gerenciar-compras?cancelar=<?php echo $value['id']; ?>"><span class="cancel">Cancelar compra</span></a>
                        <?php } ?>

                        <?php if($value['status_venda'] == 2){?>
                            <a href="<?php echo INCLUDE_PATH ?>gerenciar-compras?remover=<?php echo $value['id']; ?>"><span class="remove">Remover</span></a>
                        <?php } ?>
                    </div><!-- cancel-btn -->
                </div><!-- aquisition-price -->
            </div><!-- aquisition-info -->
        </div><!-- aquisition-single -->
    <?php } ?>
<?php }else{?>
    <div class="no-results">
        <div class="content-header">
            <h1>Minhas Aquisições.</h1>
            <p><?php echo $completed;?> Aquisições.</p>
        </div>
        <div class="content-cs">
            <div class="continue-shopping">
                <span>Sua lista de aquisições está vazia. Que tal realizar uma?</span>
                <a class="btn-vehicles-page" href="<?php echo INCLUDE_PATH?>automoveis">Continuar comprando</a>
            </div>
        </div>
    </div>
<?php }?>
</section>