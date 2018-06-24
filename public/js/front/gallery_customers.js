$(document).ready(function () {
    var images = $('.img-container');
    var widthContainer = (images.length * 100);

    $('.img-gallery-customer').on('click', function () {
        $('.sticky-white').hide(0);
        $('<body>').css('overflow', 'hidden');
        imgUrl = $(this).attr('data-url');
        imgId = $(this).attr('data-id');

        $('.modal-perso').show('1500');

        $('.img-container').attr('src', imgId);
        $('.link-to-dl-image').attr('href', imgId);

    });

    $('.close-modal').on('click', function () {
        $('.modal-perso').hide('1500');

        $('.sticky-white').show(0);
        $('<body>').css('overflow', 'auto');
    });
});