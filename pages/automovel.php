<?php
    $automovel = \view\MainView::$par;
    $imagens = \view\Automovel::getImgs();
    $concessionaria = \view\Automovel::getConcessionaria($automovel['id_concessionaria']);
?>
<section class="img-carousel-area owl-carousel">
    <?php 
        foreach ($imagens as $key => $value) {
    ?>
    <div class="img-wrapper">
        <div class="img-single">
            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/automoveis/<?php echo $value['imagem']; ?>">
        </div>
    </div>
    <?php } ?>
</section>

<section class="box-content">
    <h2>Informações Técnicas do Automóvel</h2>
    <div class="wrapper-table">
        <div class="table-responsive">
            <div class="row">
                <div class="col">
                    <span>MARCA: <b><?php echo $automovel['marca'];?></b></span>
                </div><!-- col -->
                <div class="col">
                    <span>MODELO: <b><?php echo $automovel['modelo'];?></b></span>
                </div><!-- col -->
                <div class="clear"></div>
            </div><!-- row -->

            <div class="row">
                <div class="col">
                    <?php if(mb_strlen($automovel['versao']) <= 40){?>
                    <span>VERSÃO: <b><?php echo $automovel['versao'];?></b></span>
                    <?php }else{?>
                    <span>VERSÃO:<span style="font-size: 9.5px;"><b> <?php echo $automovel['versao'];?></b></span></span>
                    <?php }?>
                </div><!-- col -->
                <div class="col">
                    <span>QUILOMETRAGEM: <b><?php echo Painel::convertKm($automovel['quilometragem']);?></b></span>
                </div><!-- col -->
                <div class="clear"></div>
            </div><!-- row -->

            <div class="row">
                <div class="col">
                    <span>ANO FAB: <b><?php echo $automovel['ano_fab'];?></b></span>
                </div><!-- col -->
                <div class="col">
                    <span>ANO MOD: <b><?php echo $automovel['ano_mod'];?></b></span>
                </div><!-- col -->
                <div class="clear"></div>
            </div><!-- row -->

            <div class="row">
                <div class="col">
                    <span>COMBUSTÍVEL: 
                        <b><?php echo \view\Automovel::getCombustivel($automovel['combustivel']); ?></b>
                    </span>
                </div><!-- col -->
                <div class="col">
                    <span>CÂMBIO: 
                        <b><?php echo \view\Automovel::getCambio($automovel['combustivel']); ?></b>
                    </span>
                </div><!-- col -->
                <div class="clear"></div>
            </div><!-- row -->

            <div class="row">
                <div class="col">
                    <span>COR: <b><?php echo $automovel['cor']; ?></b></span>
                </div>
                <div class="col">
                    <span>CONCESSIONÁRIA: <b><?php echo $concessionaria['nome']; ?></b></span>
                </div><!-- col -->
                <div class="clear"></div>
            </div><!-- row -->
        </div><!-- table-responsive -->
    </div><!-- wrapper-table -->

    <div class="wrapper-table right">
        <div class="range">
            <div class="price-area">
                <h3>POR APENAS</h3>
                <p>R$ <?php echo Painel::convertMoney($automovel['preco']);?></p>
            </div><!-- price-area -->
        </div><!-- range -->
        <?php if(\view\Login::logado()){?>
            <div class="range">
                <form id="form-buy-vehicle" class="ajax" action="<?php echo INCLUDE_PATH?>ajax/forms.php" method="get">
                    <input type="hidden" name="vehicle" value="<?php echo $automovel['versao']; ?>">
                    <input type="hidden" name="client" value="<?php echo $_SESSION['email']; ?>">
                    <button type="submit" name="buy" value="buy-vehicle">Estou interessado!</button>
                </form>
            </div><!-- range -->
        <?php }else{ ?>
            <div class="range">
            <div class="dialog">Está interessado(a)? 
                <a href="http://localhost/websupercar/login">Cadastre-se</a> ou realize 
                <a href="http://localhost/websupercar/login">Login</a> para proceder com a compra!</div>
            </div><!-- range -->
        <?php } ?>
    </div><!-- wrapper-table right -->
</section><!-- box-content -->