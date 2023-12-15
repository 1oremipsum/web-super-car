<?php 
    namespace controller;

    class AutomovelController {

        public function index($par){
            \view\MainView::setParameter(\model\Automovel::getAutomovel($par[2]));
            \view\Automovel::getImgs();
            \view\MainView::render('automovel.php');
        }
    }
    
?>