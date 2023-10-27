$(function(){
    $('.ajax').ajaxForm({
        dataType: 'json',
        beforeSend: function(){
            $('.ajax').animate({'opacity':'0.7'});
            $('.ajax').find('input[type=submit]').attr('disabled', 'true');
        },
        success: function(data){
            $('.ajax').animate({'opacity':'1'});
            $('.ajax').find('input[type=submit]').removeAttr('disabled');
            if(data.sucesso){
                $('.ajax').prepend('<div class="box-alert sucesso"><i class="fa-solid fa-circle-check"></i> Cliente cadastrado com sucesso!</div>');
                $('.ajax')[0].reset();
            }else {
                $('.ajax').prepend('<div class="box-alert erro"><i class="fa-solid fa-circle-xmark"></i> Ocorreram os seguintes erros: <b>'+data.msg+'</b></div>');
            }
            console.log(data);
        }
    })
})