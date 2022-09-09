
    <style>
       #map {
        height: 500px;
        width: 100%;
       }
    </style>
 
      
<?php
  include "conexion.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.

  $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.

  $sql4 = "SELECT * from ubicacion where Id";
  $result4 = $mysqli->query($sql4);
  $i=0;
  while($row4 = $result4->fetch_array(MYSQLI_NUM)){
        $sql1 = "SELECT * from ubicaciones where ID_TARJ=$row4[0] order by id DESC LIMIT 3";
        $resultubi = $mysqli->query($sql1);
       
        while($rowubi = $resultubi->fetch_array(MYSQLI_NUM))
        {
           $latitud[$i] = $rowubi[1];
           $longitud[$i] = $rowubi[2];
           
           $ID_TAR[$i] = $rowubi[3];
           
           $latitud1 = $rowubi[1];
           $longitud1 = $rowubi[2];
        
           $i++;
        }
  }
?>
    
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
          center: {lat: 2.50158, lng: -76.5664},
          mapTypeId: 'roadmap'
        });
        
        
         <?php
             for ($k=0;$k<$i;$k++)
               {
           ?> 
          var infowindow = new google.maps.InfoWindow({
             content: 'ID de tarjeta #: '+'<?php echo $ID_TAR[$k];?>',
             position: {lat: <?php echo $latitud[$k];?>,
                        lng: <?php echo $longitud[$k];?>}
       });
       
       
        infowindow.open(map);
        
        <?php
         
              }
        ?> 
        
        // LAS UBICACIONES LAS LOCALIZA UTILIZANDO UN ICONO DEFINIDO (CUADRO AZUL), UBICADO EN LA SUBCARPETA ICONS, DENOMINADO ubicacion.png

        var myicons = '/img/';
        var icons = {
          ubicacion: {
            icon: myicons + 'gps2.png'
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
    }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7Pk3kExmQ_aVr1owRo-ScGefGRqF9kUw&callback=initMap">  <!-- Se deben reemplazar las XXXX por la API Key de Google MAPS -->
    </script>
