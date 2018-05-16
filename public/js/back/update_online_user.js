(function ($) {
    var o = {
        auto: true,
        script: '',
    }

    $.fn.updateUser = function (oo) {
        if (oo) {
            $.extend(o, oo); //merge les options
        }
    }

    $('.fa.fa-user.log').on('click', function () {
        user = $(this).attr('data-id');

        if ($(this).hasClass('connected')) {
            $(this).removeClass('connected');
            $(this).addClass('not-connected');
        } else {
            $(this).removeClass('not-connected');
            $(this).addClass('connected');
        }

        $.post( o.script, {id: user}, function(data){
            console.log(data);
            // TODO injecter en bdd
        });
    });
})(jQuery);
