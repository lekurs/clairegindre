$(document).ready(function () {
    var box = $('.box');
    var infos = $('.gallery-customers-informations');
    var img_customers = $('.img-customers');

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
})