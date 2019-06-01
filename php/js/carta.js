$(document).ready( function () {
    $('.tabs').find('a').click( function (e) {
        var theFilter = $(this).data('filter');

        $('.tabs').find('a').removeClass('active');
        $(this).addClass('active');

        $('.portfolio').find('li').show(); $('.portfolio').find('li').not(theFilter).hide();

    });
});