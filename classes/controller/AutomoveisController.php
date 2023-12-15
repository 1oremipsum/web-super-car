<?php  
    namespace controller;

    class AutomoveisController {

        public function index(){
            \view\Automovel::getAutomoveis(\model\Automovel::getAutomoveis());
            \view\MainView::render('automoveis.php');
        }
    }
?>