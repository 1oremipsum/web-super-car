<?php 
    namespace controller;

    class ClienteController{
        public function index(){
            \view\MainView::render('editar-perfil.php');
        }
    }
?>