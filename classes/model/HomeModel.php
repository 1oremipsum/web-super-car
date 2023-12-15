<?php 
    namespace model;

    class HomeModel {
        public static function getAutomoveis(){
            $automoveis = \MySql::conectar()->prepare("SELECT * FROM `tb_site.automoveis` WHERE vendido = 0 ORDER BY order_id LIMIT 8");
            $automoveis->execute();
            return $automoveis->fetchAll();
        }
    }
?>