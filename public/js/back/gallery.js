var $form = $('.box');

$form.addClass('has-advanced-upload');

var droppedFiles = false;

$form.on('drag dragstart dragend dragover dragenter dragleave drop', function (e) {
    e.preventDefault();
    e.stopPropagation();
})

.on('dragover dragenter', function () {
    $form.addClass('is_dragover');
})

.on('dragleave dragend drop', function () {
    $form.removeClass('is_dragover');
})

.on('drop', function (e) {
    droppedFiles = e.originalEvent.dataTransfer.files;
    $form.trigger('submit'); //déclenche l'evenement submit
});

$form.on('submit', function (e) {
    if($form.hasClass('is-uploading')) return false;

    $form.addClass('is-uploading').removeClass('is-error');

    //Ajax
    e.preventDefault();

    var ajaxData = new FormData($form.get(0));

    if(droppedFiles) {
        $.each(droppedFiles, function (i, file) {
            ajaxData.append($input.attr('picture'), file);
        });
    }

    $.ajax({
        url: $form.attr('action'), //nom de la route
        type: $form.attr('method'), //POST
        data: ajaxData,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        complete: function () {
            $form.addClass(data.success == true ? 'is-success' : 'is-error');
            if(!data.success) $errorMsg.text(data.error);
        },
        error: function () {
            // 'Les fichiers n\'ont pas été transféré;
        }
    });
})
