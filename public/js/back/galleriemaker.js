(function($){

    var o = {
        class : 'galleriemaker',
        nbcell : 3,
        modal : '#createImgModal',
        script : 'upload.php'
    }

    var zone_img;

    var galleriemaker = {
        init: function(elt){
            $(elt).addClass(o.class+"-container");
            bar = this.actionbar();
            line = $("<div>").addClass("row").addClass(o.class+"-row");
            cell = $("<div>").addClass("col").addClass(o.class+"-col").attr("id", o.class+"-col");
            $(cell).html(bar);
            $(line).append(cell);
            $(elt).append(line);
        },
        actionbar: function(){
            line = $("<div>").addClass("row").addClass(o.class+"-baraction");
            cell_left = $("<div>").addClass("col");
            cell_right = $("<div>").addClass("col");
            listaction = $("<ul>").addClass(o.class+"-listaction").addClass("nav");
            $("<li>").addClass(o.class+"-indication").addClass("align-middle").html("Nombre de cellule").appendTo(listaction);
            for(i=1;i<=o.nbcell;i++)
            {
                $("<li>").addClass(o.class+"-capsule").addClass("align-middle").appendTo(listaction);
            }
            $("<button>").addClass("btn").addClass("btn-outline-success").addClass("btn-sm").attr("id", o.class+"-btn-create").html("Ajouter").appendTo(cell_right);
            $("<button>").addClass("btn").addClass("btn-outline-primary").addClass("btn-sm").attr("id", o.class+"-btn-save").html("Enregistrer").appendTo(cell_right);
            $(cell_left).append(listaction);
            $(line).append(cell_left);
            $(line).append(cell_right);
            return line;
        },
        zoneImage: function(nb, elt){
            if(nb > 0)
            {
                line_capsule = $("<div>").addClass("row").addClass(o.class+"-line-capsule");
                col_capsule = $("<div>").addClass("col");
                line_action = $("<div>").addClass("row").addClass(o.class+"-line-capsule-bar");
                col_action = $("<div>").addClass("col");
                $("<i>").addClass("fa-sm").addClass("fas").addClass("fa-times").addClass(o.class+"-btn-del").appendTo(col_action);
                $(line_action).append(col_action);
                $(col_capsule).append(line_action);
                line_img = $("<div>").addClass("row").addClass(o.class+"-line-content-img");
                for(i=1; i<=nb; i++)
                {
                    cell = $("<div>").addClass("col").addClass(o.class+"-content-img");
                    $("<div>").addClass(o.class+"-content-img-action").attr("data-toggle", "modal").attr("data-target", o.modal).html('<i class="fa fa-camera-retro fa-5x"></i>').appendTo(cell);
                    $(cell).appendTo(line_img);
                }
                $(col_capsule).append(line_img);
                $(line_capsule).append(col_capsule);
                $(elt).append(line_capsule);
            }

        }
    }

    $.fn.galleriemaker = function (oo){

        if(oo) $.extend(o,oo);
        var isMouseDown = false;

        this.each(function(){
            elt = this;
            zone = Object.create(galleriemaker);
            zone.init(elt, o);

            //les evenements
            $("."+o.class+"-capsule")
                .mousedown(function () {
                    isMouseDown = true;
                    isHighlighted = $(this).hasClass("selected");
                    if(isHighlighted){
                        $(this).removeClass("selected");
                    }
                    else
                    {
                        $(this).addClass("selected");
                    }
                    return false; // prevent text selection
                })
                .mouseenter(function () {
                    isHighlighted = $(this).hasClass("selected");
                    if(isMouseDown)
                    {
                        if(isHighlighted){
                            $(this).removeClass("selected");
                        }
                        else
                        {
                            $(this).addClass("selected");
                        }
                    }

                });
            $(document).mouseup(function () {
                isMouseDown = false;
            });
            $(this).on("click", "#"+o.class+"-btn-create", function(){
                zone.zoneImage($("."+o.class+"-capsule.selected").length, elt);
            });
            $(this).on("click", "."+o.class+"-btn-del", function(){
                caps = $(this).closest("."+o.class+"-line-capsule")
                //on réactive les images
                imgs = $(this).closest("."+o.class+"-line-capsule").find("img."+o.class+"-thumb");
                $( imgs ).each(function( index, elem ) {
                    $("#" + $(elem).attr('data-id')).show();
                });

                caps.remove();
            });
            $("body").on("click", o.modal+" .modal-body img", function(){
                //on recherche la case active
                $("."+o.class+"-content-img-active").html("<img src='"+$(this).attr("src")+"' class='img-thumbnail "+o.class+"-thumb' data-id='"+$(this).attr("id")+"'>");
                //on ferme la modale
                $(o.modal).modal('toggle');
                //on cache l'image
                $(this).hide();
                //on supprime la classe
                $("."+o.class+"-content-img-active").removeClass(o.class+"-content-img-active");
            });
            $(this).on("click", "."+o.class+"-content-img-action", function(){
                $(this).addClass(o.class+"-content-img-active");
            });
            $(this).on("click", "#"+o.class+"-btn-save", function(){
                var formData = new Object();
                formData.id = $(elt).attr("data-id");
                formData.line = [];

                $("."+o.class+"-line-content-img").each(function(i, elem){
                    img = $(this).find("."+o.class+"-thumb");
                    formData.line[i] = [];
                    $(img).each(function(z,e){
                        formData.line[i][z] = $(e).attr("data-id");
                    });
                });
                $.post( o.script, formData, function(data){
                    console.log(data);
                    // TODO injecter en bdd
                });
            });
        });

    }
})(jQuery);

