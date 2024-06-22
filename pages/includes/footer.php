    <footer>
		<div class="center">
			<p><b>ATENÇÃO:</b> este site é uma mera <b>demonstração</b>, não possuindo <b>fins lucrativos</b>.</p>
		</div>
	</footer>

	<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	
	<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/jquery.maskMoney.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/script.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/menu.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/form-profile.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/carousel.js"></script>
	<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.ajaxform.js"></script>
	<?php 
		@$url = explode('/', $_GET['url'])[1];
		Painel::loadJS(array('ajax.js'), $url);	
		Painel::loadJS(array('ajax.js'), 'login');
		Painel::loadJS(array('ajax.js'), 'editar-perfil'); 
		Painel::loadJS(array('ajax.js'), 'automoveis');
	?>
	
</body>
</html>