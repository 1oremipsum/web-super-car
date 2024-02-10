<?php 
    namespace view;

    class Login{
        public static function logado(){
            return isset($_SESSION['login']) ? true : false;
        }

        public static function loggout(){
            setcookie('lembrar', 'true', time()-1, '/'); // destruir cookie
            session_destroy();
            header('Location: ' . INCLUDE_PATH . 'login');
        }

        public static function signUp($name,$email, $password, $image){
            $cliente = new \model\Cliente();
            $cliente->clientSignUp($name, $email, $password, $image);
        }

        public static function signIn($email, $password){
            $cliente = new \model\Cliente();
            return $cliente->clientSignIn($email, $password);
        }

        public static function signInEmpre(){
            $empregador = new \model\Cliente();
            return $empregador->EmpregSignIn();
        }

    }
?>