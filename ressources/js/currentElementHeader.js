var current = window.location.href;
for(var i=1;i<=$("a").length;i++){
    var menu = $("a:nth-of-type("+i+")");
    if(menu.attr("href") === current){
        console.log(menu.attr('href'));
        menu.css('color', '#62bcda');
        break;
    }
}
