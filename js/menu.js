$(function (){
    $(".navbar-toggler").click (function (){
        $(".navbar-collapse").toggleClass("d-block");
        $(".navbar-collapse").removeClass("show");
    });
    $(".IconMenu").click (function (){
        $(".menu").toggleClass("menu-open");
    });
    // menu
});

$(".content > .menu > ul li").on('click', function() {
    if (!($(this).hasClass('open'))) {
        $(".content > .menu").find('.open').removeClass('open');
        $(".content > .menu").find('.mm-active').removeClass('mm-active');
        $(this).addClass('open');
        $(this).addClass('mm-active');
        $('.li > a').addClass('has-arrow');
        document.querySelector('.mm-collapse').style.height = 'fit-content';
    } else {
        $(this).removeClass('open');
        $(this).removeClass('mm-active');
        $('.li > a').removeClass('has-arrow');
        document.querySelector('.mm-collapse').style.height = '0 !important';
    }
});