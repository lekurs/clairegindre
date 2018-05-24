(function ($) {
    var o = {
        auto: true,
        script: '',
    }

    $.fn.deletePicture = function (oo) {
        if(oo) {
            $.extend(o, oo); //merge les options
        }

        $('.trash-icone').on('click', function () {
            suppr = $(this).attr('data-id');

            $.post( o.script, {id: suppr}, function(data){
                console.log(data);
                // TODO injecter en bdd
            });
        });
    }
}) (jQuery);