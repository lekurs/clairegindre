(function ($) {
    var o = {
        auto: true,
        script: '',
    }

    $.fn.servingFiles = function (oo) {
        if (oo) {
            $.extend(o, oo); //merge les options
        }
    }

    $('.fa.fa-download.serving').on('click', function () {
        downloadFile = $(this).attr('data-id');

        // if ($(this).hasClass('online')) {
        //     $(this).removeClass('online');
        //     $(this).addClass('offline');
        // } else {
        //     $(this).removeClass('offline');
        //     $(this).addClass('online');
        // }

        $.post( o.script, {id: downloadFile}, function(data){
            console.log(data);
            // TODO injecter en bdd
        });
    });
})(jQuery);
