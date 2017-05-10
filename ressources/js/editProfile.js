/**
 * Created by home on 10/05/2017.
 */
$(document).ready(function(){
    $("#email").click(function(){
        $(".mail").animate({
            height:"toggle"
        });
    });
    $("#mdp").click(function(){
        $(".mdp").animate({
            height:"toggle"
        });
    });
    $("#infoPers").click(function(){
        $(".infoPers").animate({
            height:"toggle"
        });
    });

});