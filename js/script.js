$(function(){
    $('[name=preco_min],[name=preco_max]').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

    $('.filter-btn').click(function(){
        var search2 = $('section.search-2');

        if(search2.is(':hidden') == true){
            var icon = $('.filter-btn').find('i');
            icon.removeClass('fa-solid fa-list-check');
            icon.addClass('fa-solid fa-xmark');
            search2.slideToggle();
        }else{
            var icon = $('.filter-btn').find('i');
            icon.removeClass('fa-solid fa-xmark');
            icon.addClass('fa-solid fa-list-check');
            search2.slideToggle();
        }
    });

    $(":input").bind('keyup change input', function () {
		sendRequest();
	});

    function sendRequest() {
        $('form').ajaxSubmit({
            data:{'busca_modelo':$('input[name=busca]').val()},
            success:function(data){
                $('.list-automoveis').html(data);
            }
        });
    }
})