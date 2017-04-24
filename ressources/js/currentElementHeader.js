var menu = $("a");
menu.attr('class', 'current_element');
console.log(menu.length);


/*var current = window.location.href;
for(i=1;i<=$("a").length;i++){
    var menu = $("a:nth-of-type(1)");
    if(menu.attr("href") === current){
        menu.attr("class", "current_element");
    }
    else if (menu.attr("href") !== current){
        menu.removeAttr("class");
    }
}
*/