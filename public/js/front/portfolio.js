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


})