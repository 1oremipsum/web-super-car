<?php 
    if(!\view\Login::logado())
        die("Realize login para ter acesso a página.");
    
?>
<section class="area-edit-profile">
    <div class="menu-profile mobile">
        <?php if($_SESSION['img'] == ''){ ?>
        <div class="user-area">
            <div class="avatar-usuario">
                <i class="fa fa-user"></i>
            </div>
        </div>
        <?php }else{ ?>
        <div class="user-area">
            <div class="imagem-usuario">
                <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/clientes/<?php echo $_SESSION['img']; ?>">
            </div><!-- imagem-usuario -->
        </div>      
        <?php }?>
        <div class="name-user">
            <h3><?php echo $_SESSION['nome'];?></h3>
        </div>
        <div class="items-menu">
            <div class="selected"></div>
            <div class="item 1">Perfil</div>
            <div class="item 2">Foto de perfil</div>
            <div class="item 3">Mudar senha</div>
        </div>
    </div><!-- menu-profile mobile -->

    <div class="container-edit-profile">
        <div class="header-profile">
            <h1>Editar Perfil</h1>
            <h2>Atualize ou edite suas informações</h2>
        </div><!-- header-profile -->
        <div class="menu-profile">
            <?php if($_SESSION['img'] == ''){ ?>
            <div class="avatar-usuario">
                <i class="fa fa-user"></i>
            </div>
            <?php }else{ ?>
            <div class="imagem-usuario">
                <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/clientes/<?php echo $_SESSION['img']; ?>">
            </div><!-- imagem-usuario -->
            <?php }?>
            <div class="name-user">
                <h3><?php echo $_SESSION['nome'];?></h3>
            </div>
            <div class="items-menu">
                <div class="selected"></div>
                <div class="item 1">Perfil</div>
                <div class="item 2">Foto de perfil</div>
                <div class="item 3">Mudar senha</div>
            </div>
        </div><!-- menu-profile -->
        <div class="info-profile">

            <form id="form-basic-data" class="ajax" action="<?php echo INCLUDE_PATH?>ajax/forms.php" method="get">
                <h4>Dados básicos</h4>
                <div class="form-profile">
                    <input type="text" name="nome" value="<?php echo $_SESSION['nome']?>" placeholder="Mudar nome" />
                </div>
                <div class="form-profile">
                    <input type="text" name="email" value="<?php echo $_SESSION['email']?>" placeholder="Mudar e-mail"/>
                </div>
                <div class="form-profile">
                    <input type="password" name="passw" placeholder="Confirmar senha" />
                </div>
                <button type="submit" name="edit-profile" value="basic-data">Salvar!</button>
            </form><!-- form-basic-data -->

            <form id="form-edit-photo" class="ajax" action="<?php echo INCLUDE_PATH?>ajax/forms.php" method="post" enctype="multipart/form-data">
                <h4>Selecione uma foto de perfil</h4>
                <div class="form-profile">
                    <label class="picture" for="picture__input">
                        <span class="picture__image"></span>
                    </label>
                    <input type="file" name="picture__input" id="picture__input" required/>
                </div>
                <button type="submit" name="edit-profile" value="edit-photo">Salvar!</button>
            </form><!-- form-edit-photo -->

            <form id="form-edit-passw" class="ajax" action="<?php echo INCLUDE_PATH?>ajax/forms.php" method="get">
                <h4>Mude sua senha</h4>
                <div class="form-profile">
                    <input type="password" name="new-passw" placeholder="Nova senha" />
                </div>
                <div class="form-profile">
                    <input type="password" name="cnf-passw" placeholder="Confirmar nova senha" /> 
                    <!-- cnf: confirm-->
                </div>
                <div class="form-profile">
                    <input type="password" name="current-passw" placeholder="Senha atual" />
                </div>
                <button type="submit" name="edit-profile" value="edit-passw">Salvar!</button>
            </form><!-- form-edit-passw -->

        </div><!-- info-profile -->
    </div><!-- container-edit-profile -->
</section>