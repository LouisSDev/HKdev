$(document).ready(function () {
    $('.scrolling').click(function () {
        var position = $(this).attr('href');
        var speed = 750;
        $('html, body').animate({scrollTop: $(position).offset().top},speed);
        return false;
    });
});
