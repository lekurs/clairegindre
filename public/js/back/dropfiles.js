//Drag&drop files for gallery

(function ($) {
    var o = {
        message : 'Déposez vos fichiers ici',
        script : '',
    }

    $.fn.dropfiles = function(oo) {
        if (oo)
            $.extend(o, oo); //Fusionne les paramètres
            console.log(o.script);
        this.each(function () {
            $('.messageUpload').append(o.message);
            $(this).bind({
                dragenter: function (e) {
                    e.preventDefault();
                },

                dragover: function (e) {
                    e.preventDefault();
                    $('.messageUpload').addClass('hover');
                },

                dragleave: function (e) {
                    e.preventDefault();
                    $('.messageUpload').removeClass('hover');
                },
            });
            this.addEventListener('drop', function (e) {
                e.preventDefault();
                var files = e.dataTransfer.files;

                //ShowFiles live
                show(files, $(this), 0);
            }, false);

        });

        var container = $('#gallery_picture');
        var index = container.find(':input').length;

        function show(files, area, index) {
            var file = files[index];
            var form = $('#gallery')[0];
            var xhr = new XMLHttpRequest();

            $('.messageUpload').removeClass('hover');
            xhr.open('post', o.script, true);
            xhr.setRequestHeader('content-type', 'mutlipart/form-data');

            for (var i = 0; i < files.length; i++) {
                $('.upload-img-container').append('<img src="' + URL.createObjectURL(files[i]) + '" class="img_upload" data-list="#picturename-fields-list"/>');

                //Création du tableau CollectionType Symfony
                addField(container, files[i].name);
                xhr.setRequestHeader('x-file-type', file.type);
                xhr.setRequestHeader('x-file-size', file.size);
                xhr.setRequestHeader('x-file-name', file.name);
                xhr.send();
        // console.log($(':file')[0].name);
        //         $.ajax({
        //             url: o.script,
        //             type: "POST",
        //             data: new FormData(form),
        //             contentType: false,
        //             cache: false,
        //             processData: false,
        //             success: function (data) {
        //                 $('.test-success').hide();
        //                 $('.test-success-message').html(data);
        //             }
        //         });
            }
        }

        function addField(container, name) {
            var template = container.attr('data-prototype')
                .replace(/__name__label_/g, 'Image N°' + (index + 1))
                .replace(/__name__/g, name);
            var prototype = $(template);

            container.append(prototype);

            index++;
        }

        // function submit(fileName)
        // {
        //     var fichier = $(':file');
        //     var max = $(':file');
        //     var file = fichier[0].name;
        //     if(max > 0)
        //     {
        //     for(var i=0; i<max;i++)
        //     {
        //         var fileName =file[i].name;
        //     }
        //     }
        // }

        // $('.test-btn').on('mouseover', function () {
        //     var fichier = $(':file');
        //     var max = $(':file').length;
        //     for(var i=0; i<max; i++) {
        //         console.log(fichier);
        //         // fichier.val(fichier);
        //         // return $(fichier)[i];
        //         console.log(new File([], fichier[1]));
        //         // console.log($(fichier)[i].name);
        //     }
        // });
    }
}) (jQuery);