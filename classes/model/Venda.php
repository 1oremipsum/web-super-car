<?php 
    namespace model;

    use MySql;

    class Venda {
        private $idAutomovel;
        private $idCliente;
        private $dataPedido;
        private $dataVenda;

        public function __construct($idAutomovel, $idCliente, $dataPedido) {
           $this->idAutomovel = $idAutomovel;
           $this->idCliente = $idCliente;
           $this->dataPedido = $dataPedido;
        }

        public function efetuarPedidoVenda(){
            $sql = \MySql::conectar()->prepare("INSERT INTO `tb_site.vendas` VALUES(null,?,?,?,null,?)");
            $sql->execute(array($this->idAutomovel,$this->idCliente,$this->dataPedido,0));
        }

        public function removerPedidoVenda($id){
            \MySql::conectar()->exec("DELETE FROM `tb_site.vendas` WHERE id = $id");
        }

        public function confirmarVenda(){
            $sql = \MySql::conectar()->prepare("UPDATE `tb_site.vendas` SET data_venda = ?, status_venda = ? WHERE id_automovel = ? AND id_cliente = ?");
            $this->setDataVenda(date("Y-m-d"));

            $sql->execute(array($this->getDataVenda(),1,$this->idAutomovel,$this->idCliente));
            self::venderAutomovel();
        }

        public function efetuarVenda(){
            $sql = \MySql::conectar()->prepare("INSERT `tb_site.vendas` VALUES(null,?,?,?,?,?)");
            $sql->execute(array($this->idAutomovel, $this->idCliente, $this->dataPedido, $this->dataVenda, 1));
            self::venderAutomovel();
        }

        public static function cancelarPedidoVenda($id){
            $sql = \MySql::conectar()->prepare("UPDATE `tb_site.vendas` SET status_venda = ? WHERE id = ?");
            $sql->execute(array(2,$id));
            $venda = self::getVendaById($id);
            $automovel = \model\Automovel::getAutomovelById($venda['id_automovel']);
            if($automovel['vendido'] != 0){
                self::removerVendaAutomovel($automovel['id']);
            }
        }

        public static function removeById($id){
            \MySql::conectar()->exec("DELETE FROM `tb_site.vendas` WHERE id = $id");
        }
        
        public static function getAll(){
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.vendas`");
            $sql->execute();
            $sql = $sql->fetchAll();
            return $sql;
        }

        public static function getVendasConcluidas($idClient){
            $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_site.vendas` WHERE `status_venda` = 1 AND id_cliente = $idClient");
            $sql->execute();
            return count($sql->fetchAll());
        }

        public static function getVendaById($id){
            $venda = \MySql::conectar()->prepare("SELECT * FROM `tb_site.vendas` WHERE id = $id");
            $venda->execute(); 
            return $venda->fetch();
        }

        public static function getVendaByIdVehicleAndClient($idVehicle, $idClient){
            $venda = \MySql::conectar()->prepare("SELECT * FROM `tb_site.vendas` WHERE `id_automovel` = ? AND `id_cliente` = ?");
            $venda->execute(array($idVehicle, $idClient));
            return $venda->fetch();
        }   

        public static function SaleExists($idVehicle, $idClient){
            $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_site.vendas` WHERE `id_automovel` = ? AND `id_cliente` = ?");
            $sql->execute(array($idVehicle, $idClient));
            if($sql->rowCount() == 1){
                return true;
            }else{
                return false;
            }
        }

        private static function removerVendaAutomovel($id){
            $sql = \MySql::conectar()->prepare("UPDATE `tb_site.automoveis` SET vendido = 0 WHERE id = $id");
            $sql->execute();
        }

        private function venderAutomovel(){
            $sql = \MySql::conectar()->prepare("UPDATE `tb_site.automoveis` SET vendido = ? WHERE id = ?");
            $sql->execute(array(1,$this->idAutomovel));
        }

        public function getIdAutomovel(){
            return $this->idAutomovel;
        }
        public function getIdCliente(){
            return $this->idCliente;
        }
        public function getDataPedido(){
            return $this->dataPedido;
        }
        public function getDataVenda(){
            return $this->dataVenda;
        }
        public function setDataVenda($dateFormat){
            $this->dataVenda = $dateFormat;
        }
    }
    
?>