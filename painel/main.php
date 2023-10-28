<?php
if(isset($_GET['loggout'])){
    Painel::loggout();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css" rel="stylesheet" />
    <link href="<?php echo INCLUDE_PATH; ?>fontawesome/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>super.ico" type="image/x-ico" />
    <title>Painel de Controle</title>
</head>
<body>
<div class="menu">
    <div class="menu-wraper">
        <div class="box-usuario">
            <?php 
                if($_SESSION['img'] == ''){ ?>
                <div class="avatar-usuario">
                    <i class="fa fa-user"></i>
                </div><!-- avatar-usuario -->
            <?php 
                }else{ ?>
                <div class="imagem-usuario">
                    <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>">
                </div><!-- avatar-usuario -->
            <?php } ?>
            <div class="nome-usuario">
                <p><?php echo $_SESSION['nome']; ?></p>
                <p><?php echo getCargo($_SESSION['cargo']); ?></p>
            </div><!-- nome-usuario -->
        </div><!-- box-usuario -->
        <div class="items-menu">
            <?php if($_SESSION['cargo'] >= 1){ ?>
                <h2>Cadastro</h2>
                <a <?php selecionadoMenu('cadastrar-depoimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimento">
                Cadastrar Depoimento</a>
                <a <?php selecionadoMenu('cadastrar-servico'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-servico">Cadastrar Serviço</a>
                <a <?php selecionadoMenu('cadastrar-slide'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-slide">Cadastrar Slide</a>

                <h2>Gestão</h2>
                <a <?php selecionadoMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos">Listar Depoimentos</a>
                <a <?php selecionadoMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos">Listar Serviços</a>
                <a <?php selecionadoMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides">Listar Slides</a>

                <h2>Administração do painel</h2>
                <a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuario">Editar Usuário</a>
                <a <?php selecionadoMenu('adicionar-usuario'); ?> <?php verificaPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuario">Adicionar Usuário</a>

                <h2>Configuração Geral</h2>
                <a <?php selecionadoMenu('editar-site'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-site">Editar Site</a>

                <h2>Gestão de Clientes</h2>
                <a <?php selecionadoMenu('cadastrar-cliente'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-cliente">Cadastrar Cliente</a>
                <a <?php selecionadoMenu('listar-clientes'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-clientes">Listar Clientes</a>
                
                <h2>Gestão de Notícias</h2>
                <a <?php selecionadoMenu('cadastrar-categoria'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-categoria">Cadastrar Categoria</a>
                <a <?php selecionadoMenu('gerenciar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-categorias">Gerenciar Categorias</a>
                <a <?php selecionadoMenu('cadastrar-noticia'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-noticia">Cadastrar Notícia</a>
                <a <?php selecionadoMenu('gerenciar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-noticias">Gerenciar Notícias</a>
            <?php }else { ?>
                    <h2>Informações do Usuário</h2>
                    <a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuario">Editar Usuário</a>
            <?php } ?>    
    
        </div><!-- items-menu-->
    </div><!-- menu-wraper -->
</div><!-- menu -->
    <header>
        <div class="center">
            <div class="menu-btn">
                <i class="fa-solid fa-bars"></i>
            </div><!-- menu-btn -->
            <div class="loggout">
                <a <?php if(@$_GET['url'] == ''){ ?> style="background: #0c0c33; padding: 15px" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>"> <i class="fa fa-home"></i><span> Home</span></a>
                <div style="padding:0 20px; display:inline"></div>
                <a href="<?php echo INCLUDE_PATH_PAINEL; ?>?loggout"><i class="fa-solid fa-right-from-bracket"></i><span> Sair</span></a>
            </div><!-- loggout -->
            <div class="clear"></div>
        </div><!-- center -->
    </header>
    <div class="content">
        <?php Painel::LoadPage() ?>
    </div><!-- content -->

    <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.ajaxform.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({ 
            selector:'.tinymce',
            plugins: "image",
            height: 300
        });
    </script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/ajax.js"></script>
    <?php Painel::loadJS(array('clientes.js'), 'listar-clientes'); ?>
</body>
</html>