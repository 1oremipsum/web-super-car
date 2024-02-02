<?php 
	$parameters = \view\MainView::$par;
	$site = Painel::select('tb_site.config', false);
?>
<section class="banner-container">
	<?php foreach ($slides as $key => $value) { ?>
	<div style="background-image: url('<?php echo INCLUDE_PATH; ?>imagens/<?php echo $value['slide']; ?>');" class="banner-single"></div>
	<?php } ?>
	
	<div class="home-dialog">
		<h2><?php echo $site['titulo_msg_banner'];?></h2>
		<h1><?php echo $site['msg_banner']?></h1>
		<button>
			<a href="<?php INCLUDE_PATH?>automoveis">Continuar <i class="fa-regular fa-circle-check"></i></a>
		</button>
	</div>

	<div class="overlay"></div>
	<div class="bullets"></div>
</section><!-- banner-container -->

<section class="description">
		<h2><?php echo $site['descricao1']?></h2>
</section>

<section class="list-automoveis">  
	<div class="home-flex-automoveis owl-carousel">
	<?php 
		foreach ($parameters['veiculos'] as $key => $value) {
			$value['preco'] = Painel::convertMoney($value['preco']);
			$value['quilometragem'] = Painel::convertKm($value['quilometragem']);

			$imgs = \MySql::conectar()->prepare("SELECT imagem FROM `tb_site.imagens_automoveis` WHERE automovel_id = $value[id] ORDER BY order_id LIMIT 1");
			$imgs->execute();
			$imgs = $imgs->fetchAll();

        	foreach ($imgs as $key => $img){
    ?>  
		<div class="home-box-automovel-hidden">
			<div class="home-box-automovel"> 
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
						Câmbio: <?php echo \view\Automovel::getCambio($value['cambio']);?></p>
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
	</div><!-- home-flex-automoveis owl-carousel -->
</section>