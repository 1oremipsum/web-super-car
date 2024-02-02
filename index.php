<?php

	include('config.php'); 
	Site::updateUsuarioOnline(); 
	Site::contador();

	$homeController = new controller\HomeController();
	$automovelController = new controller\AutomovelController();

	Router::get('/', function() use ($homeController){
		$homeController->index();
	});

	Router::get('?/?', function($par) use ($automovelController){
		$automovelController->index($par);
	});

	if(isset($_GET['url'])){
		$url = explode('/',@$_GET['url'])[0];
		if($url == 'login'){
			$loginController = new controller\LoginController();
			Router::get('?', function() use ($loginController){
				$loginController->index();
			});
		}else if($url == 'automoveis'){
			$automoveisController = new controller\AutomoveisController();
			Router::get('?', function() use ($automoveisController){
				$automoveisController->index();
			});
		}else if($url == 'gerenciar-compras'){
			$compraController = new controller\CompraController();
			Router::get('?', function() use ($compraController){
				$compraController->index();
			});
		}else if($url == 'gerenciar-compras'){
			$compraController = new controller\CompraController();
			Router::get('?', function() use ($compraController){
				$compraController->index();
			});
		}else if($url == 'editar-perfil'){
			$clienteController = new controller\ClienteController();
			Router::get('?', function() use ($clienteController){
				$clienteController->index();
			});
		}
	}
?>