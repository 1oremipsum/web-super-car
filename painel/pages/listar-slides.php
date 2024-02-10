<?php 
    verificaPermissao(1);
    if(isset($_GET['deletar']) && verificaPermissao(2, "delete")){
        $id = (int)$_GET['deletar'];
        $slide = MySql::conectar()->prepare("SELECT `slide` FROM `tb_site.slides` WHERE id = $id");
        $slide->execute();
        $slide = $slide->fetch();
        @unlink(BASE_DIR_PAINEL.'/uploads/slides/'.$slide['slide']);

        MySql::conectar()->exec("DELETE FROM `tb_site.slides` WHERE id = $id");
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-slides');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.slides', $_GET['order'], $_GET['id']);
    }

    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 3; //resultados por pagina
    $slide = Painel::selectAll('tb_site.slides', null, ($paginaAtual - 1) * $porPagina, $porPagina);
    //1º parâmentro = tabela / 2º par = índice inicial da sql / 3º par = quantos resgistros eu quero
    //($paginaAtual - 1 = 0). 0 é o primeiro registro do banco.
?>
<div class="box-content">
    <h2><i class="fa-solid fa-images"></i></i> Slides Cadastrados</h2>
    <div class="wrapper-table">
        <?php 
            if(count($slide) == 0){
                Painel::alert("erro", "Não há registros cadastrados!");
            }else{
        ?> 
        <table>
            <tr>
                <td><i class="fa-solid fa-signature"></i> Nome</td>
                <td><i class="fa-regular fa-image"></i> Imagem</td>
                <td><i class="fa-regular fa-pen-to-square"></i> Editar</td>
                <td><i class="fa-regular fa-trash-can"></i> Excluir</td>
                <td><i class="fa-regular fa-circle-up"></i></td>
                <td><i class="fa-regular fa-circle-down"></i></td>
            </tr>
            <?php 
                foreach ($slide as $key => $value) {
            ?>
            <tr class="body">
                <td><?php echo $value['nome']; ?></td>
                <td><img style="width: 120px;height: 80px;border:1px solid white" 
                src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/slides/<?php echo $value['slide']; ?>"></td>
                <td><a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-slide?id=<?php echo $value['id']; ?>"><i class="fa-regular fa-pen-to-square"></i> Editar</a></td>
                <td><a class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides?deletar=<?php echo $value['id']; ?>"><i class="fa-solid fa-trash-can"></i> Excluir</a></td>
                <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides?order=up&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-up"></i></a></td>
                <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides?order=down&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-down"></i></a></td>
            </tr>
            <?php }} ?>
        </table>
    </div><!-- wrapper-table -->
    <div class="paginacao">
        <?php 
            //ceil() = arredonda resultados
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.slides')) / $porPagina);
            for($i=1; $i<=$totalPaginas; $i++){
                if($i == $paginaAtual){
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
                }else
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
            }
        ?>
    </div><!-- paginacao -->
</div><!-- box-content -->