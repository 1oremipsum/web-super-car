<?php 
	include('config.php'); 
	Site::updateUsuarioOnline(); 
	Site::contador();
	
	$infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_site.config`");
	$infoSite->execute();
	$infoSite = $infoSite->fetch();	
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>fontawesome/css/all.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH; ?>css/style.css" type="text/css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="revenda,automóveis,carros,motos,indústria-automobilística">
	<meta name="description" content="Revenda de Automóveis">
	<link rel="icon" href="<?php echo INCLUDE_PATH; ?>super.ico" type="image/x-ico" />
	<meta charset="utf-8">
	<title><?php echo $infoSite['titulo'];?></title>
</head>

<body>
	<base base="<?php echo INCLUDE_PATH; ?>" />
	<?php
	$url = isset($_GET['url']) ? $_GET['url'] : 'home';
	switch ($url) {
		case 'sobre':
			echo '<target target="sobre" />';
			break;

		case 'servicos':
			echo '<target target="servicos" />';
			break;
	}
	?>

	<div class="sucesso">Formulário enviado com sucesso!</div>
	<div class="overlay-loading">
		<img src="<?php echo INCLUDE_PATH; ?>imagens/Spinner-1s-200px.gif" />
	</div>

	<header>
		<div class="center">
			<div class="logo"><img src="<?php echo INCLUDE_PATH; ?>imagens/super_300x180.png" /></div>
			<nav class="descktop right">
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
				</ul>
			</nav>
			<nav class="mobile right">
				<div class="botao-menu-mobile">
					<i class="fa-solid fa-bars"></i>
				</div>
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
				</ul>
			</nav>
			<div class="clear"></div>
		</div>
	</header>

	<div class="container-principal">
		<?php
		if (file_exists('pages/' . $url . '.php')) {
			include('pages/' . $url . '.php');
		} else {
			if ($url != 'sobre' && $url != 'servicos') {
				$pg404 = true;
				include('pages/404.php');
			} else {
				include('pages/home.php');
			}
		}
		?>
	</div>

	<footer <?php if (isset($pg404) && $pg404 == true) echo 'class="fixed"'; ?>>
		<div class="center">
			<p>Super.car - Todos os direitos reservados.</p>
		</div>
	</footer>
	
	<script src="<?php echo INCLUDE_PATH; ?>js/jquery-3.7.0.min.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>

	<script defer src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4&callback=Function.prototype'></script>

	<script defer src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>

	<script src="<?php echo INCLUDE_PATH; ?>js/qualidades.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>
</body>

</html>