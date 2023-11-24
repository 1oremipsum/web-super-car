<?php
	$id = (int)$_GET['id'];
	$automovel = MySql::conectar()->prepare("SELECT * FROM `tb_site.automoveis` WHERE id = ?");
	$automovel->execute(array($id));

	if($automovel->rowCount() == 0){
		Painel::alert('erro','Carro inexistente!');
		die();
	}

	$infoAuto = $automovel->fetch();
	$automovelImgs = Painel::selectQuery('tb_site.imagens_automoveis', "automovel_id = $id ORDER BY order_id ASC", null);
?>

<div class="box-content">
	<h2><i class="fa-solid fa-pen-to-square"></i> Editar Automóvel | Visualizar Imagens</h2>
	<?php
	if(isset($_GET['deletarImagem'])){
		$idImagem = $_GET['deletarImagem'];
		@unlink(BASE_DIR_PAINEL.'/uploads/automoveis/'.$idImagem);
		MySql::conectar()->exec("DELETE FROM `tb_site.imagens_automoveis` WHERE imagem = '$idImagem'");
		Painel::alert('sucesso','A imagem foi deletada com sucesso!');
		$automovelImgs = Painel::selectQuery('tb_site.imagens_automoveis', 'automovel_id = ?', array($id));

	}else if(isset($_GET['deletarAutomovel'])){
		foreach ($automovelImgs as $key => $value) {
			@unlink(BASE_DIR_PAINEL.'/uploads/automoveis/'.$value['imagem']);
		}
		MySql::conectar()->exec("DELETE FROM `tb_site.imagens_automoveis` WHERE automovel_id = $id");
		Painel::deletar('tb_site.automoveis', $id);
		Painel::alertJS("O automóvel foi removido com sucesso!");
		Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-automoveis');
	}
	?>
	<form method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>editar-automovel?id=<?php echo $id; ?>" enctype="multipart/form-data">
	<?php 
		if(isset($_POST['acao'])){
			$marca = $_POST['marca'];
			$modelo = $_POST['modelo'];
			$preco = $_POST['preco'];
			$quilometragem = $_POST['quilometragem'];
			$anoMod = $_POST['ano_mod'];
			$anoFab = $_POST['ano_fab'];
			$concess = $_POST['id_concessionaria'];

			$imagens = array();
            $amountFiles = count($_FILES['imagem']['name']);

            $sucesso = true;

			if($marca == '' || $modelo == ''){
				$sucesso = false;
				Painel::alert('erro', 'Marca ou modelo não podem estar vázios!');
			}

			if($quilometragem != ''){
				if($quilometragem < 0 || $quilometragem > 500000){
					$sucesso = false;
					Painel::alert('erro', 'Quilometragem inválida.');
				}
			}

			if($anoFab != ''){
				if(strlen($anoFab) != 4 && ($anoFab < 2010 || $anoFab > date("Y"))){
					$sucesso = false;
					Painel::alert('erro', 'Ano de fabricação inválido.');
				}
			}
			
			if($anoMod != ''){ 
				if(strlen($anoMod) != 4 && ($anoMod < 2010 || $anoMod > date("Y"))){
					$sucesso = false;
					Painel::alert('erro', 'Ano modelo inválido.');
            	}
			}

            if($_FILES['imagem']['name'][0] != ''){
                for($i=0; $i < $amountFiles; $i++){
                    $currentImg = ['type'=>$_FILES['imagem']['type'][$i], 
                    'size'=>$_FILES['imagem']['size'][$i]];
                    if(!Painel::imagemValida($currentImg)){
                        $sucesso = false;
                        Painel::alert('erro', 'Uma das imagens selecionadas são inválidas.');
                        break;
                    }
                }
            }

			if($sucesso){
				if($_FILES['imagem']['name'][0] != ''){
					for($i=0; $i < $amountFiles; $i++){
						$currentImg = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i], 
						'name'=>$_FILES['imagem']['name'][$i]];
						$imagens[] = Painel::uploadFile('uploads/automoveis',$currentImg);
					}

					foreach ($imagens as $key => $value) {
						MySql::conectar()->exec("INSERT INTO `tb_site.imagens_automoveis` VALUES (null,$id,'$value',0)");
						$lastId = MySql::conectar()->lastInsertId();
						MySql::conectar()->exec("UPDATE `tb_site.imagens_automoveis` SET order_id = $lastId WHERE id = $lastId");
					}

					$arr = ['id_concessionaria'=>$concess, 'marca'=>$marca, 'modelo'=>$modelo, 'ano_fab'=>$anoFab, 'ano_mod'=>$anoMod, 'preco'=>$preco, 'quilometragem'=>$quilometragem, 'id'=>$id, 'nome_tabela'=>'tb_site.automoveis'];
					Painel::update($arr);

					$infoAuto = Painel::select('tb_site.automoveis', 'id = ?', array($id)); //update
					$automovelImgs = Painel::selectQuery('tb_site.imagens_automoveis', "automovel_id = $id ORDER BY order_id ASC", null);
				}else{
					$arr = ['id_concessionaria'=>$concess, 'marca'=>$marca, 'modelo'=>$modelo, 'ano_fab'=>$anoFab, 'ano_mod'=>$anoMod, 'preco'=>$preco, 'quilometragem'=>$quilometragem, 'id'=>$id, 'nome_tabela'=>'tb_site.automoveis'];
					Painel::update($arr);
					
					$infoAuto = Painel::select('tb_site.automoveis', 'id = ?', array($id)); //update
				}
				Painel::redirect(INCLUDE_PATH_PAINEL."editar-automovel?id=$id");
			}
		}
	?>
	<div class="card-title"><i style="font-size: 18px;" class="fa-solid fa-circle-info"></i> Informações do Automóvel: <?php echo $infoAuto['marca']; ?> - <?php echo $infoAuto['modelo']; ?></div>

		<div class="form-group">
            <label>Marca</label>
            <input type="text" name="marca" value="<?php echo $infoAuto['marca'];?>" required />
        </div><!-- form-group -->

        <div class="form-group">
            <label>Modelo</label>
            <input type="text" name="modelo" value="<?php echo $infoAuto['modelo'];?>" required />
        </div><!-- form-group -->

        <div class="form-group W50 left">
            <label>Preço</label>
            <input type="text" name="preco" value="<?php echo $infoAuto['preco'];?>" required />
        </div><!-- form-group -->

        <div class="form-group W50 right">
            <label>Quilometragem</label>
            <input type="number" name="quilometragem" min="0" max="500000" required 
            placeholder="max: 500.000 km" value="<?php echo $infoAuto['quilometragem'];?>" />
        </div><!-- form-group -->
        <div class="clear"></div>

        <div class="form-group right" style="width: 25%;">
            <label>Ano Modelo</label>
            <input min="2010" max="2023" type="number" name="ano_mod" required
            placeholder="min/max: 2010/<?php echo date("Y");?>" value="<?php echo $infoAuto['ano_mod'];?>"/>
        </div><!-- form-group -->

        <div class="form-group right" style="width: 24%; padding-right: 15px;">
            <label>Ano de Fabricação</label>
            <input min="2010" max="2023" type="number" name="ano_fab" required
            placeholder="min/max: 2010/<?php echo date("Y");?>" value="<?php echo $infoAuto['ano_fab'];?>" />
        </div><!-- form-group -->
        
        <div class="form-group"">
            <label>Concessionária</label>
            <select style="width: 49%;" name="id_concessionaria"  <?php if($value['id'] == $infoAuto['id_concessionaria']) echo 'selected'; ?> value="<?php echo $value['id']; ?>" required>
                <?php 
                    $concess = Painel::selectAll('tb_site.concessionarias'); 
                    foreach ($concess as $key => $value) {
                ?>
                <option <?php if($value['id'] == @$_POST['id_concessionaria']) echo 'selected'; ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                <?php } ?>
            </select>
        </div>
	
		<div class="form-group">
			<label>Selecione as imagens</label>
			<input multiple type="file" name="imagem[]">
		</div><!--form-group-->

		<div class="single-btn">
			<a class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-automovel?id=<?php echo $id; ?>&deletarAutomovel"><i class="fa-regular fa-trash-can"></i> <span>Excluir Automóvel</span></a>
		</div><!-- single-btn -->

		<div class="form-group">
            <input type="submit" name="acao" value="Atualizar!" />
        </div><!-- form-group -->
	</form>

	<div class="boxes">
		<div style="margin-top: 30px;" class="card-title"><i style="font-size: 22px;" class="fa-solid fa-images"></i> Imagens do Automóvel: <?php echo $infoAuto['marca']; ?> - <?php echo $infoAuto['modelo']; ?></div>
		<?php
			foreach ($automovelImgs as $key => $value){
		?>
		<div id="item-<?php echo $value['id']; ?>" class="box-single-wraper">
			<div class="box-single-img">
				<div class="box-imgs">
					<img class="img-square" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/automoveis/<?php echo $value['imagem']; ?>" />
				</div><!--box-imgs-->
				
				<div style="text-align: center;" class="group-btn">
					<a class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-automovel?id=<?php echo $id; ?>&deletarImagem=<?php echo $value['imagem']; ?>"><i class="fa-regular fa-trash-can"></i> Excluir</a>
				</div><!--group-btn-->
			</div><!-- box-single-img -->
		</div><!--box-single-wraper-->
		<?php } ?>
	</div><!--boxes-->
</div>