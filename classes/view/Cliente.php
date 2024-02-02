<?php 
    namespace view;

    class Cliente {
        public static function getAll(){
            return \model\Cliente::getAll();
        }

        public static function getClienteByEmail($email){
            return \model\Cliente::getClienteByEmail($email);
        }

        public static function getAllshopping($idClient){
            return \model\Cliente::getAllShopping($idClient);
        }

        public static function getInProcess($idClient){
            return \model\Cliente::getInProcess($idClient);
        }

        public static function getTotalAcquisitions($acquisitions){
            $total = 0;
            foreach($acquisitions as $key => $value){
                if($value['status_venda'] != 2){
                    $vehicle = \model\Automovel::getAutomovelById($value['id_automovel']);
                    $total += $vehicle['preco'];
                }
            }
            return $total;
        }   
    }
    
?>