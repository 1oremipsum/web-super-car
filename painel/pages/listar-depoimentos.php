<?php 
    if(isset($_GET['excluir'])){
        $idExcluir = (int)$_GET['excluir'];
        Painel::deletar('tb_site.depoimentos', $idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-depoimentos');
    }elseif(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.depoimentos', $_GET['order'], $_GET['id']);
    }

    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 3; //resultados por pagina
    $depoimentos = Painel::selectAll('tb_site.depoimentos', ($paginaAtual - 1) * $porPagina, $porPagina);
    //1º parâmentro = tabela / 2º par = índice inicial da sql / 3º par = quantos resgistros eu quero
    //($paginaAtual - 1 = 0). 0 é o primeiro registro do banco.
?>
<div class="box-content">
    <h2><i class="fa-solid fa-comments"></i> Depoimentos Cadastrados</h2>
    <div class="wrapper-table">
        <?php 
            if(count($depoimentos) == 0){
                Painel::alert("erro", "Não há registros cadastrados!");
            }else{
        ?>
        <table>
            <tr>
                <td style="width:140px;"><i class="fa-regular fa-address-card"></i> Nome</td>
                <td style="width:420px;"><i class="fa-regular fa-comment-dots"></i> Depoimento</td>
                <td><i class="fa-regular fa-calendar-days"></i> Data</td>
                <td><i class="fa-regular fa-pen-to-square"></i></td>
                <td><i class="fa-regular fa-trash-can"></i> </td>
                <td><i class="fa-regular fa-circle-up"></i></td>
                <td><i class="fa-regular fa-circle-down"></i></td>
            </tr>
        <?php 
                foreach ($depoimentos as $key => $value) {
        ?>
            <tr class="body">
                <td><?php echo $value['nome']; ?></td>
                <td><?php echo $value['depoimento']; ?></td>
                <td><?php echo $value['data']; ?></td>
                <td><a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-depoimento?id=<?php echo $value['id']; ?>">Editar</a></td>
                <td><a actionBtn="delete" class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos?excluir=<?php echo $value['id']; ?>">Excluir</a></td>
                <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos?order=up&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-up"></i></a></td>
                <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos?order=down&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-down"></i></a></td>
            </tr>
        <?php 
                } 
            }
        ?>
        </table>
    </div><!-- wrapper-table -->
    <div class="paginacao">
        <?php 
            //ceil() = arredonda resultados
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.depoimentos')) / $porPagina);
            for($i=1; $i<=$totalPaginas; $i++){
                if($i == $paginaAtual){
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';
                }else
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';
            }
        ?>
    </div><!-- paginacao -->
</div><!-- box-content -->