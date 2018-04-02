$(document).ready(function() {
    var $container = $('#gallery_order_pictures');
    var index = $container.find(':input').length;

    if (index == 0) {

        addUrl($container);

    } else {

    }
    function addUrl($container) {
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'link n°' + (index+1))
            .replace(/__name__/g,        index)
        ;

        var $prototype = $(template);
        $container.append($prototype);
        index++;
    }
});
