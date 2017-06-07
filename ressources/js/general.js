
$(document).ready(function () {
    $switchOn = $('.switch-on');
    $switchOn.hide();
    $('.switch-off').click(function() {
        $(this).hide();
        $('#switch-on-' + $(this).attr('roomId')).show();
    });

    $switchOn.click(function() {
        $(this).hide();
        $('#switch-off-' + $(this).attr('roomId')).show();
    });

    $("#homeId").change(function(){
        var valueSelected = $('#homeId option:selected' ).attr("value");
        if(valueSelected === -1){
            $roomsDropdown.hide();
        }else{
            $roomsDropdown.show();
            $.each($roomsSelectors, function() {
                $room = $(this);
                if($room.attr("homeId") === valueSelected){
                    $room.show();
                }else{
                    $room.hide();
                }
            });
        }

    });

    $(".save-lum-effector").click(function(e){
        var type = 'Lumière',
            roomId = $(this).attr('roomId'),
            $effectorInput = $('#lum-eff-val-' + roomId),
            value = $effectorInput.val();
        saveNewEffectorSetup(type, roomId, value, null);

    });

    var current = window.location.href;
    for(var i=0;i<$("nav > a").length;i++){
        var menu = $("nav > a")[i];
        if($(menu).attr("href") === current){
            $(menu).css('color', '#62bcda');
            break;
        }
    }

    $("#passwordTitle").unbind("click").bind('click',function(){
        $(".mdp").slideToggle();
    });
    $("#infoTitle").unbind("click").bind('click',function(){
        $(".infoPers").slideToggle();
    });
    $("#mailTitle").unbind('click').bind('click',function () {
        $(".mail").slideToggle();
    });

    $(".toggleSensors").unbind("click").bind('click',function () {
        $(".effector-type").hide("slow");
       $(".sensor-type").slideToggle();
    });

    $(".toggleEffectors").unbind('click').bind('click',function () {
        $(".sensor-type").hide("slow");
       $(".effector-type").slideToggle();
    });

    $(".effectorsContainer").hide();

    $(".loader").fadeOut(1000, function() {
        $(".content").fadeIn(500);
    });

    $('.effectors-input').hide();

    $('.bedroom,.kitchen,.bath,.living').hide();
    $('.iconBed').unbind('click').bind('click',function(){
        $('.kitchen,.bath,.living').hide("slow");
        iconClick('bedroom', $(this));
    });
    $('.iconKitchen').unbind('click').bind('click',function(){
        $('.bedroom,.bath,.living').hide("slow");
        iconClick('kitchen', $(this));
    });
    $('.iconBath').unbind('click').bind('click',function(){
        $('.bedroom,.kitchen,.living').hide("slow");
        iconClick('bath', $(this));
    });
    $('.iconSofa').unbind('click').bind('click',function(){
        $('.bedroom,.kitchen,.bath').hide("slow");
        iconClick('living', $(this));
    });

    $('.click-room').unbind('click').bind('click', function (e) {
        roomClick($(this));
    });


    if (window.location.pathname.indexOf("connection")!== -1) {
        setTimeout(function () {
            $('.content').css('opacity', '0.4');
            $('#modal').fadeIn(500);
        }, 2000);
    }

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


    function roomClick($clickedBlock){
        if($clickedBlock.attr("state") != "on") {
            $(".effectorsContainer").show();
            $('.effectors-' + $clickedBlock.attr("roomid")).show();
            $clickedBlock.attr("state", "on");
        }else{
            $(".effectorsContainer").hide();
            $('.effectors-' + $clickedBlock.attr("roomid")).hide();
            $clickedBlock.attr("state", "off");
        }
    }

    function iconClick(name, $actualElement){

        if($actualElement.attr("state") != "on"){
            $('.my-rooms').attr("state", "off");
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

    function saveNewEffectorSetup(type, roomId, value, state) {
        $.post($('#body').attr('server_root') + '/api/edit/room', {
            'effectorType' : type,
            'roomId' : roomId,
            'value' : value,
            'state' : state
        });
    }

});