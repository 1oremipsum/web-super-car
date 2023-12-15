<?php 
    namespace view;

    class Automovel{
    
        private static $combustivel;
        private static $cambio;
        private static $imgs = [];

        public static function getAutomoveis(){
            return \model\Automovel::getAutomoveis();
        }

        public static function getConcessionaria($id){
            return \model\Automovel::getConcessionaria($id);
        }

        public static function getCombustivel($combustivel){
            return self::$combustivel = \model\Automovel::setCombustivel($combustivel);
        }

        public static function getCambio($cambio){
            return self::$cambio = \model\Automovel::setCambio($cambio);
        }

        public static function getImgs(){
            return self::$imgs = \model\Automovel::getImgsAutomovel();
        }
    }
    
?>