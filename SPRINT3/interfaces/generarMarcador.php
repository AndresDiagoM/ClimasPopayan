<?php
//echo '<script>alert ("'.$longitud.'");</script>';
echo "
<style>
#map {
 height: 400px;
 width: 50%;
}
</style>

    <br>
    
    <div id=\"map\"></div>
    <script>
      function initMap() {
        var latit=  $latitud ;
        var longi=  $longitud ;        
        var uluru = {lat: latit, lng: longi};
        
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyC7Pk3kExmQ_aVr1owRo-ScGefGRqF9kUw&callback=initMap\"> <!-- Se deben reemplazar las XXXX por la API Key de Google MAPS -->
    </script>";
?>

