<?php 
    namespace model;

    class Automovel {

        private static $id;
        public static $combustiveis = [0 => 'Gasolina', 1 => 'Diesel', 2 => 'Flex'];
        public static $cambios = [0 => 'Automático', 1 => 'Manual'];

        private static function createConnection($column, $table, $query='', $fetchAll=false){
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

        public static function getAll(){
            return self::createConnection('*', 'tb_site.automoveis', '', true);
        }

        public static function getAutomoveis(){
           return self::createConnection('*', 'tb_site.automoveis', ' vendido = 0 ORDER BY preco DESC', true);
        }

        public static function getAutomoveisVendidos(){
            return self::createConnection('*', 'tb_site.automoveis', ' vendido = 1', true);
         }

        public static function getAutomovel($slug){
            $automovel = self::createConnection('*','tb_site.automoveis', "slug = '$slug'");
            @self::$id = $automovel['id'];
            return $automovel;
        }

        public static function getAutomovelById($id){
            $automovel = self::createConnection('*', 'tb_site.automoveis', "id = '$id'");
            return $automovel;
        }

        public static function getAutomovelByVersao($versao){
            $automovel = self::createConnection('*', 'tb_site.automoveis', "versao = '$versao'");
            return $automovel;
        }

        public static function getImgsAutomovel(){
            $id = self::$id;
            return self::createConnection('*','tb_site.imagens_automoveis', "automovel_id = $id ORDER BY order_id ASC", true);
        }

        public static function getFirstImgAutomovel($id){
            return self::createConnection('*','tb_site.imagens_automoveis', "automovel_id = $id ORDER BY order_id ASC LIMIT 1");
        }

        public static function getConcessionaria($idconcess){
            $concessionarias = self::createConnection('*', 'tb_site.concessionarias', '', true);
            foreach ($concessionarias as $key => $conc) {
                if($idconcess == $conc['id']){
                    return $conc;
                }
            }
        }

        public static function getCombustivel($combustivel){
            foreach (self::$combustiveis as $key => $value) {
                if($key == $combustivel)
                    return $value;
            }
        }

        public static function getCambio($cambio){
            foreach (self::$cambios as $key => $value) {
                if($key == $cambio)
                    return $value;
            }
        }

    }
    
?>