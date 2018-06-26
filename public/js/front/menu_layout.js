//sticky menu

jQuery(document).ready(function($) {
   var top_position = $('#end-nav').offset().top;

   $(window).scroll(function () {
       if ($(this).scrollTop() > top_position) {
           $('.nav-desktop').addClass('sticky');
           $('.social-container').addClass('social-container-black');
           $('.menu').css({
               'position' : 'fixed',
               'z-index': '999999'
           });
           $('.menu-overlay').css('z-index', '100000');
       } else {
           $('.nav-desktop').removeClass('sticky');
           $('.social-container').removeClass('social-container-black');
           $('.menu').css({
               'position' : 'absolute',
           });
           $('.menu-overlay').css('z-index', '999999');
           $('.open').css('z-index', '999999');
       }
   });

    $(window).on('resize', function () {
        if (document.body.clientWidth > '768') {
            $('.social-container').css('top', '40%');
            $('.logo-content').css('margin-top', '6%');
        }
    });
});