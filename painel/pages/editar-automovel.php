<?php
	$id = (int)$_GET['id'];
	$automovel = MySql::conectar()->prepare("SELECT * FROM `tb_site.automoveis` WHERE id = ?");
	$automovel->execute(array($id));

	if($automovel->rowCount() == 0){
		Painel::alert('erro','Carro inexistente!');
		die();
	}

	$infoAuto = $automovel->fetch();
	$automovelImgs = MySql::conectar()->prepare("SELECT * FROM `tb_site.imagens_automoveis` WHERE automovel_id = $id");
	$automovelImgs->execute();
	$automovelImgs = $automovelImgs->fetchAll();
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

        <div class="form-group right" style="width: 24%;">
            <label>Ano Modelo</label>
            <input min="2010" max="2023" type="number" name="ano_mod" required
            placeholder="min/max: 2010/<?php echo date("Y");?>" value="<?php echo $infoAuto['ano_mod'];?>"/>
        </div><!-- form-group -->

        <div class="form-group right" style="width: 25%; padding-right: 15px;">
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
			<a class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-automovel?id=<?php echo $id; ?>&deletarAutomovel"><i class="fa-regular fa-trash-can"></i> Excluir Automóvel</a>
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
		<div class="box-single-wraper">
			<div style="width: 285px; background: #000025; border-radius: 8px; border: 1px solid white; padding:8px 15px;">
			<div style="width: 100%; " class="box-imgs left">
				<img class="img-square" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/automoveis/<?php echo $value['imagem']; ?>" />
			</div><!--box-imgs-->
			<div class="clear"></div>
			<div style="text-align: center;" class="group-btn">
				<a class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-automovel?id=<?php echo $id; ?>&deletarImagem=<?php echo $value['imagem']; ?>"><i class="fa-regular fa-trash-can"></i> Excluir</a>
			</div><!--group-btn-->
			
			</div>
		</div><!--box-single-wraper-->
		<?php } ?>
	</div><!--boxes-->
</div>