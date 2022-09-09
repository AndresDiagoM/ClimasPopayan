  <style>
    #map {
    height: 400px;
    width: 50%;
    }
  </style>
 
    <div id="map"></div>
       <!-- <form method="POST" action="agregar_Tarjeta_map3a.php"> -->
        <b>Arrastre el marcador hasta la posicion en el mapa correcta y presione enviar, para grabar la posicion de la tarjeta.</b><br>
         <input type="text" id="coords" value="coords" name="coordena" />
        <!-- <input type="submit" /> -->
      <!-- </form> -->
    <script>
      var marker;          //variable del marcador
      var coords = {};    //coordenadas obtenidas con la geolocalizaci�n

      //Funcion principal
      initMap = function () 
      {

          //usamos la API para geolocalizar el usuario

      // Cuando no funcione geolocalizaci�n, se comentan las siguientes lineas y se asigna coordenadas fijas
      // Si funciona la geolocalizaci�n, se pueden descomentar las l�neas y utilizarla, sin asignar coordenadas fijas
      //        navigator.geolocation.getCurrentPosition(
      //          function (position){
      //            coords =  {
      //              lng: position.coords.longitude,
      //              lat: position.coords.latitude
      //            };
      //            setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
                  
                coords= {lat: 2.4400000, lng: -76.6100000};
                setMapa(coords); 
      //        },function(error){console.log(error);});
          
      }

      function setMapa (coords)
      {   
            //Se crea una nueva instancia del objeto mapa
            var map = new google.maps.Map(document.getElementById('map'),
            {
              zoom: 15,
              center:new google.maps.LatLng(coords.lat,coords.lng),
            });

            //Creamos el marcador en el mapa con sus propiedades
            //para nuestro obetivo tenemos que poner el atributo draggable en true
            //position pondremos las mismas coordenas que obtuvimos en la geolocalizaci�n
            marker = new google.maps.Marker({
              map: map,
              draggable: true,
              animation: google.maps.Animation.DROP,
              position: new google.maps.LatLng(coords.lat,coords.lng),

            });
            //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
            //cuando el usuario a soltado el marcador
            marker.addListener('click', toggleBounce);
            
            marker.addListener( 'dragend', function (event)
            {
              //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
              document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
            });
      }

      //callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
      function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
      }
      // Carga de la libreria de google maps 
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7Pk3kExmQ_aVr1owRo-ScGefGRqF9kUw&callback=initMap"></script> <!-- Se deben reemplazar las XXXX por la API Key de Google MAPS -->
  
     <?php
      if (isset($_GET["mensaje"]))
      {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){?>
		     <table>
  		     <tr>
             <td> </td>
             <td height="20%" align="left">
                  <table width=60% border=1>
                   <tr>
                    <?php 
                       if ($mensaje == 1)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Ubicacion creada correctamente.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Inconveniente al crear la ubicacion.";

             echo "</td></tr>
                  </table>
              </td>
    		     </tr>
          <table>";
            }
         }   
      ?>      
