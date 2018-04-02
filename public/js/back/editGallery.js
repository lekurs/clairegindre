jQuery(document).ready(function($) {

    var thumb = $('.options-thumb');

    $('.picture-thumb').on('mouseenter', function () {
        $(thumb).each(function () {
            console.log($(this));
            $(this).removeClass('thumb-inactive');
        })
    })

    $('.picture-thumb').on('mouseleave', function (index, element) {
        var picture = $('.picture-thumb');
        console.log($(this));
            $(thumb).addClass('thumb-inactive');
            console.log(index + '=> ' + $(this));
    })

    $('.favorite').on('click', function () {
            $('.favorite > i').toggleClass('favorite-color');
    })
})