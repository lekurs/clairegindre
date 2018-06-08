$(document).ready(function () {
    var box = $('.cards-content');
    var infos = $('.infos-gallery-img');
    var container = $('.cards-content');

    $(box).on('mouseover', function () {
        $(this).find(infos).css('opacity', '1');
    });
    $(box).on('mouseout', function () {
        $(this).find(infos).css('opacity', '0');
    });
    $(box).on('click', function () {
        $(this).find('.modal').modal('show');
    });
    $('.close').on('click', function () {
        $(this).find('.modal').modal('hide');
    })

    $(container).on('click', function () {
        //Création de la première image
        carouselItem = '<div class="carousel-item active">';
        $('.carousel-inner').prepend(carouselItem);
        $('.carousel-item.active').append('<img id="first">');
        $('#first').addClass('d-block w-100').attr('src', $(this).find('img').attr('src'));

        //On attribut l'ordre d'apparition des images

    });
});
