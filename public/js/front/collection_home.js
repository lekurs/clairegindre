//Javascript
jQuery(document).ready(function ($) {
    $('div.collection-item-left-1').mouseenter(function () {
        $('div.hover-mask-left-1').animate({
            'opacity' : '1',
            'width' : '50%',
        }, 1000);
    });

    $('div.collection-item-left-1').mouseleave(function () {
         $('div.hover-mask-left-1').animate({
             'opacity' : '0',
             'width' : '0%',
         }, 1000);
    });

    $('div.collection-item-left-2').mouseenter(function () {
        $('div.hover-mask-left-2').animate({
            'opacity' : '1',
            'width' : '50%',
        }, 1000);
    });

    $('div.collection-item-left-2').mouseleave(function () {
        $('div.hover-mask-left-2').animate({
            'opacity' : '0',
            'width' : '0%',
        }, 1000);
    });

    $('div.collection-item-right-1').mouseenter(function () {
        $('div.hover-mask-right-1').animate({
            'opacity' : '1',
            'height' : '50%',
        }, 1000);
    });

    $('div.collection-item-right-1').mouseleave(function () {
        $('div.hover-mask-right-1').animate({
            'opacity' : '0',
            'height' : '0%',
        }, 1000);
    });

    $('div.collection-item-right-2').mouseenter(function () {
        $('div.hover-mask-right-2').animate({
            'opacity' : '1',
            'height' : '50%',
        }, 1000);
    });

    $('div.collection-item-right-2').mouseleave(function () {
        $('div.hover-mask-right-2').animate({
            'opacity' : '0',
            'height' : '0%',
        }, 1000);
    });
})
