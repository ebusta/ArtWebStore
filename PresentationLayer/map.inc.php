<?php

function createMap($lat, $long, $name){
    echo '<script>
      function initMap() {
        var ' . $name . ' = {lat: ' . $lat . ', lng: ' . $long . '};
        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 12,
          center: ' . $name . '
        });
        var marker = new google.maps.Marker({
          position: ' . $name . ',
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUS1jvym9S_MVcZrbaUGjjrPz_YRjgtoA&callback=initMap">
    </script>';
    
}

?>