<?php 
    verificaPermissao(2);
?>
<div class="box-content">
    <i class="fa-solid fa-building-flag"></i><h2> Cadastrar Concessionária</h2>
    <?php 
        if(isset($_POST['acao'])){
            $nome = $_POST['nome']; 
            $cnpj = $_POST['cnpj'];  
            $logo = $_FILES['logo']; 

            if($nome != '' || $cnpj != '' || $logo != ''){
                $sql = MySql::conectar()->prepare("SELECT id from `tb_site.concessionarias` WHERE cnpj = ?");
                $sql->execute(array($cnpj));
                if($sql->rowCount() == 0){
                    if($logo['name'] != '' && !Painel::imagemValida($logo)){
                        Painel::alert('erro','O formato especificado ou tamanho da imagem não é válido.');
                    }else{
                        $logo = Painel::updateFile($logo, 'uploads/concessionarias');
                        $arr = ['nome'=>$nome, 'cnpj'=>$cnpj, 'logo'=>$logo, 'order_id'=>'0', 'nome_tabela'=>'tb_site.concessionarias'];
                            Painel::insert($arr);
                            Painel::alert('sucesso','A concessionária '.$nome.' foi cadastrada com sucesso!');
                    }
                }else{
                    Painel::alert('erro', 'Concessionária '.$nome.' já cadastrada!');
                }
            }else{
                Painel::alert('erro', 'Campos vázios não são permitidos!');
            }
        }
    ?>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nome da Empresa</label>
            <input type="text" name="nome" required/>
        </div><!-- form-group -->

        <div class="form-group">
            <label>CNPJ</label>
            <input type="text" name="cnpj" required/>
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