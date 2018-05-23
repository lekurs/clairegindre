(function($){
    $.fn.lazyload = function(){
        $(window).scroll(lazyload);
        lazyload();
    }

    function lazyload(){
        var winScrollTop = $(window).scrollTop();
        var winHeight = $(window).height();
        console.log(winScrollTop);

        $('img.img-gallery').each(function(){
            var imgOTop = $(this).offset().top;
            console.log(imgOTop, winHeight + winScrollTop);

            if(imgOTop > (winHeight + winScrollTop)){
                $(this).fadeOut();
                    // .attr('src', $(this).data('src'))
                    // .removeClass('lazy')
                    // .removeAttr('data-src')
                    ;
            } else {
                $(this).fadeIn();
            }
        });
    }
})(jQuery);