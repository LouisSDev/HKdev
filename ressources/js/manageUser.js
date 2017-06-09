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


});