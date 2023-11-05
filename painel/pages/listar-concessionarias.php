<?php 
    verificaPermissao(2);
    if(isset($_GET['excluir'])){
        $idExcluir = (int)$_GET['excluir'];
        Painel::deletar('tb_site.concessionarias', $idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-concessionarias');
    }elseif(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.concessionarias', $_GET['order'], $_GET['id']);
    }

    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 3; //resultados por pagina
    $concess = Painel::selectAll('tb_site.concessionarias', ($paginaAtual - 1) * $porPagina, $porPagina);
    //1º parâmentro = tabela / 2º par = índice inicial da sql / 3º par = quantos resgistros eu quero
    //($paginaAtual - 1 = 0). 0 é o primeiro registro do banco.
?>
<div class="box-content">
    <i class="fa-solid fa-building-circle-check"></i><h2> Concessionárias Cadastradas</h2>
    <div class="wrapper-table">
        <?php 
            if(count($concess) == 0){
                Painel::alert("erro", "Não há registros cadastrados!");
            }else{
        ?>
        <table>
            <tr>
                <td><i class="fa-solid fa-building-flag"></i></i> Nome</td>
                <td><i class="fa-solid fa-building-circle-exclamation"></i> CNPJ</td>
                <td><i class="fa-regular fa-pen-to-square"></i> Editar</td>
                <td><i class="fa-regular fa-trash-can"></i> Excluir</td>
                <td><i class="fa-regular fa-circle-up"></i></td>
                <td><i class="fa-regular fa-circle-down"></i></td>
            </tr>
        <?php 
                foreach ($concess as $key => $value) {
        ?>
            <tr class="body">
                <td><?php echo $value['nome']; ?></td>
                <td><?php echo $value['cnpj']; ?></td>

                <td><a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-concessionaria?id=<?php echo $value['id']; ?>">Editar</a></td>

                <td><a actionBtn="delete" class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-concessionarias?excluir=<?php echo $value['id']; ?>">Excluir</a></td>

                <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-concessionarias?order=up&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-up"></i></a></td>

                <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-concessionarias?order=down&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-down"></i></a></td>
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
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.concessionarias')) / $porPagina);
            for($i=1; $i<=$totalPaginas; $i++){
                if($i == $paginaAtual){
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-concessionarias?pagina='.$i.'">'.$i.'</a>';
                }else
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-concessionarias?pagina='.$i.'">'.$i.'</a>';
            }
        ?>
    </div><!-- paginacao -->
</div><!-- box-content -->