<?php 
    verificaPermissao(1);
?>
<div class="box-content">
    <i class="fa-solid fa-user-plus"></i><h2> Cadastrar Clientes</h2>

    <form class="ajax" action="<?php INCLUDE_PATH_PAINEL ?>ajax/forms.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" />
        </div><!-- form-group -->

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" />
        </div><!-- form-group -->

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password" />
        </div><!-- form-group -->

        <div class="form-group">
            <label>Confirmar Senha</label>
            <input type="password" name="confirmPassword" />
        </div><!-- form-group -->

        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="img"/>
        </div><!-- form-group -->

        <div class="form-group">
            <input type="hidden" name="signup" value="signup-client" />
        </div>

        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!"/>
        </div><!-- form-group -->
    </form>
</div><!-- box-content -->