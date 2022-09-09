<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.

$lon = $_GET["longitud"]; 
$lat = $_GET["latitud"]; 
$vel = $_GET["velocidad"]; 
$alt = $_GET["altitud"]; 
$ID_TARJ = $_GET["ID_TARJ"];

$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.

//CURDATE(),CURTIME()

date_default_timezone_set('America/Bogota'); // esta línea es importante cuando el servidor es REMOTO y está ubicado en otros países como USA o Europa. Fija la hora de Colombia para que grabe correctamente el dato de fecha y hora con CURDATE y CURTIME, en la base de datos.
// Para utilizar la hora con el time zone, hay que definir unas variables de fecha y hora con date, y reemplazarlas con CURDATE() y CURTIME()
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$sql1 = "INSERT into ubicaciones (id_tarj, latitud, longitud, fecha, hora, velocidad, altitud) VALUES ('$ID_TARJ', '$lat', '$lon', '$fecha', '$hora','$vel','$alt')"; 
echo "sql1...".$sql1; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php, en caso de algún error.
$result1 = $mysqli->query($sql1);
echo "result es...".$result1; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.

?>
