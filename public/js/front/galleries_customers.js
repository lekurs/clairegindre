$(document).ready(function () {
    var box = $('.box');
    var infos = $('.gallery-customers-informations');

        $(box).on('mouseover', function () {
            $(this).find(infos).css('opacity', '1');
        });
        $(box).on('mouseout', function () {
            $(this).find(infos).css('opacity', '0');
        });
})