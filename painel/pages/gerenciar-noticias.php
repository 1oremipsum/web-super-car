<?php 
    verificaPermissao(2);
    if(isset($_GET['excluir'])){
        $idExcluir = (int)$_GET['excluir'];
        $selectCapa = MySql::conectar()->prepare("SELECT capa FROM `tb_site.noticias` WHERE id = ?");
        $selectCapa->execute(array($_GET['excluir']));

        $imagem = $selectCapa->fetch()['capa'];
        Painel::deleteFile('uploads/noticias',$imagem);

        Painel::deletar('tb_site.noticias', $idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-noticias');
    }elseif(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.noticias', $_GET['order'], $_GET['id']);
    }

    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 3; //resultados por pagina
    $noticia = Painel::selectAll('tb_site.noticias', null,($paginaAtual - 1) * $porPagina, $porPagina);
    //1º parâmentro = tabela / 2º par = índice inicial da sql / 3º par = quantos resgistros eu quero
    //($paginaAtual - 1 = 0). 0 é o primeiro registro do banco.
?>
<div class="box-content">
    <h2><i class="fa-solid fa-newspaper"></i> Notícias Cadastrados</h2>
    <div class="wrapper-table">
        <?php 
            if(count($noticia) == 0){
                Painel::alert("erro", "Não há notícias cadastradas!");
            }else{
        ?>
        <table>
            <tr>
                <td><i class="fa-solid fa-signature"></i> Título</td>
                <td><i class="fa-solid fa-tags"></i> Categoria</td>
                <td><i class="fa-regular fa-image"></i> Capa</td>
                <td><i class="fa-regular fa-pen-to-square"></i> Editar</td>
                <td><i class="fa-regular fa-trash-can"></i> Excluir</td>
                <td><i class="fa-regular fa-circle-up"></i></td>
                <td><i class="fa-regular fa-circle-down"></i></td>
            </tr>
            <?php 
                foreach ($noticia as $key => $value) {
                    $nomeCategoria = Painel::select('tb_site.categorias', 'id=?', array($value['categoria_id']))['nome'];
            ?>
            <tr class="body">
                <td><?php echo $value['titulo']; ?></td>
                <td><?php echo $nomeCategoria; ?></td>
                <td><img style="width: 120px;height: 80px;border:1px solid white" 
                src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/noticias/<?php echo $value['capa']; ?>"></td>
                <td><a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-noticia?id=<?php echo $value['id']; ?>">Editar</a></td>
                <td><a actionBtn="delete" class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticias?excluir=<?php echo $value['id']; ?>">Excluir</a></td>
                <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticias?order=up&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-up"></i></a></td>
                <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticias?order=down&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-angle-down"></i></a></td>
            </tr>
            <?php }} ?>
        </table>
    </div><!-- wrapper-table -->
    <div class="paginacao">
        <?php 
            //ceil() = arredonda resultados
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.noticias')) / $porPagina);
            for($i=1; $i<=$totalPaginas; $i++){
                if($i == $paginaAtual){
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'gerenciar-noticias?pagina='.$i.'">'.$i.'</a>';
                }else
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'gerenciar-noticias?pagina='.$i.'">'.$i.'</a>';
            }
        ?>
    </div><!-- paginacao -->
</div><!-- box-content -->