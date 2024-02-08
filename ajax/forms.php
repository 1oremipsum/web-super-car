<?php 
    include('../includeConstants.php');
    $data['sucesso'] = true;
    $data['msg'] = '';

    if(isset($_GET['signup']) && $_GET['signup'] == 'signup-client'){
        sleep(2);

        $nome = $_GET['nome'];
        $email = $_GET['email'];
        $senha = $_GET['password'];
        $senha2 =  $_GET['confirmPassword'];
        $img = "";

        if($nome == ''){
            $data['sucesso'] = false;
            $data['msg'] = "O campo Nome não pode estar vázio";
        }

        if(strlen($nome) <= 2){
            $data['sucesso'] = false;
            $data['msg'] = "Seu nome está pequeno demais";
        }

        if(isset($_GET['email']) && $email != ''){
            if(\model\Cliente::emailExists($email)){
                $data['sucesso'] = false;
                $data['msg'] = "E-mail informado já está cadastrado";
            }
        }else{
            $data['sucesso'] = false;
            $data['msg'] = "O campo E-mail não pode estar vázio";
        }

        if(!str_contains($email, '@gmail.com')){
            $data['sucesso'] = false;
            $data['msg'] = "O formato de e-mail está incorreto";
        }

        if($senha == ''){
            $data['sucesso'] = false;
            $data['msg'] = "A senha não pode estar vázia!";
        }else if($senha !== $senha2){
            $data['sucesso'] = false;
            $data['msg'] = "As senhas digitadas não coincidem!";
        }

        if(strlen($senha) <= 4){
            $data['sucesso'] = false;
            $data['msg'] = "Senha muito fraca! tente novamente";
        }

        if($data['sucesso'] == true){
            \view\Login::signUp($nome, $email, $senha, $img);
            $data['msg'] = "Cadastrado realizado com sucesso!";
        }
    }else if(isset($_GET['signin']) && $_GET['signin'] == 'signin-empre'){
        sleep(1.5);
        
        $empregador = \view\Login::signInEmpre();
        if($empregador == ''){
            $data['sucesso'] = false;
            $data['msg'] = "Não existe uma conta empregador";
        }

        if($data['sucesso'] == true){
            $_SESSION['login'] = true;
            $_SESSION['nome'] = $empregador['nome'];
            $_SESSION['email'] = $empregador['email'];
            $_SESSION['senha'] = $empregador['senha'];
            $_SESSION['img'] = $empregador['img'];

            $data['msg'] = "Login realizado com sucesso!";
        }
    }else if(isset($_GET['signin']) && $_GET['signin'] == 'signin-client'){
        sleep(1.5);

        $email = $_GET['email'];
        $senha = $_GET['password'];
        
        $client = \view\Login::signIn($email, $senha);

        if($client == ''){
            $data['sucesso'] = false;
            $data['msg'] = "Email ou senha estão incorretos!";
        }else{
            $_SESSION['login'] = true;
            $_SESSION['nome'] = $client['nome'];
            $_SESSION['email'] = $client['email'];
            $_SESSION['senha'] = $client['senha'];
            $_SESSION['img'] = $client['img'];

            $data['msg'] = "Login realizado com sucesso!";

            if(isset($_GET['remember'])){
                setcookie('remember', true, time()+(60*60*24), '/');
                setcookie('email', $email,  time()+(60*60*24), '/');
                setcookie('password', $senha,  time()+(60*60*24), '/');
            }
        }
    }else if(isset($_GET['buy']) && $_GET['buy'] == 'buy-vehicle'){
        sleep(1.5);

        $versao = $_GET['vehicle'];
        $email = $_GET['client'];
    
        $vehicle = \view\Automovel::getAutomovelByVersao($versao);
        $client = \view\Cliente::getClienteByEmail($email);
    
        if(\model\Venda::SaleExists($vehicle['id'], $client['id'])){
            $checkSale = \model\Venda::getVendaByIdVehicleAndClient($vehicle['id'], $client['id']);
            $data['sucesso'] = false;
            if($checkSale['status_venda'] == 0){
                $data['msg'] = "Você já possui uma compra deste veículo em andamento!";
            }else if($checkSale['status_venda'] == 1){
                die("Este veículo está vendido.");
            }else if($checkSale['status_venda'] == 2){
                $data['msg'] = "Seu pedido de compra para este veículo foi cancelado!";
            }
        }else{
            $venda = new \model\Venda($vehicle['id'], $client['id'], date("Y-m-d"));
            if(($venda->getIdAutomovel() != '' && $venda->getIdCliente() != '') || 
            ($venda->getIdAutomovel() != null && $venda->getIdCliente() != null)){
                $venda->efetuarPedidoVenda();
                $data['msg'] = "Pedido de compra do veículo $vehicle[modelo] foi confirmado!";
            }else{
                die("Dados necessários não encontrados");
            }
        }
    }else if(isset($_GET['edit-profile']) && $_GET['edit-profile'] == 'basic-data'){
        sleep(1.5);

        $name = $_GET['nome'];
        $email = $_GET['email'];

        if($email == '' && $name == ''){
            $data['sucesso'] = false;
            $data['msg'] = "Campos Nome e E-mail estão vázios";
        }
        
        if($email != '' && $email !== $_SESSION['email']){
            if(\model\Cliente::emailExists($email)){
                $data['sucesso'] = false;
                $data['msg'] = "E-mail informado já está cadastrado";
            }
        }

        if($_GET['passw'] != ''){
            if($_GET['passw'] !== $_SESSION['senha']){
                $data['sucesso'] = false;
                $data['msg'] = "A senha informada está incorreta";
            }

            $client = \view\Cliente::getClienteByEmail($_SESSION['email']);
            $newClient = new model\Cliente();
            if($name != '' && $email != ''){
                if(!$newClient->updateNameAndEmail($name, $email, $client['id'])){
                    $data['sucesso'] = false;
                    $data['msg'] = "Não foi possível realizar as atualizações";
                }else{
                    $_SESSION['nome'] = $name;
                    $_SESSION['email'] = $email;
                }
            }else if($name != ''){
                if(!$newClient->updateName($name, $client['id'])){
                    $data['sucesso'] = false;
                    $data['msg'] = "Não foi possível realizar a atualização";
                }else{
                    $_SESSION['nome'] = $name;
                }
            }else if($email != ''){
                if(!$newClient->updateEmail($email, $client['id'])){
                    $data['sucesso'] = false;
                    $data['msg'] = "Não foi possível realizar a atualização";
                }else{
                    $_SESSION['email'] = $email;
                }
            }

            if($data['sucesso']){
                $data['msg'] = "Perfil atualizado com sucesso!";
            }
        }else{
            $data['sucesso'] = false;
            $data['msg'] = "A senha não pode estar vázia!";
        }
    }else if(isset($_POST['edit-profile']) && $_POST['edit-profile'] == 'edit-photo'){
        sleep(1.5);

        $currentPhoto = $_SESSION['img'];
        $photo = $_FILES['picture__input'];
        
        if(Painel::imagemValida($photo)){
            @unlink('../painel/uploads/clientes/'.$currentPhoto);            
            $client = \view\Cliente::getClienteByEmail($_SESSION['email']);

            $photo['name'] = "$photo[name]-$client[id]";
            move_uploaded_file($photo['tmp_name'], '../painel/uploads/clientes/'.$photo['name']);
            
            $newPhoto = new model\Cliente();
            if($newPhoto->updatePhoto($photo['name'], $client['id'])){
                $_SESSION['img'] = $photo['name'];
                $data['msg'] = "Imagem atualizada com sucesso!";
            }else{
                $data['sucesso'] = false;
                $data['msg'] = "Erro ao atualizar a foto";
            }
        }else{
            $data['sucesso'] = false;
            $data['msg'] = "Tamanho ou tipo de imagem inválido";
        }
    }else if(isset($_GET['edit-profile']) && $_GET['edit-profile'] == 'edit-passw'){
        sleep(1.5);
        $newPass = $_GET['new-passw'];
        $cnfPass = $_GET['cnf-passw'];
        $currentPass = $_GET['current-passw'];

        if($newPass == '' && $cnfPass == '' && $currentPass == ''){
            $data['sucesso'] = false;
            $data['msg'] = "Campos vázios não são permitidos";
        }else{
            if($newPass !== $cnfPass){
                $data['sucesso'] = false;
                $data['msg'] = "As novas senhas não coincidem";
            }else{
                $client = \view\Cliente::getClienteByEmail($_SESSION['email']);
                if($currentPass !== $client['senha']){
                    $data['sucesso'] = false;
                    $data['msg'] = "A senha atual está incorreta";
                }else{
                    $newP = new \model\Cliente();
                    if($newP->updatePassword($newPass, $client['id'])){
                        $_SESSION['senha'] = $newPass;
                        $data['msg'] = "Senha atualizada com sucesso!";
                    }
                }
            }
        }
    }
    die(json_encode($data));
?>