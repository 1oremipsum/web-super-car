$(function(){
	$('body').on('submit','form',function(){
		var form = $(this);
		$.ajax({
			beforeSend:function(){
				$('.overlay-loading').fadeIn();
			},
			url:include_path+'ajax/formularios.php',
			method:'post',
			dataType: 'json',
			data:form.serialize()
		}).done(function(data){
			if(data.sucesso){
				$('.overlay-loading').fadeOut();
				$('.sucesso').slideToggle();
				setTimeout(function(){
					$('.sucesso').fadeOut();
				},3000)
			}else{
				$('.overlay-loading').fadeOut();
			}
		});
		return false;
	})
})