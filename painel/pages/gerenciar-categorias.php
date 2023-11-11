<?php 
    verificaPermissao(2);
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        Painel::deletar('tb_site.categorias', $idExcluir);
        $noticias = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE categoria_id = ?");
        $noticias->execute(array($idExcluir));
        $noticias = $noticias->fetchAll();
        foreach ($noticias as $key => $value) {
            $imgDelete = $value['capa'];
            Painel::deleteFile('uploads/noticias', $imgDelete);
        }
        $noticias = MySql::conectar()->prepare("DELETE FROM `tb_site.noticias` WHERE categoria_id = ?");
        $noticias->execute(array($idExcluir));
        Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-categorias');
    }elseif(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.categorias', $_GET['order'], $_GET['id']);
    }

    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 3; //resultados por pagina
    $categorias = Painel::selectAll('tb_site.categorias', ($paginaAtual - 1) * $porPagina, $porPagina);
    //1º parâmentro = tabela / 2º par = índice inicial da sql / 3º par = quantos resgistros eu quero
    //($paginaAtual - 1 = 0). 0 é o primeiro registro do banco.
?>
<div class="box-content">
    <h2><i class="fa-solid fa-tags"></i> Categorias Cadastradas</h2>
    <div class="wrapper-table">
        <?php 
            if(count($categorias) == 0){
                Painel::alert("erro", "Não há categorias cadastradas!");
            }else{
        ?>
        <table>
            <tr>
                <td><i class="fa-solid fa-tag"></i> Categoria</td>
                <td><i class="fa-regular fa-pen-to-square"></i> Editar</td>
                <td><i class="fa-regular fa-trash-can"></i> Excluir</td>
                <td><i class="fa-regular fa-circle-up"></i></td>
                <td><i class="fa-regular fa-circle-down"></i></td>
            </tr>
        <?php foreach($categorias as $key => $value){?>
            <tr class="body">
                <td>
                    <?php echo $value['nome']; ?>
                </td>
                <td>
                    <a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-categoria?id=<?php echo $value['id']; ?>">Editar</a>
                </td>
                <td>
                    <a actionBtn="delete" class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?excluir=<?php echo $value['id']; ?>">Excluir</a>
                </td>
                <td>
                    <a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?order=up&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-up"></i></a>
                </td>
                <td>
                    <a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?order=down&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-down"></i></a>
                </td>
            </tr>
            <?php }} ?>
        </table>
    </div><!-- wrapper-table -->
    <div class="paginacao">
        <?php 
            //ceil() = arredondar resultados
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.categorias')) / $porPagina);
            for($i=1; $i<=$totalPaginas; $i++){
                if($i == $paginaAtual){
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'gerenciar-categorias?pagina='.$i.'">'.$i.'</a>';
                }else{
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'gerenciar-categorias?pagina='.$i.'">'.$i.'</a>';
                }
            }
        ?>
    </div><!-- paginacao -->
</div><!-- box-content -->