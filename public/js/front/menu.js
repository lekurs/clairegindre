jQuery(document).ready(function($) {
    $('.nav-border').css({'border-bottom': '1px solid #000000 !important'});

    $('.nav-link').css('color', '#000000');

    $('a#nav-link-home:before').css('color', 'red');

    $('.left-menu').removeClass('left-menu');
    $('.nav-item > a').addClass('nav-link-black');

    $('.right-menu').removeClass('right-menu');
    $('.right-menu > a').addClass('nav-link-black');

    var top_position = $('#end-nav').offset().top;

    $(window).scroll(function () {
        if ($(this).scrollTop() > top_position) {
            $('.nav-desktop').addClass('sticky-white');
            $('.social-container').addClass('social-container-black');
            $('.menu').css({
                'position' : 'fixed',
                'z-index': '999999'
            })
        } else {
            $('.nav-desktop').removeClass('sticky-white');
            $('.social-container').removeClass('social-container-black');
            $('.menu').css({
                'position' : 'absolute',
            })
        }
    });
});