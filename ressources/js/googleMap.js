function myMap() {
    var center= new google.maps.LatLng(48.845416, 2.328119);
    var mapCanvas = document.getElementById("googleMap");
    var mapOptions = {center: center, zoom: 17};
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({position: center});
    marker.setMap(map);
}