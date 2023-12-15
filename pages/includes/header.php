<?php 
$infoSite = Painel::select('tb_site.config'); 
$slides = Painel::selectAll('tb_site.slides');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>fontawesome/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
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
    <base base="<?php INCLUDE_PATH; ?>" />

    <div class="sucesso">Formulário enviado com sucesso!</div>
	<div class="overlay-loading">
		<img src="<?php echo INCLUDE_PATH; ?>imagens/Spinner-1s-200px.gif" />
	</div>

	<header>
		<div class="center">
			<div class="logo"></div>
			<nav class="descktop">
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>automoveis">Veículos</a></li>
					<li><a href="">Sobre</a></li>
					<li><a href="">Contato</a></li>
				</ul>
			</nav>
			<nav class="mobile right">
				<div class="botao-menu-mobile">
					<i class="fa-solid fa-bars"></i>
				</div>
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>automoveis">Veículos</a></li>
					<li><a href="">Sobre</a></li>
					<li><a href="">Contato</a></li>
				</ul>
			</nav>
			<div class="clear"></div>
		</div>
	</header>