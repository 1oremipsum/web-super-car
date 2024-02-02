<?php verificaPermissao(1); ?>

<div class="box-content">
    <h2><i class="fa-solid fa-bag-shopping"></i> Gerenciamento de Vendas | Realizar venda & Listagem</h2>

    <form method="get">
        <?php 
            if(isset($_GET['acao'])){
                $marca = $_GET['marca'];
                $modelo = $_GET['modelo'];
                $versao = $_GET['versao'];
                $preco = $_GET['preco'];
                $concessionaria = $_GET['id_concessionaria'];
                $nome = $_GET['nome'];
                $email = $_GET['e-mail'];
        
                $sucesso = true;
                $automovel = '';
                $cliente = '';
        
                if($marca != '' && $modelo != '' && $versao != '' && $concessionaria != ''){
                    $automovel = \model\Automovel::getAutomovelByVersao($versao);
                    if($automovel == ''){
                        $sucesso = false;
                        Painel::alert('erro', 'Não foi possível encontrar este automóvel!');
                    }
                    if($automovel['vendido'] == 1){
                        $sucesso = false;
                        Painel::alert('erro', 'Este automóvel já foi vendido!');
                    }
                }else{
                    $data['sucesso'] = false;
                    Painel::alert('erro', 'Os campos relacionados ao veículo não podem estar vázios!');
                }
        
                if($nome != '' && $email != ''){
                    $cliente = new \model\Cliente();
                    $cliente = $cliente->getClientByParams($nome, $email);
                    if($cliente == ''){
                        $data['sucesso'] = false;
                        Painel::alert('erro','Não foi possível encontrar este cliente!'); 
                    }
                }else{
                    Painel::alert('erro',"Os campos relacionados ao cliente não podem estar vázios!");
                }
        
                if($sucesso){
                    $vendaData = date("Y-m-d");
                    $venda = new \model\Venda($automovel['id'], $cliente['id'], $vendaData);
                    $venda->efetuarVenda();
                    Painel::alert('sucesso',"O automóvel $automovel[modelo] foi vendido com sucesso!");
                }
            }
        ?>
        <div class="form-group left W50">
            <label>Marca</label>
            <input type="text" name="marca" required />
        </div><!-- form-group -->

        <div class="form-group right W50">
            <label>Modelo</label>
            <input type="text" name="modelo" required />
        </div><!-- form-group -->
        <div class="clear"></div>

        <div class="form-group">
            <label>Versão</label>
            <input type="text" name="versao" required />
        </div><!-- form-group -->

        <div class="form-group left W50">
            <label>Valor</label>
            <input type="text" name="preco" />
        </div><!-- form-group -->
        
        <div class="form-group right W50">
            <label>Concessionária</label>
            <select name="id_concessionaria" required>
                <?php 
                    $concess = Painel::selectAll('tb_site.concessionarias'); 
                    foreach ($concess as $key => $value) {
                ?>
                <option <?php if($value['id'] == @$_POST['id_concessionaria']) echo 'selected'; ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="clear"></div>

        <div class="form-group left W50">
            <label>Nome do Cliente</label>
            <input type="text" name="nome" required />
        </div>

        <div class="form-group right W50">
            <label>E-mail do Cliente</label>
            <input type="text" name="e-mail" required />
        </div>
        <div class="clear"></div>

        <div class="form-group">
            <input type="submit" name="acao" value="Realizar Venda!" />
        </div><!-- form-group -->
        
    </form>

    <?php 
        if(isset($_GET['cancelar'])){
            $id = (int)$_GET['cancelar'];
            \model\Venda::cancelarPedidoVenda($id);
        }
    ?>

    <?php if(count(\view\Venda::getAll()) > 0) {?>

        <div style="margin-top: 30px;" class="wrapper-table">
            <div class="card-title"><i class="fa-solid fa-bag-shopping"></i><i class="fa-solid fa-list-check"></i>Listando Vendas </div>
            <table id="listar-automoveis" style="margin: 5px 0;">
                    <tr>
                        <td>Cliente</td>
                        <td>Automóvel</td>
                        <td>Valor</td>
                        <td>Data</td>
                        <td>Status</td>
                        <td>Cancelar Venda</td>
                        <td>Visualizar informações</td>
                    </tr>
                <?php 
                    
                    foreach (\view\Venda::getAll() as $key => $venda) {
                        foreach (\view\Automovel::getAll() as $key => $auto) {
                            foreach (\view\Cliente::getAll() as $key => $client) {
                                if($venda['id_automovel'] == $auto['id'] && $venda['id_cliente'] == $client['id']){
                                    $auto['preco'] = Painel::convertMoney($auto['preco']);
                                    if($venda['status_venda'] == '0'){
                                        $status = "A concluir";
                                    }else if($venda['status_venda'] == '1'){
                                        $status = "Concluída";
                                    }else if($venda['status_venda'] == '2'){
                                        $status = "Cancelado";
                                    }
                ?>
                <tr class="body">
                    <td><?php echo $client['nome'];?></td>
                    <td><?php echo $auto['marca'];?> - <?php echo $auto['modelo'];?></td>
                    <td>R$ <?php echo $auto['preco'];?></td>
                    <td><?php echo date($venda['data_pedido']);?></td>
                    <td><?php echo $status; ?></td>

                    <td><a class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-vendas?cancelar=<?php echo $venda['id']; ?>"><i class="fa-solid fa-ban"></i> Cancelar</a></td>

                    <td><a class="btn-view" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-info-venda/<?php echo $venda['id']; ?>"><i class="fa-solid fa-circle-info"></i> Mais informações</a></td>
                </tr>
                <?php 
                                }
                            }
                        }
                    }
                ?>
            </table>
        </div><!-- wrapper-table -->
    <?php }else{ ?>
        <div class="card-title"><i class="fa-solid fa-bag-shopping"></i><i class="fa-solid fa-list-check"></i>Listando Vendas </div>
    <?php Painel::alert("erro", "Nenhum registro de venda foi encontrado!");} ?>
</div><!-- box-content -->