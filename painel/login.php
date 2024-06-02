<?php 
    if(isset($_COOKIE['lembrar'])){
        $user = $_COOKIE['user'];
        $password = $_COOKIE['password'];
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
        $sql->execute(array($user, $password));
        if($sql->rowCount() == 1) {
            $info = $sql->fetch();
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['cargo'] = $info['cargo'];
            $_SESSION['nome'] = $info['nome'];
            $_SESSION['img'] = $info['img']; 
            Painel::redirect(INCLUDE_PATH_PAINEL);
        }
    }
?>
<!DOCTYPE html>
<html>
<head lang="pt-BR">
    <title>Painel de controle</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH; ?>fontawesome/css/all.min.css" rel="stylesheet" />
    <link href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css" rel="stylesheet" />
</head>
<body>

    <div class="logo">
        <img src="<?php echo INCLUDE_PATH; ?>imagens/super_300x180.png" />
    </div>

    <div class="box-login">
        <?php
        if (isset($_POST['acao'])) {
            $user = $_POST['user'];
            $password = $_POST['password'];
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
            $sql->execute(array($user, $password));
            if ($sql->rowCount() == 1) {
                $info = $sql->fetch();
                $_SESSION['login'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                $_SESSION['cargo'] = $info['cargo'];
                $_SESSION['nome'] = $info['nome'];
                $_SESSION['img'] = $info['img'];
                if(@$_POST['lembrar']){
                    setcookie('lembrar', true, time()+(60*60*24), '/');
                    setcookie('user', $user,  time()+(60*60*24), '/');
                    setcookie('password', $password,  time()+(60*60*24), '/');
                }
                Painel::redirect(INCLUDE_PATH_PAINEL);
            } else {
                echo '<div class="box-erro"><i class="fa-solid fa-xmark"></i> Usuário ou senha incorretos!</div>';
            }
        }
        ?>
        <h2>Efetue o Login</h2>
        <form method="post">
            <input type="text" name="user" placeholder="Login" required >
            <input type="password" name="password" placeholder="Senha" required >
            <div class="form-group-login">
                <input type="submit" name="acao" value="Logar!">
            </div><!-- form-group-login -->
            <div class="form-group-login right">
                <label>Lembrar-me</label>
                <input type="checkbox" name="lembrar" />
            </div><!-- form-group-login -->
            <div class="clear"></div>
        </form>
    </div>
</body>
</html>