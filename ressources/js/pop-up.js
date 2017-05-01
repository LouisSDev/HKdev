$(document).ready(function () {
    $('#show').click(function () {
        $('.content').css('opacity', '0.4');
        $('#modal').fadeIn(2000);
    });
    $('.close').click(function () {
        $('#modal').fadeOut(2000);
        $('.content').css('opacity', '1');
    });
});