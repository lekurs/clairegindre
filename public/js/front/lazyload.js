(function($){
    $.fn.lazyload = function(){
        $(window).scroll(lazyload);
        lazyload();
    }

    function lazyload(){
        var winScrollTop = $(window).scrollTop();
        var winHeight = $(window).height();

        $('img.img-gallery').each(function(){
            var imgOTop = $(this).offset().top;

            if(imgOTop > (winHeight + winScrollTop)){
                $(this).fadeOut(0);
                    // .attr('src', $(this).data('src'))
                    // .removeClass('lazy')
                    // .removeAttr('data-src')
                    ;
            } else {
                $(this).fadeIn(200);
            }
        });
    }
})(jQuery);