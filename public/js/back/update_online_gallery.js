(function ($) {
    var o = {
        auto: true,
        script: '',
    }

    $.fn.updateOnlineGallery = function (oo) {
        if (oo) {
            $.extend(o, oo); //merge les options
        }
    }

    $('.fa.statement-gallery').on('click', function () {
        statementGallery = $(this).attr('data-id');

        if ($(this).hasClass('online')) {
            $(this).removeClass('online');
            $(this).addClass('offline');
        } else {
            $(this).removeClass('offline');
            $(this).addClass('online');
        }

        $.post( o.script, {id: statementGallery}, function(data){
            console.log(data);
            // TODO injecter en bdd
        });
    });
})(jQuery);
