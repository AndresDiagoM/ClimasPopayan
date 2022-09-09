<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 50%;
       }
    </style>
  </head>
  <body>
<?php
include "conexion.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
$sqlubi = "SELECT * from ubicaciones order by id"; //CONSULTA LA ULTIMA UBICACION AGREGADA A LA TABLA UBICACIONES
$resultubi = $mysqli->query($sqlubi);
$rowubi = $resultubi->fetch_array(MYSQLI_NUM);
$latitud = $rowubi[1];
$longitud = $rowubi[2];

?>

    <h3>My Google Maps</h3>
    <div id="map"></div>
    <script>
      function initMap() {
        var latit= <?php echo $latitud ?>;
        var longi= <?php echo $longitud ?>;
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
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7Pk3kExmQ_aVr1owRo-ScGefGRqF9kUw&callback=initMap"> <!-- Se deben reemplazar las XXXX por la API Key de Google MAPS -->
    </script>
  </body>
</html>
