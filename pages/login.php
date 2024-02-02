<section class="container">
    <div class="signin-signup">
        
        <div class="buttons-form">
            <div class="btn-color"></div>
                <button id="btn-sign-in">Logar</button>
                <button id="btn-sign-up">Cadastrar</button>
        </div><!-- buttons-form -->

        <form id="sign-in" class="ajax" action="<?php echo INCLUDE_PATH?>ajax/forms.php" method="get">
            <input type="text" name="email" placeholder="E-mail" required />
            <i class="fa-solid fa-envelope"></i>

            <input type="password" name="password" placeholder="Senha" required />
            <i class="fa-solid fa-lock"></i>

            <div class="check">
                <input type="checkbox" name="remember" />
                <span>Lembrar-me</span>
            </div><!-- check -->

            <button type="submit" name="signin" value="signin-client">Logar</button>
        </form><!-- sign-in -->

        <form id="form-empre" class="ajax" action="<?php echo INCLUDE_PATH?>ajax/forms.php" method="get">
            <h1 style="font-weight: lighter;">Ou</h1>
            <button type="submit" name="signin" value="signin-empre">Estou Recrutando</button>
        </form><!-- form-empre -->

        <form id="sign-up" class="ajax" action="<?php echo INCLUDE_PATH?>ajax/forms.php" method="get">
            <input type="text" name="nome" placeholder="Nome" required />
            <i class="fa-solid fa-user"></i>

            <input type="text" name="email" placeholder="E-mail" required />
            <i class="fa-solid fa-envelope"></i>

            <input type="password" name="password" placeholder="Senha" required />
            <i class="fa-solid fa-lock"></i>

            <input type="password" name="confirmPassword" placeholder="Confirmar senha" required />
            <i class="fa-solid fa-lock"></i>

            <button type="submit" name="signup" value="signup-client">Registrar</button>
        </form><!-- sign-up -->

    </div><!-- signin-signup -->
</section><!-- container -->