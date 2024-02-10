<?php 
    namespace model;

    class Cliente {
        private String $name;
        private String $email;
        private String $password;
        private String $image;

        public function clientSignUp($name, $email, $password, $image){
            $sql = \MySql::conectar()->prepare("INSERT INTO `tb_site.clientes` VALUES (null,?,?,?,?)");
            $sql->execute(array($name, $email, $password, $image));
        }

        public function clientSignIn($email, $password){
            $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_site.clientes` WHERE email = ? AND senha = ?");
            $sql->execute(array($email, $password));
            if($sql->rowCount() == 1){
                $sql = $sql->fetch();
            }else{
                $sql = '';
            }
            return $sql;
        }

        public function EmpregSignIn(){
            $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_site.clientes` WHERE nome = 'Recrutador' AND senha = 'recanoni321'");
            $sql->execute();
            return $sql->fetch();
        }

        public function getClientByParams($nome, $email){
            $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_site.clientes` WHERE nome = '$nome' AND email = '$email'");
            $sql->execute();
            return $sql->fetch();
        }

        public function updateNameAndEmail($name, $email, $id){
            $sql = \MySql::conectar()->prepare("UPDATE `tb_site.clientes` SET nome = ?, email = ? WHERE id = ?");
            if($sql->execute(array($name, $email, $id))){
                return true;
            }
            return false;
        }

        public function updateName($name, $id){
            $sql = \MySql::conectar()->prepare("UPDATE `tb_site.clientes` SET nome = ? WHERE id = ?");
            if($sql->execute(array($name, $id))){
                return true;
            }
            return false;
        }

        public function updateEmail($email, $id){
            $sql = \MySql::conectar()->prepare("UPDATE `tb_site.clientes` SET email = ? WHERE id = ?");
            if($sql->execute(array($email, $id))){
                return true;
            }
            return false;
        }

        public function updatePassword($passw, $id){
            $sql = \MySql::conectar()->prepare("UPDATE `tb_site.clientes` SET senha = ? WHERE id = ?");
            if($sql->execute(array($passw, $id))){
                return true;
            }
            return false;
        }

        public function updatePhoto($photo, $id){
            $sql = \MySql::conectar()->prepare("UPDATE `tb_site.clientes` SET img = ? WHERE id = ?");
            if($sql->execute(array($photo, $id))){
                return true;
            }
            return false;
        }

        public static function emailExists($email){
            $sql = \MySql::conectar()->prepare("SELECT `id` FROM `tb_site.clientes` WHERE email = ?");
            $sql->execute(array($email));
            if($sql->rowCount() == 1){
                return true;
            }
            return false;
        }

        public static function getAll(){
            $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_site.clientes`");
            $sql->execute();
            $sql = $sql->fetchAll();
            return $sql;
        }

        public static function getClienteByEmail($email){
            $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_site.clientes` WHERE `email` = '$email'");
            $sql->execute();
            return $sql->fetch();
        }
    
        public static function getClienteById($id){
            $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_site.clientes` WHERE `id` = '$id'");
            $sql->execute();
            return $sql->fetch();
        }

        public static function getAllShopping($idClient){
            $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_site.vendas` WHERE `id_cliente` = $idClient");
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function getInProcess($idClient){
            $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_site.vendas` WHERE `status_venda` = 0 AND `id_cliente` = $idClient LIMIT 1");
            $sql->execute(); 
            if(count($sql->fetchAll()) > 0){
                return true;
            }
            return false;
        }

        public function getName(){
            return $this::$name;
        }
        public function setName($name){
            return $this::$name = $name;
        }
        public function getEmail(){
            return $this::$email;
        }
        public function setEmail($email){
            return $this::$name = $email;
        }
        public function getPassword(){
            return $this::$password;
        }
        public function getImage(){
            return $this::$image;
        }
    } 
?>