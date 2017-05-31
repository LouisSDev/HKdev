
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

    $("#homeId").change(function(){
        var valueSelected = $('#homeId option:selected' ).attr("value");
        if(valueSelected == -1){
            $roomsDropdown.hide();
        }else{
            $roomsDropdown.show();
            $.each($roomsSelectors, function() {
                $room = $(this);
                if($room.attr("homeId") == valueSelected){
                    $room.show();
                }else{
                    $room.hide();
                }
            });
        }

    });

    var current = window.location.href;
    for(var i=0;i<$("nav > a").length;i++){
        var menu = $("nav > a")[i];
        if($(menu).attr("href") === current){
            $(menu).css('color', '#62bcda');
            break;
        }
    }

    $("#mdpTitle").click(function(){
        $(".mdp").slideToggle();
    });
    $("#infoTitle").click(function(){
        $(".infoPers").slideToggle();
    });
    $("#mailTitle").click(function () {
        $(".mail").slideToggle();
    });

    $(".effectorsContainer").hide();

    $(".loader").fadeOut(1000, function() {
        $(".content").fadeIn(500);
    });

    $('.effectors-input').hide();

    $('.bedroom,.kitchen,.bath,.living').hide();
    $('.iconBed').click(function(){
        $('.kitchen,.bath,.living').hide("slow");
        iconClick('bedroom', $(this));
    });
    $('.iconKitchen').click(function(){
        $('.bedroom,.bath,.living').hide("slow");
        iconClick('kitchen', $(this));
    });
    $('.iconBath').click(function(){
        $('.bedroom,.kitchen,.living').hide("slow");
        iconClick('bath', $(this));
    });
    $('.iconSofa').click(function(){
        $('.bedroom,.kitchen,.bath').hide("slow");
        iconClick('living', $(this));
    });

    $('.click-bedroom').click(function(e){
        roomClick($(this));
    });


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
    );

    $('.scrolling').click(function () {
        var position = $(this).attr('href');
        var speed = 750;
        $('html, body').animate({scrollTop: $(position).offset().top},speed);
        return false;
    });
});


function roomClick($clickedBlock){
    if($clickedBlock.attr("state") != "on") {
        $(".effectorsContainer").show();
        $('effectors-' + $clickedBlock.attr("roomid")).show();
        $clickedBlock.attr("on");
    }else{
        $(".effectorsContainer").hide();
        $('effectors-' + $clickedBlock.attr("roomid")).hide();
        $clickedBlock.attr("off");
    }
}

function iconClick(name, $actualElement){

    if($actualElement.attr("state") == "off"){
        $actualElement.attr("state", "on");
        $('.' +  name).show("slow");
    }else{
        $actualElement.attr("state", "off");
        $('.' + name).hide("slow");
    }
}


function myMap() {
    var center= new google.maps.LatLng(48.845416, 2.328119);
    var mapCanvas = document.getElementById("googleMap");
    var mapOptions = {center: center, zoom: 17};
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({position: center});
    marker.setMap(map);
}