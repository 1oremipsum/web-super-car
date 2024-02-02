<?php 
    namespace controller;

    class LoginController{
        
        public function index(){
            \view\MainView::render('login.php');
        }
    }
?>