<?php 
    sleep(1.5);

    include('../../includeConstants.php');
    $data['sucesso'] = true;
    $data['msg']= "";

    /* code here */
    if(Painel::logado() == false){
        die("You're not allowed to do that.");
    }

    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if(isset($_POST['email'])){
        $sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.clientes` WHERE email = ?");
        $sql->execute(array($email));
            if($sql->rowCount() != 0){
                $data['sucesso'] = false;
                $data['msg'] = " E-mail já cadastrado.";
            }
    }

    $senha = $_POST['password'];
    $img = "";

    if(isset($_FILES['img'])){
        if(Painel::imagemValida($_FILES['img'])){
            $img = $_FILES['img'];
        }else{
            $img = "";
            $data['sucesso'] = false;
            $data['msg'] = " Arquivo ou tamanho da imagem inválido.";
        }
    }

    if($data['sucesso']){
        if(is_array($img))
            $img = Painel::uploadFile($img);
        $sql = MySql::conectar()->prepare("INSERT INTO `tb_site.clientes` VALUES (null,?,?,?,?)");
        $sql->execute(array($nome, $email, $senha, $img));
    }

    die(json_encode($data));
?>