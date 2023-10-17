$(function(){
   
    var currentSlide = 0;
    var maxSlide = $('.banner-single').length - 1;
    var delay = 5; 

    initSlider();
    changeSlide();

    function initSlider(){
       $('.banner-single').hide(); 
       $('.banner-single').eq(0).show();
        for(var i = 0; i < maxSlide+1; i++){
            var content = $('.bullets').html();
            if(i == 0){
                content += '<span class="active_slider"></span>';
            }else{
                content += '<span></span>'
            }
            $('.bullets').html(content);
        }
    }

    function changeSlide(){
        setInterval(function(){
            $('.banner-single').eq(currentSlide).stop().fadeOut(2000);
            currentSlide++;
            if(currentSlide > maxSlide){
                currentSlide = 0;
            }
            $('.banner-single').eq(currentSlide).stop().fadeIn(2000);
            //trocar bullets naveg. slaider
            $('.bullets span').removeClass('active_slider');
            $('.bullets span').eq(currentSlide).addClass('active_slider');
        },delay * 1000);
    }

    $('body').on('click','.bullets span',function(){
        var currentBullet = $(this);
        $('.banner-single').eq(currentSlide).stop().fadeOut(1000);
        currentSlide = currentBullet.index();
        $('.banner-single').eq(currentSlide).stop().fadeIn(1000);
        $('.bullets span').removeClass('active_slider');
        currentBullet.addClass('active_slider');
    });

})