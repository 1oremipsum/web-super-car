<?php verificaPermissao(1); 
    $automoveis = Painel::selectAll('tb_site.automoveis');
    $concess = Painel::selectAll('tb_site.concessionarias');
?>
<div class="box-content">
    <h2><i class="fa-solid fa-car-rear"></i><i style="font-size: 15px;" class="fa-solid fa-gears"></i> Gerenciar Autmóveis | Cadastro & Listagem</h2>

    <form method="post" enctype="multipart/form-data">
    <?php 
        if(isset($_POST['acao'])){
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $preco = $_POST['preco'];
            $quilometragem = $_POST['quilometragem'];
            $anoFab = $_POST['ano_fab'];
            $anoMod = $_POST['ano_mod'];
            $idConcessionaria = $_POST['id_concessionaria'];

            $imagens = array();
            $amountFiles = count($_FILES['imagem']['name']);

            $sucesso = true;

            if($quilometragem < 0 || $quilometragem > 500000){
                $sucesso = false;
                Painel::alert('erro', 'Quilometragem inválida.');
            }

            if(strlen($anoFab) != 4 && ($anoFab < 2010 || $anoFab > date("Y"))){
               $sucesso = false;
               Painel::alert('erro', 'Ano de fabricação inválido.');
            }

            if(strlen($anoMod) != 4 && ($anoMod < 2010 || $anoMod > date("Y"))){
                $sucesso = false;
                Painel::alert('erro', 'Ano modelo inválido.');
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
            }else{
                $sucesso = false;
                Painel::alert('erro', 'É necessário selecionar pelo menos uma imagem!');
            }

            if($sucesso){
                for($i=0; $i < $amountFiles; $i++){
                    $currentImg = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i], 
                    'name'=>$_FILES['imagem']['name'][$i]];
                    $imagens[] = Painel::uploadFile('uploads/automoveis',$currentImg);
                }

                $sql = MySql::conectar()->prepare("INSERT INTO `tb_site.automoveis` VALUES (null,?,?,?,?,?,?,?,?,?)");
                $sql->execute(array($idConcessionaria, $marca, $modelo, $anoFab, $anoMod, $preco, $quilometragem, 0 ,0));
                $lastId = MySql::conectar()->lastInsertId();
                MySql::conectar()->exec("UPDATE `tb_site.automoveis` SET order_id = $lastId WHERE id = $lastId");

				foreach ($imagens as $key => $value) {
					MySql::conectar()->exec("INSERT INTO `tb_site.imagens_automoveis` VALUES (null,$lastId,'$value',0)");
                    $lastId2 = MySql::conectar()->lastInsertId();
                    MySql::conectar()->exec("UPDATE `tb_site.imagens_automoveis` SET order_id = $lastId2 WHERE id = $lastId2");
				}
                
                $automoveis = Painel::selectAll('tb_site.automoveis');
            }
        }
    ?>
        <div class="card-title"><i class="fa-solid fa-car-rear"></i><i class="fa-solid fa-plus"></i> Cadastrar Automóvel</div>

        <div class="form-group">
            <label>Marca</label>
            <input type="text" name="marca" required />
        </div><!-- form-group -->

        <div class="form-group">
            <label>Modelo</label>
            <input type="text" name="modelo" required />
        </div><!-- form-group -->

        <div class="form-group W50 left">
            <label>Preço</label>
            <input type="text" name="preco" placeholder="R$ 0,00" required />
        </div><!-- form-group -->

        <div class="form-group W50 right">
            <label>Quilometragem</label>
            <input type="number" name="quilometragem" min="0" max="500000" required 
            placeholder="max: 500.000 km"/>
        </div><!-- form-group -->
        <div class="clear"></div>

        <div class="form-group right" style="width: 24%;">
            <label>Ano Modelo</label>
            <input min="2010" max="2023" type="number" name="ano_mod" required
            placeholder="min/max: 2010/<?php echo date("Y");?>"/>
        </div><!-- form-group -->

        <div class="form-group right" style="width: 25%; padding-right: 15px;">
            <label>Ano de Fabricação</label>
            <input min="2010" max="2023" type="number" name="ano_fab" required
            placeholder="min/max: 2010/<?php echo date("Y");?>"/>
        </div><!-- form-group -->
        
        <div class="form-group"">
            <label>Concessionária</label>
            <select style="width: 49%;" name="id_concessionaria" required>
                <?php 
                    $concess = Painel::selectAll('tb_site.concessionarias'); 
                    foreach ($concess as $key => $value) {
                ?>
                <option <?php if($value['id'] == @$_POST['id_concessionaria']) echo 'selected'; ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Selecione Imagens</label>
            <input type="file" multiple name="imagem[]" required />
        </div><!-- form-group -->

        <div class="form-group">
            <input type="submit" name="acao" value="Enviar!" />
        </div><!-- form-group -->
    </form>

    <div style="margin-top: 30px;" class="wrapper-table">
        <div class="card-title"><i class="fa-solid fa-car-rear"></i><i class="fa-solid fa-list-check"></i> Automóveis Cadastrados</div>
            <table style="margin: 5px 0;">
                <tr>
                    <td>Concessionária</td>
                    <td>Marca <i class="fa-solid fa-arrow-down-a-z"></i></td>
                    <td>Modelo</td>
                    <td>Preço <i class="fa-solid fa-arrow-up-wide-short"></i></td>
                    <td>Ano/Modelo <i class="fa-solid fa-arrow-up-wide-short"></i></td>
                    <td>Quilometragem <i class="fa-solid fa-arrow-up-wide-short"></i></td>
                    <td>Visualização</td>
                </tr>
        <?php 
            foreach ($automoveis as $key => $auto) {
                foreach ($concess as $key => $conc) {
                    if($auto['id_concessionaria'] == $conc['id']){
        ?>
            <tr class="body">
                <td><?php echo $conc['nome'];?></td>
                <td><?php echo $auto['marca'];?></td>
                <td><?php echo $auto['modelo'];?></td>
                <td>R$ <?php echo $auto['preco'];?></td>
                <td><?php echo $auto['ano_fab'];?>/<?php echo $auto['ano_mod'];?></td>
                <td><?php echo $auto['quilometragem'];?> Km</td>
                <td><a class="btn-view" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-automovel?id=<?php echo $auto['id']; ?>"><i class="fa-solid fa-eye"></i> Visualizar</a></td>
            </tr>
    <?php       
                   }
                }
            }             
    ?>
        </table>
    </div><!-- wrapper-table -->
</div><!-- box-content -->