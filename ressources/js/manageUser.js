/**
 * Created by LOUISSTEIMBERG on 09/06/2017.
 */

$(document).ready(function () {


    $("#homeType").change(function(){
        var valueSelected = $('#homeType option:selected' ).attr("value");
        if(valueSelected == "house"){
            $("#buildingId").show();
        }else{
            $("#buildingId").hide();

        }

    });

    $("#homeId").change(function(){
        var valueSelected = $('#homeId option:selected' ).attr("value");
        $.each($(".roomSelector-deleteRoom"), function() {
            $room = $(this);
            if($room.attr("homeId") == valueSelected){
                $room.show();
            }else{
                $room.hide();
            }
        });

    });

    $("#homeId-addEffector").change(function(){
        var valueSelected = $('#homeId-addEffector option:selected' ).attr("value");
        console.log(valueSelected);
        $.each($(".roomSelector-addEffector"), function() {
            $room = $(this);
            if($room.attr("homeId") == valueSelected){
                $room.show();
            }else{
                $room.hide();
            }
        });

    });

    $("#homeId-deleteEffector").change(function(){
        var valueSelected = $('#homeId-deleteEffector option:selected' ).attr("value");
        console.log(valueSelected);
        $.each($(".roomSelector-deleteEffector"), function() {
            $room = $(this);
            if($room.attr("homeId") == valueSelected){
                $room.show();
            }else{
                $room.hide();
            }
        });

    });

    $("#roomId-deleteEffector").change(function(){
        var valueSelected = $('#roomId-deleteEffector option:selected' ).attr("value");
        console.log(valueSelected);
        $.each($(".effectorSelector-deleteEffector"), function() {
            $room = $(this);
            if($room.attr("roomId") == valueSelected){
                $room.show();
            }else{
                $room.hide();
            }
        });
    });

    $("#user-input-search").click(function(e){
        e.preventDefault();

        array = {
            'id' : $("#user-input-id").val(),
            'firstName' : $("#user-input-firstName").val(),
            'lastName' : $("#user-input-lastName").val(),
            'mail' : $("#user-input-mail").val()
        };

        $.post($(this).attr("action"), array ,
            (function(response){

                fullData = response.content;
                var i = 1;

                $("#users-displayer").html('');

                fullData.forEach(function(data){
                    $("#users-displayer").append(
                        '<tr class="user-display-column">'
                        + '<td class="text-left">' + data.id + '</td class="cell">'
                        + '<td class="text-left">' + data.firstName + '</th>'
                        + '<td class="text-left">' + data.lastName + '</th>'
                        + '<td class="text-left">' + data.mail + '</th>'
                    + '</tr>'
                    );
                });

            }) )
    });



});