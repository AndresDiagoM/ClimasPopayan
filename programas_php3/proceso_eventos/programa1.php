<?php
    include "conexion.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    
    $hum = $_GET["humedad"]; 
    $temp = $_GET["temperatura"]; 
    $ID_TARJ = $_GET["ID_TARJ"];
    $estado_lluvia= $_GET["estado_lluvia"];
    
    //echo "  se_recibe:".$estado_lluvia;
    
    $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
    
    $result4 = mysqli_query($mysqli, "SELECT * from rango_lluvia");
    $i=0;
    while($row4 = mysqli_fetch_array($result4)){
        $rangos[$i] = $row4['rango'];
        $clasificacion[$i] = $row4['clasificacion'];
        $i++;;
    }
   
    if( !$estado_lluvia==""){
      if($estado_lluvia<=$rangos[0]){
        $estado_lluvia1 = $clasificacion[0];
      }else if($estado_lluvia>$rangos[0] and $estado_lluvia<=$rangos[1]){
         $estado_lluvia1 = $clasificacion[1];
      }else if($estado_lluvia>$rangos[1]){
         $estado_lluvia1 = $clasificacion[2]; 
      }
    }else{
        $estado_lluvia1 = $clasificacion[0];
    }
 
    date_default_timezone_set('America/Bogota'); // esta l�nea es importante cuando el servidor es REMOTO y est� ubicado en otros pa�ses como USA o Europa. Fija la hora de Colombia para que grabe correctamente el dato de fecha y hora con CURDATE y CURTIME, en la base de datos.
    
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    
    $sql1 = "INSERT into datos_medidos (ID_TARJ, temperatura, humedad, fecha, hora, estado_lluvia) VALUES ('$ID_TARJ', '$temp', '$hum', '$fecha', '$hora', '$estado_lluvia1')"; // Aqu� se ingresa el valor recibido a la base de datos.
    echo "sql1...".$sql1; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php, en caso de alg�n error.
    $result1 = $mysqli->query($sql1);
    echo "result es...".$result1; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.
?>