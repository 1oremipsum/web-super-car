<?php 
    namespace view;

    class MainView{

        public static $par = [];

        public static function render($fileName){
            $header = 'pages/includes/header.php';
            $footer = 'pages/includes/footer.php';
            include($header);
            include('pages/'.$fileName);
            include($footer);
            die();
        }

        public static function setParameter($par){
            self::$par = $par;
         }
    }
?>