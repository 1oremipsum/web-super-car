<?php 
    verificaPermissao(2);
    $id = $par[2];
    $conc = Painel::select('tb_site.concessionarias', 'id = ?', array($id));
    $automoveis = Painel::selectQuery('tb_site.automoveis', "id_concessionaria = ? ", array($id));

    if($conc['nome'] == ''){
        header('Location: '.INCLUDE_PATH_PAINEL);
        die();
    }
?>

<div class="box-content">
    <h2><i class="fa-solid fa-car-rear"></i> Informações da Concessionária & Listagem dos Automóveis</h2>

    <div class="info-item">
        <div class="row1">
            <div class="card-title"><i class="fa-solid fa-flag"></i> Logomarca</div>
            <img src="<?php INCLUDE_PATH_PAINEL ?>../uploads/concessionarias/<?php echo $conc['logo']; ?>" />
        </div><!-- row1 -->

        <div class="row2">
            <div class="card-title"><i class="fa-solid fa-building-circle-exclamation"></i> Informações da concessionária</div>
            <p>Nome <span><?php echo $conc['nome']; ?></span></p>
            <p>CNPJ <span><?php echo $conc['cnpj']; ?></span></p>
            <p>Fone <span><?php echo $conc['fone']; ?></span></p>
        </div><!-- row2 -->
        <div class="clear"></div>
    </div><!-- info-item -->

    <?php 
        if(count($automoveis) > 0){
    ?>
        <div class="card-title"><i class="fa-solid fa-car-rear"></i> Automóveis da concessionária <?php echo $conc['nome']; ?></div>
        <div class="wrapper-table">
            <table style="margin: 5px 0;">
                <tr>
                    <td>Marca</td>
                    <td>Modelo</td>
                    <td>Preço</td>
                    <td>Quilometragem</td>
                    <td>Ano/Modelo</td>
                    <td>Visualização</td>
                </tr>
        <?php 
            foreach ($automoveis as $key => $value) {
                $value['preco'] = Painel::convertMoney($value['preco']);
                $value['quilometragem'] = Painel::convertKm($value['quilometragem']);
        ?>
            <tr class="body">
                <td><?php echo $value['marca'];?></td>
                <td><?php echo $value['modelo'];?></td>
                <td>R$ <?php echo $value['preco'];?></td>
                <td><?php echo $value['quilometragem'];?> km</td>
                <td><?php echo $value['ano_fab'];?>/<?php echo $value['ano_mod'];?></td>
                <td><a class="btn-view" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-automovel?id=<?php echo $value['id']; ?>"><i class="fa-solid fa-eye" style="padding: 1px 2px; font-size: 14px;"></i> Visualizar</a></td>
            </tr>
    <?php 
            }
        }else{
            Painel::alert('erro', 'A concessionária '.$conc['nome'].' não possui automóveis cadastrados!');
        }               
    ?>
        </table>
    </div><!-- wrapper-table -->
</div><!-- box-content -->
