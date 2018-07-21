(function($){
    var o = {
        reference : 'second',
        nbcolonne:4,
        class:'portefolio'
    }

    var elt;
    var portefolio = {
        init:function(){
            nbImg = $(elt).find('img').length;
            nbLine = nbImg / o.nbcolonne;
            img = new Array;
            for(i=1; i<= nbImg; i++)
            {
                img[i] = $(elt).find('img:nth-child('+i+')');
            }

            for(i=1; i<=nbLine; i++)
            {
                line = $('<div>').addClass("row").addClass("no-gutters").css("display", "flex").css("flex-direction", "row");

                for(z=1; z<=o.nbcolonne; z++)
                {
                    col = $('<div>').addClass('col-lg-'+(12/o.nbcolonne))
                        .addClass('col-xl-'+(12/o.nbcolonne))
                        .addClass('col-md-'+(12/o.nbcolonne))
                        .addClass('col-sm-'+(12/o.nbcolonne))
                        .addClass('col-'+(12/o.nbcolonne))
                        .addClass('content-img')
                        .css('display','flex');

                    img[((i-1)*o.nbcolonne)+z].addClass("img-fluid").css("width", "100%").css("object-fit", "cover").appendTo(col);
                    line.append(col);
                }

                $(elt).append(line);
            }


        },
        sizing:function(){

            h = ($("#"+o.reference).height())/2;
            $(".content-img").css("height", Math.round(h));
        }
    }

    $.fn.portefolio = function (oo){
        if(oo) $.extend(o,oo);
        this.each(function(){

            elt = this;
            portefolio.init();
            portefolio.sizing();

            $(window).resize(function(){
                portefolio.sizing();
            });
        });
    }
})(jQuery);