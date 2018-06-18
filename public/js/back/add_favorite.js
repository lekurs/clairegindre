(function ($) {
    var o = {
        auto: true,
        script: '',
    }

    $.fn.favoritePicture = function (oo) {
        if(oo) {
            $.extend(o, oo); //merge les options
        }

        $('.favorite-icone').on('click', function () {
            favorite = $(this).attr('data-id');

            $('.favorite-icone').removeClass('favorite-image');

            $(this).addClass('favorite-image')

            $.post( o.script, {id: favorite}, function(data){
                console.log(data);
                // TODO injecter en bdd
            });
        });
    }
}) (jQuery);