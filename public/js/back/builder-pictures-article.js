$(document).ready(function ($) {
    var container = $('.builder-container');
    var landscape = $('a.add-landscape-picture');
    var landscapes = $('a.add-landscape-pictures');
    var portrait = $('a.add-portrait-picture');
    var portraits = $('a.add-portrait-pictures');

    $('body').on('click', '.img-article', function () {
        mon_image = $(this).detach();
        // conteneur_new_image = $('<div class="row no-gutters"><div class="col-xl-12 col-lg-12"></div></div>').append(mon_image);
        $('.fa-cog.selected').closest('.wait').find('.block-img').html(mon_image);
        console.log($('.fa-cog.selected').closest('.wait'));
    });

    $('body').on('click', '.bar-actions .fa-cog', function () {
        $('.bar-actions .fa-cog').removeClass('selected');
        $(this).addClass('selected');
    });

    $(landscape).on('click', function () {
        $(container).append('<div class="row no-gutters"><div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 offset-1 wait-landscape wait">' +
            '<div class="bar-actions"><span data-toggle="modal" data-target="#createImgModal"><button type="button"><i class="fa fa-cog"></i></button></span><i class="fa fa-trash delete-elem"></i></div><div class="block-img" data-id="4424"></div></div></div>')
    });

    $(landscapes).on('click', function () {
        $(container).append('<div class="row no-gutters">' +
                                                        '<div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-10 offset-1 wait-landscapes wait">' +
                                                            '<div class="bar-actions col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><span data-toggle="modal" data-target="#createImgModal"><button type="button"><i class="fa fa-cog"></i></button></span><i class="fa fa-trash delete-elem"></i></div></div>' +
                                                                '<div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-10 wait-landscapes wait">' +
                                                                    '<div class="bar-actions col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">' +
                                                                        '<span data-toggle="modal" data-target="#createImgModal"><button type="button"><i class="fa fa-cog"></i></button></span><i class="fa fa-trash delete-elem"></i></div></div>'
                                            )
    });

    $(portrait).on('click', function () {
        $(container).append('<div class="row no-gutters"><div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 offset-1 wait-portrait wait">' +
            '<div class="bar-actions">' +
            '<span data-toggle="modal" data-target="#createImgModal"><button type="button"><i class="fa fa-cog"></i></button>' +
            '</span><i class="fa fa-trash delete-elem"></i></div></div></div>')
    });

    $(portraits).on('click', function () {
        $(container).append('<div class="row no-gutters">' +
                '<div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-10 offset-1 wait-portraits wait">' +
                    '<div class="bar-actions"><span data-toggle="modal" data-target="#createImgModal"><button type="button"><i class="fa fa-cog"></i></button></span><i class="fa fa-trash delete-elem"></i>' +
                    '</div>' + '<div class="block-img" data-id="4454"></div>'+
                '</div>' +
                    '<div class="col-xl-5 col-lg-5 col-md-10 col-sm-10 col-10 wait-portraits wait"><div class="bar-actions"><span data-toggle="modal" data-target="#createImgModal"><button type="button"><i class="fa fa-cog"></i></button></span><i class="fa fa-trash delete-elem"></i></div></div>' +
            '</div>'
        )
    });
})