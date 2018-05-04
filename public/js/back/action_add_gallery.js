$(document).ready(function ($) {
    $('.delete-image').on('click', function () {
        id = $(this).attr('data-id');
        elt = $(this);
        $.post('/admin/gallery/pictures/delete', { 'id': id }, function (data) {
            if (data == 'success') {
                elt.closest('.box-picture').remove();
            }
        });
    });

    $('.favorite-image').on('click', function () {
        id = $(this).attr('data-id');
        elt = $(this);
        $.post('/admin/gallery/pictures/favorite', { 'id': id }, function (data) {
            if (data == 'success') {
                $('.favorite-image.selected').removeClass('selected');
                elt.addClass('selected');
            }
        });
    });
});