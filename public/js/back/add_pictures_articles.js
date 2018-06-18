$(document).ready(function($) {
    var $container = $('#select_pictures_for_article_images');
    var index = $container.find(':input').length;

    if (index == 0) {

        addImage($container);

    } else {

    }
    function addImage($container) {
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'image n°' + (index+1))
            .replace(/__name__/g,        index)
        ;

        var $prototype = $(template);
        $container.append($prototype);
        index++;
    }
});
