function Map() {
    var mine= {
        center:new google.maps.LatLng(51.508742,-0.120850),
        zoom:5,
    };
    var map=new google.maps.Map(document.getElementById("googleMap"),mine);
}


src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfUVXK1gT4aQSnm4RZPoFHjc0MU-8U1vw&callback=myMap"