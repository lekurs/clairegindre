$(document).ready(function ($) {
    var container = $('.builder-container');
    var landscape = $('a.add-landscape-picture');
    var landscapes = $('a.add-landscape-pictures');
    var portrait = $('a.add-portrait-picture');
    var portraits = $('a.add-portrait-pictures');


    $(landscape).on('click', function () {
        $(container).append('<div class="row no-gutters"><div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 offset-1 wait-landscape"></div></div>')
    });

    $(landscapes).on('click', function () {
        $(container).append('<div class="row no-gutters">' +
                                                        '<div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-10 offset-1 wait-landscapes"></div>' +
                                                        '<div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-10 wait-landscapes"></div>' +
                                                    '</div>'
                                            )
    });

    $(portrait).on('click', function () {
        $(container).append('<div class="row no-gutters"><div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 offset-1 wait-portrait"></div></div>')
    });

    $(portraits).on('click', function () {
        $(container).append('<div class="row no-gutters">' +
                '<div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-10 offset-1 wait-portraits"></div>' +
                '<div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-10 wait-portraits"></div>' +
            '</div>'
        )
    });
})