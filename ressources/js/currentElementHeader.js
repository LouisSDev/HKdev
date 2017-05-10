$(document).ready(function () {
    var current = window.location.href;
    for(var i=0;i<$("nav > a").length;i++){
        var menu = $("nav > a")[i];
        if($(menu).attr("href") === current){
            $(menu).css('color', '#62bcda');
            break;
        }
    }
});
