<?php 
    verificaPermissao(2);
?>
<div class="box-content">
    <i class="fa-solid fa-user-plus"></i><h2> Adicionar Usuário</h2>

    <form method="post" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
                $login = $_POST['login'];
                $nome = $_POST['nome'];
                $senha = $_POST['password'];
                $imagem = $_FILES['imagem'];
                $cargo = $_POST['cargo'];

                if($login == ''){
                    Painel::alert('erro','O login não pode estar vazio!');
                }else if($nome == ''){
                    Painel::alert('erro','O nome não pode estar vazio!');
                }else if($senha == ''){
                    Painel::alert('erro','A senha não pode estar vazia!');
                }else if($cargo == ''){
                    Painel::alert('erro','Selecione um cargo!');
             /* }else if($imagem['name'] == ''){
                    Painel::alert('erro','Selecione uma imagem!');
                } */
                }else{
                    if($cargo >= $_SESSION['cargo']){
                        Painel::alert('erro','Selecione um cargo menor que o seu!');
                    }else if($imagem['name'] != '' && Painel::imagemValida($imagem) == false){
                        Painel::alert('erro','O formato especificado não é válido!');
                    }else if(Usuario::userExists($login)){
                        Painel::alert('erro','Dados de usuário já existentes!');
                    }else{
                        $usuario = new Usuario();
                        $imagem = Painel::updateFile($imagem);
                        $usuario = Usuario::cadastrarUsuario($login, $senha, $imagem, $nome, $cargo);
                        Painel::alert('sucesso','Cadastro do usuário '.$login.' realizado com sucesso!');
                    }
                }
            }
        ?>

        <div class="form-group">
            <label>Login</label>
            <input type="text" name="login">
        </div><!-- form-group -->

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome">
        </div><!-- form-group -->

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password">
        </div><!-- form-group -->

        <div class="form-group">
            <label>Cargo</label>
           <select name="cargo">
                <?php 
                    foreach (Painel::$cargos as $key => $value) {
                       if($key < $_SESSION['cargo']) echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                ?>
           </select>
        </div><!-- form-group -->

        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="imagem"/>
        </div><!-- form-group -->

        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- form-group -->

    </form>
</div><!-- box-content edit-user -->