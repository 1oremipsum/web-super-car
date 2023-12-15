<?php 
	include('config.php'); 
	Site::updateUsuarioOnline(); 
	Site::contador();

	$homeController = new controller\HomeController();
	$automoveisController = new controller\AutomoveisController();
	$automovelController = new controller\AutomovelController();

	Router::get('/', function() use ($homeController){
		$homeController->index();
	});

	Router::get('?', function() use ($automoveisController){
		$automoveisController->index();
	});

	Router::get('?/?', function($par) use ($automovelController){
		$automovelController->index($par);
	});
?>