<?php 
    namespace controller;

    class CompraController{
        public function index(){
            \view\MainView::render('gerenciar-compras.php');
        }
    }
    

?>