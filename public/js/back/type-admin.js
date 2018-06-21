jQuery(document).ready(function ($) {

    $('.form-group').on('focus', function () {
        $(this).parent().addClass('is-active is-completed');
    });

    $('.form-group').on('focusout', function () {
        if($(this).val() === "")
            $(this).parent().removeClass('is-completed');
        $(this).parent().removeClass('is-active');
    });

    $('.input-modal').on('focus', function () {
        $(this).parent().addClass('is-active is completed');
    });

    $('.input-modal').on('focusout', function () {
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