$(function(){
    
    var current = -1; 
    var maximum = $('.box-qualidade').length;
    var delay = 1;
    var timer;

    execAnimation();
    function execAnimation(){
        $('.box-qualidade').hide();
        timer = setInterval(animation, delay * 1000);

        function animation(){
            current++;
            if(current > maximum){
                clearInterval(timer);
                return false;
            }
            $('.box-qualidade').eq(current).fadeIn();
        }
    }
})