$(document).ready(function () {
    var images = $('.img-container');
    var widthContainer = (images.length * 100);

    $('.img-gallery-customer').on('click', function () {
        $('.sticky-white').hide(0);
        $('<body>').css('overflow', 'hidden');
        var imgUrl = $(this).attr('data-url');
        var imgId = $(this).attr('data-id');

        $('.modal-perso').show('1500');

        console.log(imgUrl + '/' + imgId);

        $('.img-container').attr('src', imgId);
        $('.link-to-dl-image').attr('href', imgUrl);

    });

    $('.close-modal').on('click', function () {
        $('.modal-perso').hide('1500');

        $('.sticky-white').show(0);
        $('<body>').css('overflow', 'auto');
    });
});