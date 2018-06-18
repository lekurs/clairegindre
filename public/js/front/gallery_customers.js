$(document).ready(function () {
    var box = $('.cards-content');
    var infos = $('.infos-gallery-img');
    var container = $('.cards-content');

    // $(box).on('mouseover', function () {
    //     $(this).find(infos).css('opacity', '1');
    // });
    // $(box).on('mouseout', function () {
    //     $(this).find(infos).css('opacity', '0');
    // });
    // $(box).on('click', function () {
    //     $(this).find('.modal').modal('show');
    // });

    // $('.close').on('click', function () {
    //     $(this).find('.modal').modal('hide');
    // });

    $('.img-container').hide(0);


    $('.img-gallery-customer').on('click', function () {
        $('.sticky-white').hide(0);
        $('<body>').css('overflow', 'hidden');

        $('.modal-perso').show();
        $(this).parent().show();
        console.log($('.modal-perso').children);

    });

    $('.close-modal').on('click', function () {
        $('.modal-perso').hide();

        $('.sticky-white').show(0);
        $('<body>').css('overflow', 'auto');
    });

    // $(container).on('click', function () {
    //     //Création de la première image
    //     carouselItem = $('<div class="carousel-item">');
    //     console.log(carouselItem);
    //     $('.carousel-inner').prepend(carouselItem);
    //     $('.carousel-item.active').append('<img id="first">');
    //     $('#first').addClass('d-block w-100').attr('src', $(this).find('img').attr('src'));
    //
    //     //On attribut l'ordre d'apparition des images
    //
    // });
});
