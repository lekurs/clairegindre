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
})

//
// {#<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">#}
// {#<ol class="carousel-indicators">#}
// {#<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>#}
//     {#<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>#}
//         {#<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>#}
//             {#</ol>#}
//                 {#<div class="carousel-inner">#}
//                 {#<div class="carousel-item active">#}
//                 {#<img class="d-block w-100" src="..." alt="First slide">#}
//                 {#</div>#}
//                     {#<div class="carousel-item">#}
//                     {#<img class="d-block w-100" src="..." alt="Second slide">#}
//                     {#</div>#}
//                         {#<div class="carousel-item">#}
//                         {#<img class="d-block w-100" src="..." alt="Third slide">#}
//                         {#</div>#}
//                             {#</div>#}
//                                 {#<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">#}
//                                 {#<span class="carousel-control-prev-icon" aria-hidden="true"></span>#}
//                                     {#<span class="sr-only">Previous</span>#}
//                                         {#</a>#}
//                                             {#<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">#}
//                                             {#<span class="carousel-control-next-icon" aria-hidden="true"></span>#}
//                                                 {#<span class="sr-only">Next</span>#}
//                                                     {#</a>#}
//                                                         {#</div>#}