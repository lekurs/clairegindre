//Drag&drop files for gallery

(function ($) {
    var o = {
        message : 'Déposez vos fichiers ici',
        script : '',
    }

    $.fn.dropfiles = function(oo) {
        if(oo)
            $.extend(o, oo); //Fusionne les paramètres

        this.each(function () {
            // $('.upload-img-container').prepend('<span class="messageUpload">');
            $('.messageUpload').append(o.message);
            $(this).bind({
                dragenter : function(e) {
                    e.preventDefault();
                },

                dragover : function (e) {
                    e.preventDefault();
                    $('.messageUpload').addClass('hover');
                },

                dragleave : function (e) {
                    e.preventDefault();
                    $('.messageUpload').removeClass('hover');
                },
            });
            this.addEventListener('drop', function (e) {
                e.preventDefault();
                var files = e.dataTransfer.files;

                console.log(files);
                show(files, $(this), 0);
                console.log($(this));
            }, false);
        });

        function upload(files, area, index) {
            var file = files[index]; //Relance un à un les fichiers permettant d'éviter la surcharge du nav
            var xhr = new XMLHttpRequest();
            xhr.open('post', o.script, true);
            xhr.setRequestHeader('content-type', 'multipart/form-data');
            xhr.setRequestHeader('x-file-type', file.type);
            xhr.setRequestHeader('x-file-size', file.size);
            xhr.setRequestHeader('x-file-name', file.name);
            xhr.send(file);
        }

        function show(files, area, index) {
            var file = files[index];
            $('.messageUpload').removeClass('hover');
            for(var i =0; i<files.length;i++)
            {
            // $('.drop-container').append('<div class="upload-img-container">');
                $('.upload-img-container').append('<img src="'+URL.createObjectURL(files[i])+'" class="img_upload" />');
            }
        }
    }

}) (jQuery);