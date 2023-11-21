<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $conc = Painel::select('tb_site.concessionarias', 'id = ?', array($id));
    }else{
        Painel::alert('erro', 'Faltou o parâmetro ID.');
        die();
    }

    $automoveis = Painel::selectQuery('tb_site.automoveis','id_concessionaria = ?', array($id));
?>

<div class="box-content">
    <h2><i class="fa-solid fa-car-rear"></i> Informações da Concessionária & Listagem dos Automóveis</h2>

    <div class="info-item">
        <div class="row1">
            <div class="card-title"><i class="fa-solid fa-flag"></i> Logomarca</div>
            <img src="<?php INCLUDE_PATH_PAINEL ?>uploads/concessionarias/<?php echo $conc['logo']; ?>" />
        </div><!-- row1 -->

        <div class="row2">
            <div class="card-title"><i class="fa-solid fa-building-circle-exclamation"></i> Informações da concessionária</div>
            <p><i class="fa-solid fa-star"></i> Nome: <span><?php echo $conc['nome']; ?></span></p>
            <p><i class="fa-solid fa-star"></i> CNPJ: <span><?php echo $conc['cnpj']; ?></span></p>
            <p><i class="fa-solid fa-star"></i> Fone: <span><?php echo $conc['fone']; ?></span></p>
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
                    <td>Marca <i style="font-size: 16px;" class="fa-solid fa-arrow-down-a-z"></i></td>
                    <td>Modelo</td>
                    <td>Preço <i style="font-size: 16px;" class="fa-solid fa-arrow-up-wide-short"></i></td>
                    <td>Quilometragem <i style="font-size: 16px;" class="fa-solid fa-arrow-up-wide-short"></i></td>
                    <td>Ano/Modelo <i style="font-size: 16px;" class="fa-solid fa-arrow-up-wide-short"></i></td>
                    <td>Visualização</td>
                </tr>
        <?php 
            foreach ($automoveis as $key => $value) {
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