<?php 
	@session_start();
	date_default_timezone_set('America/Sao_Paulo');
	
	$autoload = function($class){
		if($class == 'Email'){
			require_once('classes/phpmailer/PHPMailerAutoload.php');
		}
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	define('INCLUDE_PATH','http://localhost/websupercar/');
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

	define('BASE_DIR_PAINEL', __DIR__.'/painel');

	define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','super_car');

	define('NOME_EMPRESA', 'SuperCar');
	
	function getCargo($indice){
		return Painel::$cargos[$indice];
	}

	function selecionadoMenu($par){
		$url = explode('/',@$_GET['url'])[0];
		if($url == $par){
			echo 'class="menu-active"';
		}
	}

	function verificaPermissaoMenu($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			echo 'style="display:none;"';
		}
	}

	function verificaPermissao($permissao, $tipoDeAcao = ""){
		switch ($tipoDeAcao) {
			case "delete":
				if($_SESSION['cargo'] >= $permissao){
					return true;
				}else{
					Painel::alert("erro", "Você não possui permissão para deletar este conteúdo!");
					die();
				}
				break;
			
			case "edit":
				if($_SESSION['cargo'] >= $permissao){
					return true;
				}else{
					Painel::alert("erro", "Você não possui permissão para editar este conteúdo!");
					die();
				}
				break;
				
			default:
				if($_SESSION['cargo'] >= $permissao){
					return true;
				}else{
					include('painel/pages/permissao_negada.php');
					die();
				}
				break;
		}
	}

	function recoverPost($post){
		if(isset($_POST[$post])){
			echo $_POST[$post];
		}
	}
 ?>