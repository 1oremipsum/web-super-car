$('nav.mobile').click(function () {
    var listMenu = $('nav.mobile ul');

    if (listMenu.is(':hidden') == true) {
        var icon = $('.botao-menu-mobile').find('i');
        icon.removeClass('fa-solid fa-bars');
        icon.addClass('fa-solid fa-xmark');
        listMenu.slideToggle();
    } else {
        var icon = $('.botao-menu-mobile').find('i');
        icon.removeClass('fa-solid fa-xmark');
        icon.addClass('fa-solid fa-bars');
        listMenu.slideToggle();
    }
})