jQuery(document).ready(function($) {
    $('.left-menu').removeClass('left-menu');
    $('.left-menu > a').addClass('nav-link');

    $('.right-menu').removeClass('right-menu');
    $('.right-menu > a').addClass('nav-link');

    var top_position = $('#end-nav').offset().top;

    $(window).scroll(function () {
        console.log(top_position + ' / ' + $(this).scrollTop());

        if ($(this).scrollTop() > top_position) {
            $('.nav-desktop').addClass('sticky-white');
        } else {
            $('.nav-desktop').removeClass('sticky-white');
        }
    });
})