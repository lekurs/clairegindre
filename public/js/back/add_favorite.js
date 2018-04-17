$(document).ready(function () {
    var checked = $('input:checkbox');

    checked.each(function () {
        $(this).on('click', function () {
            if(checked.is(':checked')) {
                checked.removeAttr('checked');
                $(this).attr('checked');
            }
        })
    })
})