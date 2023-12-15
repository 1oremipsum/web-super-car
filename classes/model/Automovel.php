<?php 
    namespace model;

    class Automovel {

        private static $id;
        public static $combustiveis = [0 => 'Gasolina', 1 => 'Diesel', 2 => 'Flex'];
        public static $cambios = [0 => 'Automático', 1 => 'Manual'];

        public static function createConnection($column, $table, $query='', $fetchAll=false){
            if(!$fetchAll){
                $sql = \MySql::conectar()->prepare("SELECT $column FROM `$table` WHERE $query ");
                $sql->execute();
                $sql = $sql->fetch();
            }else if(!$fetchAll && $query == ''){
                $sql = \MySql::conectar()->prepare("SELECT $column FROM `$table`");
                $sql->execute();
                $sql = $sql->fetch();
            }else if($fetchAll && $query == ''){
                $sql = \MySql::conectar()->prepare("SELECT $column FROM `$table`");
                $sql->execute();
                $sql = $sql->fetchAll();
            }else {
                $sql = \MySql::conectar()->prepare("SELECT $column FROM `$table` WHERE $query ");
                $sql->execute();
                $sql = $sql->fetchAll();
            }
            return $sql;
        }

        public static function getAutomoveis(){
           return self::createConnection('*', 'tb_site.automoveis', ' vendido = 0 ORDER BY order_id ASC', true);
        }

        public static function getAutomovel($slug){
            $automovel = self::createConnection('*','tb_site.automoveis', "slug = '$slug'");
            self::$id = $automovel['id'];
            return $automovel;
        }

        public static function getImgsAutomovel(){
            $id = self::$id;
            return self::createConnection('*','tb_site.imagens_automoveis', "automovel_id = $id ORDER BY order_id ASC", true);
        }

        public static function getConcessionaria($idconcess){
            $concessionarias = self::createConnection('*', 'tb_site.concessionarias', '', true);
            foreach ($concessionarias as $key => $conc) {
                if($idconcess == $conc['id']){
                    return $conc;
                }
            }
        }

        public static function setCombustivel($combustivel){
            foreach (self::$combustiveis as $key => $value) {
                if($key == $combustivel)
                    return $value;
            }
        }

        public static function setCambio($cambio){
            foreach (self::$cambios as $key => $value) {
                if($key == $cambio)
                    return $value;
            }
        }

    }
    
?>