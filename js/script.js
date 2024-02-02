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

// animation: sign in and sign up 
var formSignIn = document.querySelector('#sign-in');
var formEmpre = document.querySelector('#form-empre');
var formSignUp = document.querySelector('#sign-up');
var btnColor = document.querySelector('.btn-color');

document.querySelector('#btn-sign-in').addEventListener('click', () =>{
    formSignIn.style.left = '25px';
    formEmpre.style.left = '0px';
    formSignUp.style.left = '450px';
    btnColor.style.left = '0px';
});

document.querySelector('#btn-sign-up').addEventListener('click', () =>{
    formSignIn.style.left = '-450px';
    formEmpre.style.left = '-450px';
    formSignUp.style.left = '25px';
    btnColor.style.left = '110px';
});