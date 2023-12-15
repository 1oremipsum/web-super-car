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
                    <span>VERSÃO: <b><?php echo $automovel['versao'];?></b></span>
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
</section>