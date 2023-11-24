$(function(){
    var open = true;
    var windowSize = $(window)[0].innerWidth;
    var targetSizeMenu = (windowSize <= 400) ? 200 : 250;

    if(windowSize <= 768){
        $('.menu').css('width','0').css('padding','0');
        open = false;
    }

    $('.menu-btn').click(function(){
        if(open){
            $('.menu').animate({'width':0,'padding':0}, function(){
                open = false;
            });
            $('.content,header').css('width','100%'); 
            $('.content,header').animate({'left':0}, function(){
                open = false;
            });
        }else{
			//menu fechado
			$('.menu').css('display','block');
			$('.menu').animate({'width':targetSizeMenu+'px','padding':'10px 0'},function(){
				open = true;
            });
            $('.content,header').css('width','calc(100% - 250px)');
            $('.content,header').animate({'left':targetSizeMenu+'px'},function(){
                open = true;
			});
		}
    })

    $(window).resize(function(){
        windownSize <= $(windown)[0].innerWidth;
        targetSizeMenu = (windownSize <= 400) ? 200 : 250;
        if(windownSize <= 768){
            $('.menu').css('width','0').css('padding','0');
            $('.content,header').css('width','100%').css('left','0');
            open = false;
        }else{
            $('.menu').animate({'widht':targetSizeMenu+"px",'padding':'10px 0'}, function(){
                opent = true;
            });

            $('.content,header').css('widht','calc(100% - 250px)');
            $('.content,header').animate({'left':targetSizeMenu+'px'},function(){
                open = true;
            });
        }
    })

    $('[actionBtn=delete]').click(function(){
        var txt;
        var r = confirm("Deseja excluir este registro?");
        if(r == true){
            return true;
        }else{
            return false;
        }
    })

    $('table.marca-btn').click(function(){
        
    })
})