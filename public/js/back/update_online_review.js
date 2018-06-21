(function ($) {
    var o = {
        auto: true,
        script: '',
    }

    $.fn.updateReview = function (oo) {
        if (oo) {
            $.extend(o, oo); //merge les options
        }
    }

    $('input[type="checkbox"].switch-checkbox').on('click', function () {
        onlineStatus = $(this).attr('data-id');

        if ($(this).hasClass('online')) {
            $(this).removeClass('online');
            $(this).addClass('offline');
        } else {
            $(this).removeClass('offline');
            $(this).addClass('online');
        }

        $.post( o.script, {id: onlineStatus}, function(data){
            console.log(data);
            // TODO injecter en bdd
        });
    });
})(jQuery);
