<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 500px;
        width: 100%;
       }
    </style>
  </head>
  <body>
        <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    	 <tr>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Id de la Tarjeta</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Fecha</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Hora</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>latitud</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Longitud</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Altitud</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Velocidad</b>
         </td>
 	     </tr>
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
           $fecha[$i] = $rowubi[4];
           $hora[$i] = $rowubi[5];
           $ID_TARJ1 = $rowubi[3];
            
           $fecha1 = $rowubi[4];
           $hora1 = $rowubi[5];
           $latitud1 = $rowubi[1];
           $longitud1 = $rowubi[2];
           $altitud1 = $rowubi[6];
           $velocidad1 = $rowubi[7];
           $i++;
           ?>
            	 <tr>
                 <td valign="top" align=center>
                   <?php echo $ID_TARJ1; ?> 
                 </td>
                 <td valign="top" align=center>
                   <?php echo $fecha1 ; ?> 
                 </td>
                 <td valign="top" align=center>
                   <?php echo $hora1; ?> 
                 </td>
                 <td valign="top" align=center>
                   <?php echo $latitud1; ?> 
                 </td>
                 <td valign="top" align=center>
                   <?php echo $longitud1; ?> 
                 </td>
                 <td valign="top" align=center>
                   <?php echo $altitud1; ?> 
                 </td>
                 <td valign="top" align=center>
                   <?php echo $velocidad1; ?> 
                 </td>
        
         	     </tr>
<?php
}
}
?>
    <h3 align="Center" >ULTIMAS UBICACIONES REGISTRADAS POR EL GPS (MAPA Y TABLA)</h3>
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

        // LAS UBICACIONES LAS LOCALIZA UTILIZANDO UN ICONO DEFINIDO (CUADRO AZUL), UBICADO EN LA SUBCARPETA ICONS, DENOMINADO ubicacion.png

        var myicons = 'http://climaspopayan.online/PRACTICA_GUIADA_2/sprint2/adicional1/icons/';
        var icons = {
          ubicacion: {
            icon: myicons + 'ubicacion.png'
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
  </body>
</html>