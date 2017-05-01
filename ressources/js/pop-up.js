$(document).ready(function () {
    $('#show').click(function () {
        $('.content').css('opacity', '0.4');
        $('#modal').fadeIn(500);
    });
    $('.close').click(function () {
        $('#modal').fadeOut(500);
        $('.content').css('opacity', '1');
    });
});