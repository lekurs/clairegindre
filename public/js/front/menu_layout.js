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
});