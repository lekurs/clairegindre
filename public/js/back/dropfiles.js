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

                // console.log(files);
                show(files, $(this), 0);
            }, false);
        });

        // function upload(files, area, index) {
        //     var file = files[index]; //Relance un à un les fichiers permettant d'éviter la surcharge du nav
        //     var xhr = new XMLHttpRequest();
        //     xhr.open('post', o.script, true);
        //     xhr.setRequestHeader('content-type', 'multipart/form-data');
        //     xhr.setRequestHeader('x-file-type', file.type);
        //     xhr.setRequestHeader('x-file-size', file.size);
        //     xhr.setRequestHeader('x-file-name', file.name);
        //     xhr.send(file);
        // }

        function show(files, area, index) {
            var file = files[index];
            $('.messageUpload').removeClass('hover');
                // console.log(file.name);
                var array = new Array();
            for(var i =0; i<files.length;i++)
            {
                $('.upload-img-container').append('<img src="'+URL.createObjectURL(files[i])+'" class="img_upload" data-prototype/>');
                //Création du tableau CollectionType Symfony
                // var list = $('.box_files').attr('data-list');
                // var newWidget = list.attr('data-prototype');
                // newWidget = newWidget.replace(/__name__/g);
                //
                // var newElem = Jquery(list.attr('data-widget-tags')).html(newWidget);
                // newElem.appendTo(list);

                array.push(i, files[i].name);
            }

            console.log(array);
        }
    }

}) (jQuery);