$(document).ready(function () {
    $('#show').click(function () {
        $('.content').css('opacity', '0.4');
        $('#modal').fadeIn(500);
    });
    $('.close').click(function () {
        $('#modal').fadeOut(500);
        $('.content').css('opacity', '1');
    });
    $('#modal').css({
        'top': window.innerHeight/2-110,
        'left' : window.innerWidth/2-110}
    )
});