<?php 
    namespace view;

    class Venda {
        public static function getAll(){
             return \model\Venda::getAll();
        }

        public static function cancelarPedidoById($id){
            \model\Venda::cancelarPedidoVenda($id);
        }   

        public static function removerPedidoById($id){
            \model\Venda::removeById($id);
        }

        public static function getVendasConcluidas($idClient){
            return \model\Venda::getVendasConcluidas($idClient);
        }
    }
    
?>