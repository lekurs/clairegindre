(function($){
    $.fn.checkboxPrettify = function (selector, oo){
        o = {
            colorselected : '#26a69a',
            colordefault : '#5a5a5a'
        }

        if(oo) $.extend(o,oo);

        this.each(function(){

            $(this).addClass("checkbox-prettify");

            label = $("<label>");
            libelle = (($(this).data("label")) ? $(this).data("label") : $(this).val());

            document.styleSheets[0].addRule(selector+'[type="checkbox"]+span:not(.lever):before, '+selector+'[type="checkbox"]:not(.filled-in)+span:not(.lever):after', 'border: 2px solid '+o.colordefault+' !important;');
            document.styleSheets[0].addRule(selector+'[type="checkbox"]:checked+span:not(.lever):before', 'border-right: 2px solid '+o.colorselected+' !important;');
            document.styleSheets[0].addRule(selector+'[type="checkbox"]:checked+span:not(.lever):before', 'border-bottom: 2px solid '+o.colorselected+' !important;');

            $(this).wrap( label );

            $(this).after("<span>" + libelle + "</span>");
        });
    }
})(jQuery);