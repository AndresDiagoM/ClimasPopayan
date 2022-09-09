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
$sqlubi = "SELECT * from ubicaciones order by id DESC LIMIT 20"; //CONSULTA LAS ULTIMAS 100 UBICACIONES DE LA TABLA DE LA BASE DE DATOS
$resultubi = $mysqli->query($sqlubi);
$i=0;
while($rowubi = $resultubi->fetch_array(MYSQLI_NUM))
{
   $latitud[$i] = $rowubi[1];
   $longitud[$i] = $rowubi[2];
   $fecha[$i] = $rowubi[4];
   $hora[$i] = $rowubi[5];
   $i++;
}   

?>
    <h3>ULTIMAS UBICACIONES REGISTRADAS</h3>
    <div id="map"></div>
    <script>
      var map;

      // ALMACENA EN VARIABLES LA UBICACION INICIAL Y FINAL

      var latit= <?php echo $latitud[0] ?>;
      var longi= <?php echo $longitud[0] ?>;
      var uluru = {lat: latit, lng: longi};

      var latitk= <?php echo $latitud[$i-1] ?>;
      var longik= <?php echo $longitud[$i-1] ?>;
      var uluruk = {lat: latitk, lng: longik};

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: uluru,
          mapTypeId: 'roadmap'
        });

      var infowindow = new google.maps.InfoWindow({
       content: 'Ubicaci&oacute;n Inicial, Lat: ' + <?php echo $latitud[0];?> + ', Lon: ' + <?php echo $longitud[0];?>,
       position: uluru
       });
       infowindow.open(map);

        // LAS UBICACIONES LAS LOCALIZA UTILIZANDO UN ICONO DEFINIDO (CUADRO AZUL), UBICADO EN LA SUBCARPETA ICONS, DENOMINADO ubicacion.png

        var myicons = '/PRACTICA_GUIADA_2/sprint2/adicional3/prog4_presenta_en_mapa_todas_las_ubicaciones_de_una_tabla/icons/';
        var icons = {
          ubicacion: {
            icon: myicons + 'gps.png'
          }
        };

        // GUARDA EN UN ARREGLO FEATURES LOS PUNTOS DE UBICACION
        var features = [
           <?php
             for ($k=0;$k<$i;$k++)
               {
           ?>    
           {
            position: new google.maps.LatLng(<?php echo $latitud[$k];?>, <?php echo $longitud[$k];?>),
            type: 'ubicacion'
           },
           <?php
              }
           ?>    
          {
            position: new google.maps.LatLng(<?php echo $latitud[$k-1];?>, <?php echo $longitud[$k-1];?>),
            type: 'ubicacion'
          }
        ];

        // CREA LOS MARCADORES Y LOS PRESENTA EN EL MAPA
        features.forEach(function(feature) {
          var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
          });
        });

      // PRESENTA TAMBIEN UN MENSAJE EMERGENTE PARA LA UBICACION INICIAL Y LA FINAL.

       var infowindow = new google.maps.InfoWindow({
       content: 'Ubicaci&oacute;n Final, Lat: ' + <?php echo $latitud[$k-1];?> + ', Lon: ' + <?php echo $longitud[$k-1];?>,
       position: uluruk
       });
       infowindow.open(map);

}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7Pk3kExmQ_aVr1owRo-ScGefGRqF9kUw&callback=initMap">  <!-- Se deben reemplazar las XXXX por la API Key de Google MAPS -->
    </script>
  </body>
</html>
