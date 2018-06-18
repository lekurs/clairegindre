//sticky menu

jQuery(document).ready(function($) {
   var top_position = $('#end-nav').offset().top;

   $(window).scroll(function () {
       if ($(this).scrollTop() > top_position) {
           $('.nav-desktop').addClass('sticky');
       } else {
           $('.nav-desktop').removeClass('sticky');
       }
   });

    $(window).on('resize', function () {
        if (document.body.clientWidth > '768') {
            // $('.sticky').css('height', '22vh')
            $('.social-container').css('top', '40%');
            $('.logo-content').css('margin-top', '6%');
        }
    });
});