$(document).ready(function () {
    $('.filter-button-dynamique').on('click', function () {
        var value = $(this).attr('data-filter');

        console.log(value);

        if(value === "all") {
            $('.filter').show('1000');
        } else {
            $('.filter').not(' .' + value).hide('3000');
            $('.filter').filter(' .' + value).show('3000');
        }
    });

    if ($('.filter-button-dynamique').removeClass('active')) {
        $(this).removeClass()
    }
});