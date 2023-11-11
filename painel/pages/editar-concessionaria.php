<?php 
    verificaPermissao(2);
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $concess = Painel::select('tb_site.concessionarias','id = ?', array($id));
    }else{
        Painel::alert('erro','É preciso passar o parâmetro ID.');
        die();
    }
?>
<div class="box-content">
    <i class="fa-solid fa-building-flag"></i><h2> Editar Concessionária</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
            $data['sucesso'] = true;

            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $cnpj = $_POST['cnpj'];
                $cnpj_atual = $_POST['cnpj_atual'];
                $logo = $_FILES['logo'];
                $logo_atual = $_POST['logo_atual'];

                if($cnpj != $cnpj_atual){
                    $sql = MySql::conectar()->
                    prepare("SELECT id FROM `tb_site.concessionarias` WHERE cnpj = ?");
                    $sql->execute(array($cnpj));
                    if($sql->rowCount() != 0){
                        $data['sucesso'] = false;
                        Painel::alert('erro', 'Já existe uma concessionária com este CNPJ!');
                    }
                }

                if($data['sucesso'] == true){
                    if($logo['name'] != ''){
                        if(Painel::imagemValida($logo)){
                            Painel::deleteFile('uploads/concessionarias', $logo_atual);
                            $logo = Painel::updateFile($logo, 'uploads/concessionarias');
                            $arr = ['nome'=>$nome, 'cnpj'=>$cnpj, 'logo'=>$logo, 'id'=>$id, 'nome_tabela'=>'tb_site.concessionarias'];
                            Painel::update($arr);
                            $concess = Painel::select('tb_site.concessionarias', 'id = ?', array($id)); //update
                            Painel::alert('sucesso','Alteração realizada com sucesso!');   
                        }else{
                            Painel::alert('erro','Tipo de arquivo ou tamanho da imagem inválido.'); 
                        }
                    }else{
                        $logo = $logo_atual;
                        $arr = ['nome'=>$nome, 'cnpj'=>$cnpj, 'logo'=>$logo, 'id'=>$id, 
                        'nome_tabela'=>'tb_site.concessionarias'];
                        Painel::update($arr);
                        $concess = Painel::select('tb_site.concessionarias', 'id = ?', array($id)); //atualizando
                        Painel::alert('sucesso','Alteração realizada com sucesso!');
                    }
                }
            }
        ?>

        <div class="form-group">
            <label>Nome da Empresa</label>
            <input type="text" name="nome" value="<?php echo $concess['nome']; ?>">
        </div><!-- form-group -->

        <div class="form-group">
            <label>CNPJ</label>
            <input type="text" name="cnpj" value="<?php echo $concess['cnpj']; ?>">
            <input type="hidden" name="cnpj_atual" value="<?php echo $concess['cnpj']; ?>">
        </div><!-- form-group -->

        <div class="form-group">
            <label>Logomarca</label>
            <input type="file" name="logo" />
            <input type="hidden" name="logo_atual" value="<?php echo $concess['logo']; ?>">
        </div>

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nome_tabela" value="tb_site.concessionarias" />
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- form-group -->
    </form>