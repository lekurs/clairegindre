//Hide or show galleries's users

$(document).ready(function () {
    var galleries = $('.show-galleries');
    var arrow = $('.show-gallery');
    var add = $('span[data-toggle = "modal"]');

    $(arrow).on('click', function () {
        elt = $(this).closest('.gallery-container').find('.show-galleries');
        if (elt.css('display') == 'none') {
            elt.slideDown();
            $(this).addClass('show-active');
        }
        else {
            $(this).removeClass('show-active');
            elt.slideUp();
        }
    });

    $(add).on('click', function () {
        console.log("pui");
        id = $(this).attr('data-id');
       $('#add_gallery_user').val(id);
    })
})