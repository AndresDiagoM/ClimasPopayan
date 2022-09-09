<?php
include "conexion.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.

$hum = $_GET["humedad"]; // el dato de humedad que se recibe aqu� con GET denominado humedad, es enviado como parametro en la solicitud que realiza la tarjeta microcontrolada
$temp = $_GET["temperatura"]; // el dato de temperatura que se recibe aqu� con GET denominado temperatura, es enviado como parametro en la solicitud que realiza la tarjeta microcontrolada

$ID_TARJ = $_GET["ID_TARJ"];
$estado_lluvia = $_GET["estado_lluvia"];
$lon = $_GET["longitud"]; 
$lat = $_GET["latitud"]; 
$vel = $_GET["velocidad"]; 
$alt = $_GET["altitud"];
$conex = $_GET["conexion"];


$mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.

date_default_timezone_set('America/Bogota'); // esta l�nea es importante cuando el servidor es REMOTO y est� ubicado en otros pa�ses como USA o Europa. Fija la hora de Colombia para que grabe correctamente el dato de fecha y hora con CURDATE y CURTIME, en la base de datos.

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$sql0 = "SELECT * from rango_lluvia ORDER BY id ASC";
$result0 = $mysqli->query($sql0);

$i = 0;
while($row0 = $result0->fetch_array(MYSQLI_NUM)){
   $rangos[$i] = $row0[1];
   $clasificaciones[$i] = $row0[2];
   $i++;
}

 if($estado_lluvia <= $rangos[0]){
        $estado_lluvia1 = $clasificaciones[0];
    }
    
 if(($estado_lluvia <= $rangos[1]) and ($estado_lluvia > $rangos[0])){
    $estado_lluvia1 = $clasificaciones[1];
}

 if($estado_lluvia > $rangos[1]){
    $estado_lluvia1 = $clasificaciones[2];
}

$sql1 = "SELECT * from ubicaciones where id_tarj='$ID_TARJ' order by id DESC LIMIT 1";
$result1 = $mysqli->query($sql1);
$row1 = $result1->fetch_array(MYSQLI_NUM);
$fecha_1 = $row1[4];
$hora_1 = $row1[5];
$hora11 = strtotime($hora_1);
$hora22 = strtotime($hora);

if(("$fecha_1"=="$fecha") and ( date("H:i",$hora11)==date("H:i",$hora22) )){
    $activo=1;
}else{
    $activo=0;
    $conex=0;
}


$sql1 = "INSERT into datos_medidos (ID_TARJ, temperatura, humedad, fecha, hora, estado_lluvia) VALUES ('$ID_TARJ', '$temp', '$hum', '$fecha', '$hora', '$estado_lluvia1')"; // Aqu� se ingresa el valor recibido a la base de datos.
     echo "sql1...".$sql1; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php,                     en caso de alg�n error.
     $result1 = $mysqli->query($sql1);
    


$sql2= "INSERT into ubicaciones (id_tarj, latitud, longitud, fecha, hora, velocidad, altitud) VALUES ('$ID_TARJ', '$lat', '$lon', '$fecha', '$hora','$vel','$alt')"; 
    echo "sql2...".$sql2; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa                      php, en caso de alg�n error.
    $result2 = $mysqli->query($sql2);
 if($ID_TARJ==3){
    $conex=1;
    $activo=1;
 }
 
    
$sql3 = "UPDATE ubicacion SET conexion='$conex', activo = '$activo' WHERE Id='$ID_TARJ';"; // Aqu� se ingresa el valor recibido 
     echo "sql3...".$sql3; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php,                     en caso de alg�n error.
     $result3 = $mysqli->query($sql3);
    
    //$sql3 = "UPDATE ubicacion SET latitud = '$lat', longitud = '$lon' WHERE Id = '$ID_TARJ';";
    //echo "sql3...".$sql3; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa                      php, en caso de alg�n error.
    //$result3 = $mysqli->query($sql3);

echo "result es...".$result1."-".$result2."-".$result2; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.

?>
