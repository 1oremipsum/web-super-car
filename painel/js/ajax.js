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
            $('.box-alert').remove();
            if(data.sucesso){
                $('.ajax').prepend('<div class="box-alert sucesso"><i class="fa-solid fa-circle-check"></i> '+data.msg+'</div>');
                if($('.ajax').hasAttr('atualizar') == false){
                    $('.ajax')[0].reset();
                }
            }else {
                $('.ajax').prepend('<div class="box-alert erro"><i class="fa-solid fa-circle-xmark"></i> Ocorreram os seguintes erros: <b>' + data.msg + '</b></div>');
            }
        }
    })

    $('.btn-delete').click(function(e){
        e.preventDefault();
        var item_id = $(this).attr('item_id');
        var removed = $(this).parent().parent().parent().parent();
        $.ajax({
            url:include_path+'/ajax/forms.php',
            data:{id:item_id,tipo_acao:'excluir_cliente'},
            method:'post'
        }).done(function(){
            removed.fadeOut();
        })
    })
})