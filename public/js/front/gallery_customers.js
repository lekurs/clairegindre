$(document).ready(function () {
    var images = $('.img-container');
    var widthContainer = (images.length * 100);

    // for (var i=0; i < images.length; i++)
    // {
    //
    // }

    $('.img-gallery-customer').on('click', function () {
        $('.sticky-white').hide(0);
        $('<body>').css('overflow', 'hidden');
        imgId = $(this).attr('data-url');

        $('.modal-perso').show('1500');

        $('.img-container').attr('src', imgId);
        $('.link-to-dl-image').attr('href', 'dl/' + imgId);
        $('.link-to-dl-image').attr('download', imgId);

    });

    $('.close-modal').on('click', function () {
        $('.modal-perso').hide('1500');

        $('.sticky-white').show(0);
        $('<body>').css('overflow', 'auto');
    });
});
