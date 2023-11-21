<?php 
    verificaPermissao(2);
?>
<div class="box-content">
    <i class="fa-solid fa-building-flag"></i><h2> Cadastrar Concessionária</h2>
    <?php 
        if(isset($_POST['acao'])){
            $sucesso = true;
            $nome = $_POST['nome']; 
            $cnpj = $_POST['cnpj'];  
            $fone = $_POST['fone'];
            $logo = $_FILES['logo']; 

            if($nome != '' || $cnpj != '' || $fone != '' ||$logo != ''){
                $sql = MySql::conectar()->prepare("SELECT id from `tb_site.concessionarias` WHERE cnpj = ?");
                $sql->execute(array($cnpj));
                if($sql->rowCount() != 0){
                    $sucesso = false;
                    Painel::alert('erro', 'Concessionária com este CNPJ já está cadastrada!');
                }

                $sql = MySql::conectar()->prepare("SELECT id FROM `tb_site.concessionarias` WHERE fone = ?");
                $sql->execute(array($fone));
                if($sql->rowCount() != 0){
                    $sucesso = false;
                    Painel::alert('erro', 'Já existe uma concessionária com este telefone!');
                } 

                if(!Painel::imagemValida($logo)){
                    Painel::alert('erro','O formato especificado ou tamanho da imagem não é válido.');
                }

                if($sucesso){
                    $logo = Painel::updateFile($logo, 'uploads/concessionarias');
                    $arr = ['nome'=>$nome, 'cnpj'=>$cnpj, 'fone'=>$fone, 'logo'=>$logo, 'order_id'=>'0', 'nome_tabela'=>'tb_site.concessionarias'];
                    Painel::insert($arr);
                    Painel::alert('sucesso','A concessionária '.$nome.' foi cadastrada com sucesso!');
                }
                
            }else{
                Painel::alert('erro', 'Campos vázios não são permitidos!');
            }
        }
    ?>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nome da Empresa</label>
            <input type="text" name="nome" value="<?php recoverPost('nome');?>" required/>
        </div><!-- form-group -->

        <div class="form-group">
            <label>CNPJ</label>
            <input type="text" name="cnpj" value="<?php recoverPost('cnpj');?>" required/>
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="fone" value="<?php recoverPost('fone');?>" required/>
        </div>

        <div class="form-group">
            <label>Logomarca</label>
            <input type="file" name="logo" required/>
        </div>

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="tb_site.concessionarias" />
            <input type="submit" name="acao" value="Cadastrar!"/>
        </div><!-- form-group -->
    </form>
</div><!-- box-content edit-user -->