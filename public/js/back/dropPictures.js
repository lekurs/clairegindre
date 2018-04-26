(function ($) {
    var o = {
        auto: true,
        script: 'adminAvoir'
    }
    $.fn.dropPictures = function (oo) {
        if(oo) {
            $.extend(o, oo); //merge les options
        }
        elt = this;

        init(elt, o);

        function init(elt, o) {
            barAction = $('<div>').addClass('row').addClass('no-gutters').appendTo(elt);
            addFiles = $('<input type="button">').addClass('btn').addClass('btn-success').addClass('drop_pictures_button').attr('id', 'addFiles').val('Ajouter fichiers');
            startUpload = $('<input type="button">').addClass('btn').addClass('btn-primary').addClass('drop_pictures_button').attr('id', 'startUpload').val('Uploader');
            deleteAll = $('<input type="button">').addClass('btn').addClass('btn-danger').addClass('drop_pictures_button').attr('id', 'deleteAll').val('Supprimer');
            inputFile = $('<input type="file" multiple>').addClass('browse').attr('id', 'files');

            barAction.append(addFiles).append(startUpload).append(deleteAll).append(inputFile);
        }

        function showPictures(files) {
            for(file in files) {
                
            }
        }

        $(this).on('click', '#addFiles', function () {
            inputFile.click();
        });

        $(this).on('change', '#files', function () {
            showPictures(this.files);
        });
    }
}) (jQuery);