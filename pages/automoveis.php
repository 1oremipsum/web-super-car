<?php
    $automoveis = \view\Automovel::getAutomoveis();
?>

<section class="search-area">
    <section class="search-1">
        <div class="filter-btn">
            <p><i class="fa-solid fa-list-check"></i> Filtrar</p>
        </div>
        <div class="clear"></div>
        <div class="search-box">
            <input class="search-txt" type="text" name="busca" placeholder="O que está buscando? (Busque por uma palavra chave)">
            <button class="search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div><!-- search-box -->
        <div class="clear"></div>
    </section><!-- search-1 -->

    <section class="search-2">
        <form method="post" action="<?php echo INCLUDE_PATH ?>ajax/search.php">
            <div class="form-group">
                <input name="marca" type="text" placeholder="Marca">
            </div><!-- form-group -->

            <div class="form-group">
                <input  name="modelo" type="text" placeholder="Modelo">
            </div><!-- form-group -->

            <div class="form-group">
                <input name="km_min" type="number" min="0" max="500000" placeholder="Quilometragem Mínima">
            </div><!-- form-group -->

            <div class="form-group">
                <input  name="km_max" type="number" min="0" max="500000" placeholder="Quilometragem Máxima">
            </div><!-- form-group -->

            <div class="form-group">
                <input name="preco_min" type="text" min="0" max="5000000" placeholder="Preço Mínimo">
            </div><!-- form-group -->

            <div class="form-group">
                <input name="preco_max" type="text" min="0" max="5000000" placeholder="Preço Máximo">
            </div><!-- form-group -->

            <div class="form-group">
                <input name="ano_min" type="number" min="2010" max="<?php echo date("Y")?>" placeholder="Ano Mínimo">
            </div><!-- form-group -->

            <div class="form-group">
                <input name="ano_max" type="number" min="2010" max="<?php echo date("Y")?>" placeholder="Ano Máximo">
            </div><!-- form-group -->
            <div class="clear"></div>
        </form>
    </section><!-- search-2 -->
</section><!-- search-area -->

<section class="list-automoveis">
    <h2 class="title-busca">Listando <b><?php echo count($automoveis);?> automóveis</b></h2>
	<div class="flex-automoveis">
    <?php 
        foreach ($automoveis as $key => $value) {
			$value['preco'] = Painel::convertMoney($value['preco']);
			$value['quilometragem'] = Painel::convertKm($value['quilometragem']);

			$imgs = \MySql::conectar()->prepare("SELECT imagem FROM `tb_site.imagens_automoveis` WHERE automovel_id = $value[id] ORDER BY order_id LIMIT 1");
			$imgs->execute();
			$imgs = $imgs->fetchAll();

        	foreach ($imgs as $key => $img){
    ?>  
		<div class="box-automovel-hidden">
			<div class="box-automovel"> 
				<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/automoveis/<?php echo $img['imagem']; ?>" />
				<div class="box-automovel-wrapper">
					<div class="box-automovel-header">
						<h2><?php echo $value['marca'];?> - <?php echo $value['modelo'];?></h2>
					</div>
					<div class="box-automovel-info">

						<p><i class="fa-solid fa-angle-right"></i> 
						Combustível: <?php echo \view\Automovel::getCombustivel($value['combustivel']); ?></p>

						<p><i class="fa-solid fa-angle-right"></i> 
                        Quilometragem: <?php echo $value['quilometragem']; ?> Km</p>

						<p><i class="fa-solid fa-angle-right"></i> 
						Câmbio: <?php echo \view\Automovel::getCambio($value['cambio']); ?></p>
					</div>
					<div class="price-area">
						<h3>POR APENAS</h3>
						<p>R$ <?php echo $value['preco']?></p>
					</div>
					<div class="btn-area">
						<a class="btn-view" href="<?php echo INCLUDE_PATH.'automovel/'.$value['slug'];?>">Estou Interessado!</a>
					</div>
				</div><!-- box-automovel-wrapper -->
			</div><!-- box-automovel -->
		</div><!-- box-automovel-hidden -->
    <?php }} ?>
	</div><!-- flex-automoveis -->
</section>