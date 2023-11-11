<div class="box-content">
    <i class="fa-solid fa-pen"></i><h2> Editar Usuário</h2>

    <form method="post" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $senha = $_POST['password'];
                $imagem = $_FILES['imagem'];
                $imagem_atual = $_POST['imagem_atual'];
                $usuario = new Usuario();

                if($imagem['name'] != ''){
                    //Existe o upload de imagem.
                    if(Painel::imagemValida($imagem)){
                        Painel::deleteFile('uploads/user',$imagem_atual);
                        $imagem = Painel::updateFile($imagem, 'uploads/user');
                        if($usuario->atualizarUsuario($nome, $senha, $imagem)){
                            $_SESSION['img'] = $imagem;
                            Painel::alert('sucesso','Alteração realizada com sucesso!');
                        }else{
                            Painel::alert('erro','Erro ao tentar atualizar o usuário.');
                        }
                    }else{
                        Painel::alert('erro','Formato de imagem inválido.');
                    }
                }else{
                    $imagem = $imagem_atual;
                    if($usuario->atualizarUsuario($nome, $senha, $imagem)){
                        Painel::alert('sucesso','Alteração realizada com sucesso!');
                    }else{
                        Painel::alert('erro','Erro ao tentar atualizar o usuário.');
                    }
                }
            }
        ?>

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" required value="<?php echo $_SESSION['nome']; ?>" >
        </div><!-- form-group -->
        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password" value="<?php echo $_SESSION['password']; ?>" required>
        </div><!-- form-group -->
        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="imagem"/>
            <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']; ?>">
        </div><!-- form-group -->
        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar!">
        </div><!-- form-group -->
    </form>
</div><!-- box-content edit-user -->