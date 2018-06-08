jQuery(document).ready(function ($) {
    $('.contact-form').on('focus', function () {
        $(this).parent().addClass('is-active is-completed');
    });

    $('.contact-form').on('focusout', function () {
        if($(this).val() === "")
            $(this).parent().removeClass('is-completed');
        $(this).parent().removeClass('is-active');
    });

    // $('#contact_date').on('click', function () {
    //     $('.position-date-picker').css('display', 'block');
    // });

    // $('.table-condensed').on('click', function () {
    //     $('.position-date-picker').css('display', 'none');
    // });
});