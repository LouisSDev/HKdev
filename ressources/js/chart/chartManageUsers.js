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
        $roomsSelectors.each(
            function($room){

            });
    }

});
