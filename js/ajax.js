$(function(){ 
    $('#sign-in').ajaxForm({
        type: 'GET',
        dataType: 'json',
        beforeSend: function(){
            $('.ajax').animate({'opacity':'0.6'});
            $('.ajax').find('button[type=submit]').attr('disabled', 'true');
        },
        success: function(data){
            $('.ajax').animate({'opacity':'1'});
            $('.ajax').find('button[type=submit]').removeAttr('disabled');
            if(data.sucesso){
                $('#sign-in')[0].reset();
                loginSuccess(data.msg);
                redirect('automoveis');
            }else{
                loginError(data.msg);
            } 
        }
    })

    $('#form-empre').ajaxForm({
        type: 'GET',
        dataType: 'json',
        beforeSend: function(){
            $('.ajax').animate({'opacity':'0.6'});
            $('.ajax').find('button[type=submit]').attr('disabled', 'true');
        },
        success: function(data){
            $('.ajax').animate({'opacity':'1'});
            $('.ajax').find('button[type=submit]').removeAttr('disabled');
            if(data.sucesso){
                loginSuccess(data.msg);
                redirect('automoveis');
            }else{
                loginError(data.msg);
            } 
        }
    })

    $('#sign-up').ajaxForm({
        type: 'GET',
        dataType: 'json',
        beforeSend: function(){
            $('.ajax').animate({'opacity':'0.6'});
            $('.ajax').find('button[type=submit]').attr('disabled', 'true');
        },
        success: function(data){
            $('.ajax').animate({'opacity':'1'});
            $('.ajax').find('button[type=submit]').removeAttr('disabled');
            if(data.sucesso){
                $('#sign-in')[0].reset();
                loginSuccess(data.msg);
            }else{
                loginError(data.msg);
            } 
        }
    })

    $('#form-buy-vehicle').ajaxForm({
        type: 'GET',
        dataType: 'json',
        beforeSend: function(){
            $('.ajax').animate({'opacity':'0.6'});
            $('.ajax').find('button[type=submit]').attr('disabled', 'true');
        },
        success: function(data){
            $('.ajax').animate({'opacity':'1'});
            $('.ajax').find('button[type=submit]').removeAttr('disabled');
            if(data.sucesso){
                buySuccess(data.msg);
                activeNotification();
            }else{
                buyError(data.msg);
            } 
        }
    })

    $('#form-basic-data').ajaxForm({
        type: 'GET',
        dataType: 'json',
        beforeSend: function(){
            $('.ajax').animate({'opacity':'0.6'});
            $('.ajax').find('button[type=submit]').attr('disabled', 'true');
        },
        success: function(data){
            $('.ajax').animate({'opacity':'1'});
            $('.ajax').find('button[type=submit]').removeAttr('disabled');
            if(data.sucesso){
                loginSuccess(data.msg);
                redirect('editar-perfil');
            }else{
                loginError(data.msg);
            } 
        }
    })

    $('#form-edit-photo').ajaxForm({
        type: 'POST',
        dataType: 'json',
        beforeSend: function(){
            $('.ajax').animate({'opacity':'0.6'});
            $('.ajax').find('button[type=submit]').attr('disabled', 'true');
        },
        success: function(data){
            $('.ajax').animate({'opacity':'1'});
            $('.ajax').find('button[type=submit]').removeAttr('disabled');
            if(data.sucesso){
                loginSuccess(data.msg);
                redirect('editar-perfil');
            }else{
                loginError(data.msg);
            } 
        }
    })

    $('#form-edit-passw').ajaxForm({
        type: 'GET',
        dataType: 'json',
        beforeSend: function(){
            $('.ajax').animate({'opacity':'0.6'});
            $('.ajax').find('button[type=submit]').attr('disabled', 'true');
        },
        success: function(data){
            $('.ajax').animate({'opacity':'1'});
            $('.ajax').find('button[type=submit]').removeAttr('disabled');
            if(data.sucesso){
                loginSuccess(data.msg);
                redirect('editar-perfil');
            }else{
                loginError(data.msg);
            } 
        }
    })

    function redirect(page) {
        setTimeout(() => {
            window.location.replace(page);
        }, 3000);
    }

    function activeNotification(){
        $('.notification').fadeIn();
        $('.my-acquisitions').click(function(){
            $('.notification').fadeOut();
        });
    }
    
    function clearMsg(element){
        $(element).empty();
    }

    function loginSuccess(data){
        clearMsg('.ajax-msg');
        $('.ajax-msg').prepend(
        '<div class="alert success">'+
            '<i class="fa-solid fa-circle-check"></i><span>'+data+'</span>'+
            '<div class="close-btn">'+
                '<i class="fa-solid fa-xmark"></i>'+
            '</div>'+
        '</div>');
        $('.alert.success').fadeIn();
        setTimeout(() => {
            $('.alert').fadeOut();
        }, 3000);
        $('.close-btn').click(function(){
            $('.alert').fadeOut();
        });
    }

    function loginError(data) {
        clearMsg('.ajax-msg');
        $('.ajax-msg').prepend(
        '<div class="alert error">'+
            '<i class="fa-solid fa-circle-exclamation"></i><span>'+data+'</span>'+                  
            '<div class="close-btn">'+
                '<i class="fa-solid fa-xmark"></i>'+
            '</div>'+
        '</div>');
        $('.alert.error').fadeIn();
        setTimeout(() => {
            $('.alert').fadeOut();
        }, 3000);
        $('.close-btn').click(function(){
            $('.alert').fadeOut();
        });
    } 

    function buySuccess(data){
        clearMsg('.ajax-msg');
        $('.ajax-msg').prepend(
        '<div class="buy-alert success">'+
            '<i class="fa-solid fa-circle-check"></i><span>'+data+'</span>'+
            '<div class="close-btn">'+
                '<i class="fa-solid fa-xmark"></i>'+
            '</div>'+
        '</div>');
        $('.buy-alert.success').fadeIn();
        setTimeout(() => {
            $('.buy-alert.success').fadeOut();
        }, 4000);
        $('.close-btn').click(function(){
            $('.buy-alert.success').fadeOut();
        });
    }

    function buyError(data) {
        clearMsg('.ajax-msg');
        $('.ajax-msg').prepend(
        '<div class="buy-alert error">'+
            '<i class="fa-solid fa-circle-exclamation"></i><span>'+data+'</span>'+                  
            '<div class="close-btn">'+
                '<i class="fa-solid fa-xmark"></i>'+
            '</div>'+
        '</div>');
        $('.buy-alert.error').fadeIn();
        setTimeout(() => {
            $('.buy-alert.error').fadeOut();
        }, 4000);
        $('.close-btn').click(function(){
            $('.buy-alert.error').fadeOut();
        });
    }
})
