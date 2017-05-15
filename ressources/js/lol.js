$(document).ready(function () {
    $('#on').hide();
    $('#off').click(function() {
        $('#off').hide();
        $('#on').show();
    });
    $('#on').click(function() {
        $('#on').hide();
        $('#off').show();
    });
});
