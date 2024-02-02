<?php 
    namespace view;

    class Automovel{
    
        private static $combustivel;
        private static $cambio;
        private static $imgs = [];

        public static function getAll(){
            return \model\Automovel::getAll();
        }

        public static function getAutomoveis(){
            return \model\Automovel::getAutomoveis();
        }

        public static function getAutomoveisVendidos(){
            return \model\Automovel::getAutomoveisVendidos();
        }

        public static function getConcessionaria($id){
            return \model\Automovel::getConcessionaria($id);
        }

        public static function getAutomovelByVersao($versao){
            return \model\Automovel::getAutomovelByVersao($versao);
        }

        public static function getAutomovelById($id){
            return \model\Automovel::getAutomovelById($id);
        }

        public static function getFirstImg($id){
            return \model\Automovel::getFirstImgAutomovel($id);
        }

        public static function getCombustivel($combustivel){
            return self::$combustivel = \model\Automovel::getCombustivel($combustivel);
        }

        public static function getCambio($cambio){
            return self::$cambio = \model\Automovel::getCambio($cambio);
        }

        public static function getImgs(){
            return self::$imgs = \model\Automovel::getImgsAutomovel();
        }
    }
    
?>