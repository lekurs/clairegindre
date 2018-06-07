jQuery(document).ready(function ($) {
    $('.contact-form').on('focus', function () {
        $(this).parent().addClass('is-active is-completed');
    });

    $('.contact-form').on('focusout', function () {
        if($(this).val() === "")
            $(this).parent().removeClass('is-completed');
        $(this).parent().removeClass('is-active');
    });
})