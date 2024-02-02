<?php 
    namespace view;

    class Alert{
        public static function showMsg(String $type, String $msg){
            if($type == 'success'){
                echo 
                '<div class="alert success">
                    <i class="fa-solid fa-circle-check"></i><span>'.$msg.'</span>
                    <div class="close-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>';
            }else if($type == 'error'){
                echo 
                '<div class="alert error">
                    <i class="fa-solid fa-circle-exclamation"></i><span>'.$msg.'</span>                  
                    <div class="close-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>';
            }
        }
    }
?>