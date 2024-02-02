<?php 
    verificaPermissao(1);
    $id = $par[2];
    $venda = Painel::select('tb_site.vendas', 'id = ?', array($id));

    if($venda['id'] == ''){
        header('Location: '.INCLUDE_PATH_PAINEL);
        die();
    }
    $client = \model\Cliente::getClienteById($venda['id_cliente']);
    $vehicle = \model\Automovel::getAutomovelById($venda['id_automovel']);

    $imgVehicle = MySql::conectar()->prepare("SELECT `imagem` FROM `tb_site.imagens_automoveis` WHERE automovel_id = $vehicle[id] ORDER BY `order_id` LIMIT 1");
    $imgVehicle->execute();
    $imgVehicle = $imgVehicle->fetch();
    
    $cambio = \model\Automovel::getCambio($vehicle['cambio']);
    $fuel = \model\Automovel::getCombustivel($vehicle['combustivel']);
    $sold;
?>
<div class="box-content">
    <h2><i class="fa-solid fa-car-rear"></i> Informações da Venda</h2>

    <div class="info-item">
        <div class="row1 venda-automovel">
            <div class="card-title">Imagem do Automóvel</div>
            <img src="<?php INCLUDE_PATH_PAINEL ?>../uploads/automoveis/<?php echo $imgVehicle['imagem']; ?>" />
        </div><!-- row1 -->

        <div class="row2 venda-automovel">
            <div class="card-title"> Informações do Automóvel</div>
            <p>MARCA <span><?php echo $vehicle['marca']; ?></span></p>
            <p>MODELO <span><?php echo $vehicle['modelo']; ?></span></p>
            <p>VERSÃO <span><?php echo $vehicle['versao']; ?></span></p>
            <p>PREÇO <span><?php echo 'R$ '.Painel::convertMoney($vehicle['preco']); ?></span></p>
            <p>QUILOMETRAGEM <span><?php echo Painel::convertKm($vehicle['quilometragem']).' Km'; ?></span>
            </p>
            <p>ANO FAB <span><?php echo $vehicle['ano_fab']; ?></span></p>
            <p>ANO MOD <span><?php echo $vehicle['ano_mod']; ?></span></p>
            <p>CÂMBIO <span><?php echo $cambio; ?></span></p>
            <p>COMBUSTÍVEL <span><?php echo $fuel; ?></span></p>
            <p>COR <span><?php echo $vehicle['cor']; ?></span></p>
        </div><!-- row2 -->
        <div class="clear"></div>
    </div><!-- info-item -->

    <div class="info-item">
        <div class="row2 venda-automovel cliente">
            <div class="card-title">Informações do Cliente</div>
            <p>NOME <span><?php echo $client['nome']; ?></span></p>
            <p>EMAIL <span><?php echo $client['email']; ?></span></p>
        </div><!-- row2 -->
        <div class="clear"></div>
    </div>

    <?php if($venda['status_venda'] == 0){?>
        <div class="center">
            <form method="get">
                <?php 
                    if(isset($_GET['buy-vehicle'])){
                        $sell = new \model\Venda($venda['id_automovel'], $venda['id_cliente'], $venda['data_pedido']);
                        $sell->confirmarVenda();
                        if($sell->getDataVenda() != null || $sell->getDataVenda() != ''){
                            Painel::alert('sucesso', "O veículo $vehicle[modelo] foi vendido para o(a) $client[nome] com sucesso!");
                        }else{
                            Painel::alert('erro', "Um erro inesperado ocorreu!");
                        }
                    }
                ?>
                <div class="form-group">
                    <input type="submit" name="buy-vehicle" value="Efetuar Venda!">
                </div>
                <div class="clear"></div>
            </form>
        </div>
    <?php }else if($venda['status_venda'] == 1){ ?>
        <div class="center">
            <p><?php Painel::alert('sucesso', "O veículo $vehicle[modelo] foi vendido para o(a) $client[nome] com sucesso!"); ?></p>
        </div>
    <?php }else if($venda['status_venda'] == 2){ ?>
        <div class="center">
            <p><?php Painel::alert('erro', "Esta solicitação de venda foi cancelada!"); ?></p>
            <form method="get">
                <?php 
                    if(isset($_GET['remove'])){
                        \model\Venda::removeById($venda['id']);
                        Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-vendas');
                    }
                ?>
                <div class="form-group">
                   <button class="remove-sale" name="remove" >Apagar Registro</button>
                </div>
                <div class="clear"></div>
            </form>
        </div>

    <?php } ?>
</div>