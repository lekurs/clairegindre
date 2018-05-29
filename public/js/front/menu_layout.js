//sticky menu

jQuery(document).ready(function($) {
   var top_position = $('#end-nav').offset().top;

   $(window).scroll(function () {
       console.log(top_position + ' / ' + $(this).scrollTop());
       if ($(this).scrollTop() > top_position) {
           $('.nav-desktop').addClass('sticky');
       } else {
           $('.nav-desktop').removeClass('sticky');
       }
   });
});