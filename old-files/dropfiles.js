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
                upload(files, $(this), 0);
            }, false);
        });

        var container = $('#gallery_picture');
        var index = container.find(':input').length;

        function upload(files, area, index) {
            var file = files[index];
            var data = new FormData();
            $('.messageUpload').removeClass('hover');
            var form_data = new FormData();                  // Creating object of FormData class

            for (var i = 0; i < files.length; i++) {
                var test = '<input type="hidden" id="upload" name="img_'+i+'" value="'+files[0]+'">';
                $('.upload-img-container').append('<input type="hidden" id="upload" name="img_'+i+'" value="'+files[0]+'">');
                $('#upload').attr("type");
                console.log($("#upload")[0].value);
                // var file_data = $("#upload").prop("files")[i];   // Getting the properties of file from file field
                // form_data.append("file", file_data)              // Appending parameter named file with properties of file_field to form_data
                // form_data.append("user_id", 123)                 // Adding extra parameters to form_data
                $('.upload-img-container').append('<img src="' + URL.createObjectURL(files[i]) + '" class="img_upload" data-list="#picturename-fields-list"/>');
                form_data.push;
                console.log(form_data);

                //Création du tableau CollectionType Symfony
                addField(container, files[i].name);
            }

                $.ajax({
                    url: o.script,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         // Setting the data attribute of ajax with file_data
                    type: 'post'
                });
        }

        function addField(container, name) {
            var template = container.attr('data-prototype')
                .replace(/__name__label_/g, 'Image N°' + (index + 1))
                .replace(/__name__/g, name);
            var prototype = $(template);

            container.append(prototype);

            index++;
        }

        $('#prout').on('click', function () {
            $.ajax({
                url: o.script,
                data: new FormData(),
                type: "post",
                contentType: false,
                processData: false
            });
        })
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