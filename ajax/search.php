<?php 
	include('../config.php');
	$data = array();
	$data['sucesso'] = true;
	$data = "";

	if(isset($_POST['busca_modelo'])){
		$busca = $_POST['busca_modelo'];

		$marca = $_POST['marca'];
		$modelo = $_POST['modelo'];

		$kmMin = $_POST['km_min'];
		$kmMax = $_POST['km_max'];

		$precoMin = Painel::formatarMoedaBD(str_replace('R$', '', $_POST['preco_min']));
		$precoMax = Painel::formatarMoedaBD(str_replace('R$', '', $_POST['preco_max']));

		$anoMin = $_POST['ano_min'];
		$anoMax = $_POST['ano_max'];
		
		$query = "SELECT * FROM `tb_site.automoveis` WHERE vendido = 0 ";
		
		$query = buscaSimplificada($busca, $query);
		$query = filterMarcaModelo($marca, $modelo, $query);
		$query = filterKm($kmMin, $kmMax, $query);
		$query = filterPreco($precoMin, $precoMax, $query);
		$query = filterAno($anoMin, $anoMax, $query);

		$query .= " ORDER BY `preco` DESC";

		$sql = MySql::conectar()->prepare($query);
		$sql->execute();
		$automoveis = $sql->fetchAll();

		$result = count($automoveis);
		if($result >= 1){
			$data.='<h2 class="title-busca">Listando <b> '.$result.' automóveis</b></h2> 
				<div class="flex-automoveis">';
		}else{
			$data.='<h2 class="title-busca">Nenhum resultado encontrado</h2> 
				<div class="flex-automoveis">';
		}

		foreach ($automoveis as $key => $value) {
			$value['preco'] = Painel::convertMoney($value['preco']);
			$value['quilometragem'] = Painel::convertKm($value['quilometragem']);

			$imgs = \MySql::conectar()->prepare("SELECT imagem FROM `tb_site.imagens_automoveis` WHERE automovel_id = $value[id] ORDER BY order_id LIMIT 1");
			$imgs->execute();
			$imgs = $imgs->fetchAll();

			$comb = \view\Automovel::getCombustivel($value['combustivel']);
			$camb = \view\Automovel::getCambio($value['cambio']);

        	foreach ($imgs as $key => $img){
				$data.='
				<div class="box-automovel-hidden">
					<div class="box-automovel"> 
						<img src="'.INCLUDE_PATH_PAINEL.'uploads/automoveis/'.$img['imagem'].'" />
						<div class="box-automovel-wrapper">
							<div class="box-automovel-header">
								<h2>'.$value['marca'].' - '.$value['modelo'].'</h2>
							</div>
							<div class="box-automovel-info">  
								<p><i class="fa-solid fa-angle-right"></i> 
								Combustível: '.$comb.'</p>

								<p><i class="fa-solid fa-angle-right"></i> 
								Quilometragem: '.$value['quilometragem'].' Km</p>

								<p><i class="fa-solid fa-angle-right"></i> 
								Câmbio: '.$camb.'</p>
							</div>
							<div class="price-area">
								<h3>POR APENAS</h3>
								<p>R$ '.$value['preco'].'</p>
							</div>
							<div class="btn-area">
								<a class="btn-view" href="'.INCLUDE_PATH.'automovel/'.$value['slug'].'">Estou Interessado!</a>
							</div>
						</div><!-- box-automovel-wrapper -->
					</div><!-- box-automovel -->
				</div><!-- box-automovel-hidden -->';
			}
		}
		$data.='</div><!-- flex-automoveis -->';
		echo $data;
	}

	function buscaSimplificada($busca, $query){
		if($busca != ''){
			$query.="AND `marca` LIKE '%$busca%' OR `modelo` LIKE '%$busca%' OR `versao` LIKE '%$busca%' ";
		}
		return $query;
	}

	function filterMarcaModelo($marca, $modelo, $query){
		if($marca != '' || $modelo != ''){
			$query = "SELECT * FROM `tb_site.automoveis` WHERE vendido = 0 ";
			$query.="AND `marca` LIKE '%$marca%' AND `modelo` LIKE '%$modelo%' ";
		}
		return $query;
	}

	function filterKm($kmMin, $kmMax, $query){
		if($kmMin != '' && $kmMax != ''){
			$query.="AND `quilometragem` >= '$kmMin' AND `quilometragem` <= '$kmMax' ";
		}
		return $query;
	}

	function filterPreco($precoMin, $precoMax, $query){
		if($precoMin != '' && $precoMax != ''){
			$query.="AND `preco` >= '$precoMin' AND `preco` <= '$precoMax' ";
		}
		return $query;
	}

	function filterAno($anoMin, $anoMax, $query){
		if($anoMin != '' && $anoMax != ''){
			$query.="AND `ano_mod` >= '$anoMin' AND `ano_mod` <= '$anoMax' ";
		}
		return $query;
	}
?>