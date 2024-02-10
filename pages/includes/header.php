<?php 
$url = $url = explode('/',@$_GET['url'])[0];
$slides = Painel::selectAll('tb_site.slides');
$site = Painel::select('tb_site.config', false);
if(isset($_GET['loggout'])){
    \view\Login::loggout();
}
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
	<meta name="author" content="Allan R.T Sanches">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="revenda de automóveis,veículos seminovos,indústria-automobilística">
	<meta name="description" content="Revenda de automóveis">
	<link rel="icon" href="<?php echo INCLUDE_PATH; ?>supercar.ico" type="image/x-ico" />
	<meta charset="utf-8">
	<title><?php echo $site['titulo'];?></title>
</head>
<body>
    <base base="<?php INCLUDE_PATH; ?>" />

	<div class="overlay-loading">
		<img src="<?php echo INCLUDE_PATH; ?>imagens/Spinner-1s-200px.gif" />
	</div>

	<header>
		<div class="center">
			<div class="logo"></div>

			<div class="ajax-msg"></div>

			<div class="notification outside"></div>

			<nav class="descktop">
				<ul>
					<li><a title="Home" href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a title="Veículos" href="<?php echo INCLUDE_PATH; ?>automoveis">Veículos</a></li>
				</ul>
				<div class="login-loggout">
				<?php 
						if(!\view\Login::logado()){ 
							$url = explode('/',@$_GET['url']);
							if(count($url) >= 2){?>
								<a title="login" href="http://localhost/revendas.supercar/login"><i class="fa-solid fa-arrow-right-to-bracket"></i> <span>Login</span></a>
								<?php }else{ ?>
								<a title="login" href="<?php INCLUDE_PATH; ?>login"><i class="fa-solid fa-arrow-right-to-bracket"></i> <span>Login</span></a> 
								<?php } ?> 
				<?php  }else { 
					   		if($_SESSION['img'] == ''){ ?> 
								<div class="avatar-usuario">
									<i class="fa fa-user"></i>
								</div><!-- avatar-usuario -->
				<?php	 	}else { ?>
								<div class="imagem-usuario">
									<img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/clientes/<?php echo $_SESSION['img']; ?>">
								</div><!-- avatar-usuario -->
				<?php 		} ?>
							<div class="menu">
								<div class="menu-wrapper">
									<div class="notification inside"></div>

								<?php if($_SESSION['img'] == '') {?>
										<div class="avatar-usuario">
											<i class="fa fa-user"></i>
										</div><!-- avatar-usuario -->
								<?php }else {?>
									<div class="imagem-usuario">
										<img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/clientes/<?php echo $_SESSION['img']; ?>">
									</div><!-- imagem-usuario -->
								<?php } ?>
										
						<?php 	if(mb_strlen($_SESSION['nome']) <= 16){?>
									<div class="nome-usuario">
										<p><?php echo $_SESSION['nome']; ?></p>
									</div><!-- nome-usuario -->
								<?php }else {?>
									<div class="nome-usuario">
										<p><?php echo substr($_SESSION['nome'], 0, 16).'...'; ?></p>
									</div><!-- nome-usuario -->
								<?php } ?>
						<?php 	if(mb_strlen($_SESSION['email']) <= 21){?>
									<div class="email-usuario">
										<p><?php echo $_SESSION['email']; ?></p>
									</div><!-- email-usuario -->
								<?php }else {?>
									<div class="email-usuario">
										<p><?php echo substr($_SESSION['email'], 0, 21).'...'; ?></p>
									</div><!-- email-usuario -->
								<?php }?>
									<div class="items-menu">
										<div class="range">
											<a class="my-acquisitions" title="Minhas aquisições" href="<?php echo INCLUDE_PATH; ?>gerenciar-compras"> <span>Minhas Aquisições</span></a>
										</div>
										<div class="range">
											<a title="Editar perfil" href="<?php INCLUDE_PATH?>editar-perfil"> <span>Editar Perfil</span></a>
											<a title="Sair" href="<?php echo INCLUDE_PATH; ?>?loggout"> <span>Sair</span></a>
										</div>
									</div><!-- items-menu -->
								</div><!-- menu-wrapper -->
							</div><!-- menu -->
				<?php  } ?>	    
				</div><!-- login-loggout -->
			</nav>

			<nav class="mobile right">
				<div class="botao-menu-mobile">
					<i class="fa-solid fa-bars"></i>
				</div>
				<ul>
					<?php if(\view\Login::logado()){?>
						<?php if($_SESSION['img'] == ''){?>
							<div class="user-area">
								<div class="avatar-usuario">
									<i class="fa fa-user"></i>
								</div><!-- avatar-usuario -->
							</div>
						<?php }else{ ?>
							<div class="user-area">
								<div class="imagem-usuario">
									<img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/clientes/<?php echo $_SESSION['img']; ?>">
								</div><!-- imagem-usuario -->
							</div>
						<?php }?>
						<?php 	if(mb_strlen($_SESSION['nome']) <= 18){?>
									<div class="nome-usuario">
										<p><?php echo $_SESSION['nome']; ?></p>
									</div><!-- nome-usuario -->
								<?php }else {?>
									<div class="nome-usuario">
										<p><?php echo substr($_SESSION['nome'], 0, 18).'...'; ?></p>
									</div><!-- nome-usuario -->
								<?php } ?>
						<?php 	if(mb_strlen($_SESSION['email']) <= 18){?>
									<div class="email-usuario">
										<p><?php echo $_SESSION['email']; ?></p>
									</div><!-- email-usuario -->
								<?php }else {?>
									<div class="email-usuario">
										<p><?php echo substr($_SESSION['email'], 0, 18).'...'; ?></p>
									</div><!-- email-usuario -->
								<?php }?>
					<?php } ?>
					<li><a title="Home" href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a title="Veículos" href="<?php echo INCLUDE_PATH; ?>automoveis">Veículos</a></li>
					<?php if(\view\Login::logado()){?>
						<li><a title="Minhas aquisições" class="my-acquisitions" href="<?php echo INCLUDE_PATH; ?>gerenciar-compras"><span> Minhas Aquisições</span></a></li>
						<li><a title="Editar perfil" href="<?php INCLUDE_PATH?>editar-perfil"><span> Editar Perfil</span></a></li>
					<?php } ?>
					<li>
						<?php if(!\view\Login::logado()){ ?>
							<?php if($url >= 2){?>
								<a title="Login" class="login" href="http://localhost/revendas.supercar/login"><span>Login</span></a>
							<?php }else{ ?>
								<a title="Login" class="login" href="<?php INCLUDE_PATH; ?>login"><span>Login</span></a>
							<?php } ?>
						<?php }else {  ?>
							<a title="Sair" class="loggout" href="<?php echo INCLUDE_PATH; ?>?loggout"><span> Sair</span></a>
						<?php } ?>
					</li>
				</ul>
			</nav>
			<div class="clear"></div>
		</div>
	</header>