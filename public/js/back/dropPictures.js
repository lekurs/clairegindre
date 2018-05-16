(function ($) {
    var o = {
        auto: true,
        script: '',
        target: '',
        gallery: ''
    }

    var files_selected = new Array;
    var increment_id = 0;
    $.fn.dropPictures = function (oo) {
        if(oo) {
            $.extend(o, oo); //merge les options
        }
        elt = this;

        init(elt, o);

        function init(elt, o) {
            barAction = $('<div>').addClass('row').addClass('no-gutters').addClass('drop_pictures_action_bars');
            addFiles = $('<input type="button">').addClass('btn').addClass('btn-success').addClass('drop_pictures_button').attr('id', 'addFiles').val('Ajouter fichiers');
            startUpload = $('<input type="button">').addClass('btn').addClass('btn-primary').addClass('drop_pictures_button').attr('id', 'startUpload').val('Uploader');
            deleteAll = $('<input type="button">').addClass('btn').addClass('btn-danger').addClass('drop_pictures_button').attr('id', 'deleteAll').val('Supprimer');
            inputFile = $('<input type="file" multiple>').addClass('browse').attr('id', 'drop_pictures_files');

            uploadArea = $('<div>').addClass('row').addClass('no-gutters').addClass('upload-container').attr('id', 'upload-container').appendTo(elt);
            barAction.append(addFiles).append(startUpload).append(deleteAll).append(inputFile);
            elt.before(barAction);
        }

        function showPictures(files) {
            for(index in files) {
                if (!isNaN(index)) {
                    modulo = index % 2;
                    areaContentImage = $('<div>').addClass('col-xl-2').addClass('col-lg-2').addClass('col-md-2').addClass('col-sm-2').addClass('col-2').attr('id', 'row_' + index);
                    line = $('<div>').addClass('drop_pictures_line').addClass((modulo == 1) ? "grey-line" : 'white-line').attr('data-displayOrder', index).appendTo(areaContentImage);

                    colImage = $('<div>').addClass('col-xl-12').addClass('col-lg-12').addClass('col-md-12').addClass('col-sm-12').addClass('col-12').addClass('colImage');
                    colNom = $('<div>').addClass('col-xl-12').addClass('col-lg-12').addClass('col-md-12').addClass('col-sm-12').addClass('col-12').addClass('colNom').html(files[index].name);
                    colSize = $('<div>').addClass('col-xl-12').addClass('col-lg-12').addClass('col-md-12').addClass('col-sm-12').addClass('col-12').addClass('colSize').html(files[index].size);
                    colDelete = $('<div>').addClass('row').addClass('no-gutters').addClass('colDelete');
                    colProgressBar = $('<div>').addClass('col-xl-12').addClass('col-lg-12').addClass('col-md-12').addClass('col-sm-12').addClass('col-12').addClass('colProgressBar');
                    zoneFavoriteType = $('<div>').addClass('col-xl-6').addClass('col-lg-6').addClass('col-md-6').addClass('col-sm-6').addClass('col-6').addClass('text-center').appendTo(colDelete);
                    zoneDeleteButton = $('<div>').addClass('col-xl-6').addClass('col-lg-6').addClass('col-md-6').addClass('col-sm-6').addClass('col-6').addClass('text-center').appendTo(colDelete);
                    deleteButton = $('<i class="fa fa-trash">').addClass('drop_pictures_button').attr('id', increment_id).val('Supprimer').appendTo(zoneDeleteButton);
                    favoriteType = $('<i class="fa fa-star">').addClass('check_box_favorite').attr('id', 'favorite_' + increment_id).val('1').attr('name', 'favorite').appendTo(zoneFavoriteType);
                    progressBar = $('<div>').addClass('progress').appendTo(colProgressBar);
                    progresseBarContent = $('<div>').addClass('progress-bar').attr('role', 'progressbar').addClass('progress-bar').addClass('progress-bar-striped').addClass('bg-info').css('width', '0%').attr('aria-valuenow', '0').attr('aria-valuemin', '0').attr('aria-valuemax', '100').attr('id', 'bar_'+ index).html('en&nbsp;attente');

                    progressBar.append(progresseBarContent);
                    line.append(colImage).append(colNom).append(colSize).append(colProgressBar).append(colDelete);
                    preview_image(files[index], colImage);
                    areaContentImage.appendTo(uploadArea);
                    files_selected.push(files[index]);
                    increment_id++;
                }
            }
        }

        function onUploadProgress(event) {
            if (event.lengthComputable) {
                var percentComplete = event.loaded / event.total;
                $('progress-value').textContent = parseFloat(percentComplete*100).toFixed(2);
            }
        }

        function upload(files, index) {
            var file = files[index];
            var formData = new FormData();

            favorite = $('#favorite_' + index).hasClass('selected');
            order = $('.drop_pictures_line' + index).attr('data-displayOrder');

            formData.append("picture", file);
            formData.append('destination', o.target);
            formData.append('gallery', o.gallery);
            formData.append('order', index);
            formData.append('favorite', ((favorite == false) ? 0 : 1));

            var xhr = new XMLHttpRequest();
            xhr.open('POST', o.script);
            xhr.setRequestHeader('x-file-type', file.type);
            xhr.setRequestHeader('x-file-size', file.size);
            xhr.setRequestHeader('x-file-name', file.name);
            xhr.upload.addEventListener("progress", function (e) {
                if (e.lengthComputable) {
                    var percentComplete = (e.loaded / e.total)*100;
                    $('#bar_' + index).html(parseFloat(percentComplete).toFixed(2)).css('width', percentComplete + '%');
                }
            }, false);
            xhr.send(formData);
        }

        function preview_image(elt, area)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
                var output = $('<img />').addClass('drop_pictures_previews');
                output.attr("src", reader.result);
                area.append(output);
            }
            reader.readAsDataURL(elt);
        }

        $('body').on('click', '#addFiles', function () {
            inputFile.click();
        });

        $('body').on('change', '#drop_pictures_files', function () {
            showPictures(this.files);
        });

        $('body').on('click', '#startUpload', function () {
            //on parcours le dom a la recherche du input[file]
           for(index in files_selected){
               upload(files_selected, index);
           }
        });

        $('body').on('click', '#deleteAll', function () {
            $('.drop_pictures_line').remove();
            $("#drop_pictures_files").val("");
            files_selected = "";
        });

        $('body').on('click', '.drop_pictures_line .drop_pictures_button', function () {
            id  = $(this).attr('id');
            $(this).closest('#row_' + id).remove();
           delete files_selected[id];
         });

        $('body').on('click', '.check_box_favorite', function () {
            $('.check_box_favorite').removeClass('selected');
            $(this).addClass('selected');
        });
    }
}) (jQuery);