$(function(){
    $( ".boxes" ).sortable({
        start: function(){
            var element = $(this);
            element.find('.box-single-wraper > div:nth-of-type(1)').css('border', '1px solid #FFFAFA');
        },
        update:function(){
            var data = $(this).sortable('serialize'); //get id element
            var element = $(this);
            data += '&tipo_acao=ordenar_concessionaria';
            element.find('.box-single-wraper > div:nth-of-type(1)').css('border', '1px solid #555555');
            $.ajax({
                url: include_path+'ajax/forms.php',
                method:'post',
                data: data
            }).done(function(data){
                console.log(data);
            })
        },
        stop: function(){
            var element = $(this);
            element.find('.box-single-wraper > div:nth-of-type(1)').css('border','1px solid #555555');
        }
    });
})