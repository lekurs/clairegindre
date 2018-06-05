jQuery(document).ready(function($) {
    $('.nav-border').css('border-bottom', '1px solid #0000000');
    $('.left-menu').removeClass('left-menu');
    $('.left-menu > a').addClass('nav-link-black');

    $('.right-menu').removeClass('right-menu');
    $('.right-menu > a').addClass('nav-link-black');

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