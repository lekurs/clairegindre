//Hide or show galleries's users

$(document).ready(function () {
    var galleries = $('.show-galleries');
    var arrow = $('.show-gallery');

    // galleries.hide();

    $(arrow).each(function () {

        for(var i =0; i< galleries.length; i++) {
            $(galleries).each(function () {
                $(this).attr('id', i++);
            });
        }
        $(this).on('click', function () {
            $(this).toggleClass('show-active');

        });
    });
})