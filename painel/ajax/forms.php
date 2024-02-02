<?php
    include('../../includeConstants.php');
    $data['sucesso'] = true;
    $data['msg']= "";

    if(Painel::logado() == false){
        die("You're not allowed to do that.");
    }

    /* code below */

    function orderId($ids, $table){
        $i = 1;
        foreach ($ids as $key => $value) {
            MySql::conectar()->exec("UPDATE `$table` SET order_id = $i WHERE id = $value");
            $i++;
        }
    }
    
    if(isset($_GET['signup']) && $_GET['signup'] == 'signup-client'){
        sleep(1.5);
        $nome = $_GET['nome'];
        $email = $_GET['email'];
        $senha = $_GET['password'];
        $senha2 =  $_GET['confirmPassword'];
        $img = "";

        if($nome == ''){
            $data['sucesso'] = false;
            $data['msg'] = "O campo Nome não pode estar vázio.";
        }

        if(isset($_GET['email']) && $email != ''){
            $sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.clientes` WHERE email = ?");
            $sql->execute(array($email));
                if($sql->rowCount() != 0){
                    $data['sucesso'] = false;
                    $data['msg'] = "E-mail já cadastrado.";
                }
        }else{
            $data['sucesso'] = false;
            $data['msg'] = "O E-mail é obrigatório.";
        }

        if($senha == ''){
            $data['sucesso'] = false;
            $data['msg'] = "Senha está vazia!";
        }else if($senha !== $senha2){
            $data['sucesso'] = false;
            $data['msg'] = "As senhas digitadas não coincidem!";
        }

        if(isset($_FILES['img'])){
            if(Painel::imagemValida($_FILES['img'])){
                $img = $_FILES['img'];
            }else{
                $img = "";
                $data['sucesso'] = false;
                $data['msg'] = "Arquivo ou tamanho da imagem inválido.";
            }
        }

        if($data['sucesso'] == true){
            if(is_array($img))
                $img = Painel::uploadFile($img, 'uploads/clientes');
            \view\Login::signUp($nome, $email, $senha, $img);
            $data['msg'] = "Cadastrado realizado com sucesso!";
        }

    }else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'editar_cliente'){
        sleep(1.5);
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['password'];
        $img = $_POST['imagem_original']; // current img

        if($nome == '' || $email == '' || $senha == ''){
            $data['sucesso'] = false;
            $data['msg'] = "Campos vázios não são permitidos!";
        }

        if(isset($_FILES['img'])){
            if(Painel::imagemValida($_FILES['img'])){
                @unlink('../uploads/clientes/'.$img);
                $img = $_FILES['img'];
            }else{
                $data['sucesso'] = false;
                $data['msg'] = "Tipo do arquivo ou tamanho da imagem inválido.";
            }
        }

        if($data['sucesso']){
            if(is_array($img)){
                $img = Painel::uploadFile($img, 'uploads/clientes');
            }
            $sql = MySql::conectar()->prepare("UPDATE `tb_site.clientes` SET nome = ?, email = ?, senha = ?, img = ? WHERE id = $id");
            $sql->execute(array($nome, $email, $senha, $img));
            
            $data['msg'] = "O cliente foi atualizado com sucesso!";
        }

    }else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'excluir_cliente'){
        $id = $_POST['id'];
        $sql = MySql::conectar()->prepare("SELECT img FROM `tb_site.clientes` WHERE id = $id");
        $sql->execute();
        $img = $sql->fetch()['img'];
        @unlink('../uploads/clientes/'.$img);

        MySql::conectar()->exec("DELETE FROM `tb_site.clientes` WHERE id = $id");    

    }else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'ordenar_concessionaria'){
        $ids = $_POST['item'];
        orderId($ids, 'tb_site.concessionarias');

    }else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'ordenar_automovel-imgs'){
        $ids = $_POST['item'];
        orderId($ids, 'tb_site.imagens_automoveis');
    }
    
    die(json_encode($data));
?>