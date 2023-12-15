<?php 
    namespace controller;

    class HomeController{

        public function index(){
            \view\MainView::setParameter(['veiculos'=>\model\HomeModel::getAutomoveis()]);
            \view\MainView::render('home.php');
        }
    }
?>