<?php 

	$slides = MySql::conectar()->prepare("SELECT * FROM `tb_site.slides` ORDER BY order_id ASC");
	$slides->execute(array());
	$slides = $slides->fetchAll();
	
?>
<section class="banner-container">
	<?php foreach ($slides as $key => $value) { ?>

	<div style="background-image: url('<?php echo INCLUDE_PATH; ?>imagens/<?php echo $value['slide']; ?>');" class="banner-single"></div>

	<?php } ?>
	
	<div class="overlay"></div>
	<div class="center">
		<form method="post" class="ajax-form">
			<h2>Seu melhor e-mail!</h2>
			<input type="email" name="email" required />
			<input type="hidden" name="identificador" value="from_home" />
			<input type="submit" name="acao" value="Cadastrar!">
		</form>
	</div>
	
	<div class="bullets"></div>
</section>

<section class="descricao-empresa">
	<div class="center">
		<div id="sobre" class="w50 left">
			<h2>Sobre nós</h2>
			<p><?php echo $infoSite['desc_empresa']; ?></p>
		</div>

		<div class="w50 right">
			<img class="right" style="border-radius: 15px;" src="<?php echo INCLUDE_PATH; ?>imagens/empresa_resized.jpg" />
		</div>
		<div class="clear"></div>
	</div>
</section>

<section class="qualidades">
	<div class="center">
		<h2 class="title">Nossas melhores qualidades</h2>
		<div class="w33 left box-qualidade">
			<h3><i class="<?php echo $infoSite['icone1'];?>"></i></h3>
			<h4><?php echo $infoSite['qualidade1'];?></h4>
			<p><?php echo $infoSite['descricao1']; ?></p>
		</div>
		<div class="w33 left box-qualidade">
			<h3><i class="<?php echo $infoSite['icone2'];?>"></i></h3>
			<h4><?php echo $infoSite['qualidade2'];?></h4>
			<p><?php echo $infoSite['descricao2']; ?></p>
		</div>
		<div class="w33 left box-qualidade">
			<h3><i class="<?php echo $infoSite['icone3'];?>"></i></h3>
			<h4><?php echo $infoSite['qualidade3'];?></h4>
			<p><?php echo $infoSite['descricao3']; ?></p>
		</div>
		<div class="clear"></div>
	</div>
</section>

<section class="extras">
	<div class="center">
		<div class="w50 left depoimentos-container">
			<h2 class="title">Depoimentos dos nossos clientes</h2>
			<?php 
				$sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.depoimentos` ORDER BY order_id DESC LIMIT 3");
				$sql->execute();
				$depoimentos = $sql->fetchAll();
				foreach ($depoimentos as $key => $value) {
			?>
			<div class="depoimento-single">
				<p class="depoimento-descricao">"<?php echo $value['depoimento']; ?>"</p>
				<p class="nome-autor"><?php echo $value['nome']; ?> - <?php echo $value['data']; ?></p>
			</div>
			<?php } ?>
		</div>
		<div id="servicos" class="w50 left servicos-container">
			<h2 class="title">Serviços</h2>
			<div class="servicos-info">
				<ul>
					<?php 
						$sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.servicos` ORDER BY order_id ASC LIMIT 3");
						$sql->execute();
						$servicos = $sql->fetchAll();
						foreach ($servicos as $key => $value) {
					?>
					<li><?php echo $value['servico']; ?></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</section>