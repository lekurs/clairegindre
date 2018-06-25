jQuery(document).ready(function ($) {

    function _getDir($el, event) {
        var
            w = $el.width(),
            h = $el.height(),
            cx = $el.offset().left + w/2, //Centre absisse
            cy = $el.offset().top + h/2, //Centre coordonnées
            x = (event.pageX - cx) * (w>h?(h/w) :1),
            y = -(event.pageY - cy) * (h>w?(w/h):1),
            direction = Math.round(((Math.atan2(x,y) + Math.PI ) / (Math.PI/2)) + 2) %4;

        var directions = {
            0 : {left:0, top:-h},
            1: {left:w, top:0},
            2: {left:0, top: h},
            3: {left: -w, top: 0}
        }
        return directions[direction];
    }

    $('.thumb').on('mouseenter', function (event) {
        $(this).find('.link_hover').css(_getDir($(this),event)).animate({top: 0, left: 0}, 500);
    });

    $('.thumb').on('mouseleave', function (event) {
        $(this).find('.link_hover').animate(_getDir($(this), event), 500);
    });

// $(window).on('resize', function () {
//     if (document.body.clientWidth > '768') {
//         $('.portfolio-pres:nth-child(1)').removeClass('left-1');
//         $('.portfolio-pres:nth-child(1)').addClass('middle-1');
//         // $('.portfolio-pres:nth-child(2)').addClass('left-2');
//         // $('.portfolio-pres:nth-child(3)').addClass('left-3');
//         $('.portfolio-pres:nth-child(4)').removeClass('middle-1');
//         $('.portfolio-pres:nth-child(4)').addClass('left-1');
//         // $('.portfolio-pres:nth-child(5)').addClass('middle-2');
//         // $('.portfolio-pres:nth-child(6)').addClass('middle-3');
//         // $('.portfolio-pres:nth-child(7)').addClass('middle-4');
//         // $('.portfolio-pres:nth-child(8)').addClass('right-1');
//         // $('.portfolio-pres:nth-child(9)').addClass('right-2');
//     } else {
//         $('.portfolio-pres:nth-child(1)').removeClass('left-1');
//         $('.portfolio-pres:nth-child(1)').addClass('middle-1');
//         $('.portfolio-pres:nth-child(4)').removeClass('middle-1');
//         $('.portfolio-pres:nth-child(4)').addClass('left-1');
//         // $('.portfolio-pres:nth-child(1)').removeClass('left-1');
//         // $('.portfolio-pres:nth-child(2)').removeClass('left-2');
//         // $('.portfolio-pres:nth-child(3)').removeClass('left-3');
//         // $('.portfolio-pres:nth-child(4)').removeClass('middle-1');
//         // $('.portfolio-pres:nth-child(5)').removeClass('middle-2');
//         // $('.portfolio-pres:nth-child(6)').removeClass('middle-3');
//         // $('.portfolio-pres:nth-child(7)').removeClass('middle-4');
//         // $('.portfolio-pres:nth-child(8)').removeClass('right-1');
//         // $('.portfolio-pres:nth-child(9)').removeClass('right-2');
    }

});

});