<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.

$hum = $_GET["humedad"]; // el dato de humedad que se recibe aquí con GET denominado humedad, es enviado como parametro en la solicitud que realiza la tarjeta microcontrolada
$temp = $_GET["temperatura"]; // el dato de temperatura que se recibe aquí con GET denominado temperatura, es enviado como parametro en la solicitud que realiza la tarjeta microcontrolada

$ID_TARJ = $_GET["ID_TARJ"];

$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.

date_default_timezone_set('America/Bogota'); // esta línea es importante cuando el servidor es REMOTO y está ubicado en otros países como USA o Europa. Fija la hora de Colombia para que grabe correctamente el dato de fecha y hora con CURDATE y CURTIME, en la base de datos.

//$fecha = date("Y-m-d");
//$hora = date("h:i:s");

$sql1 = "INSERT into datos_medidos (ID_TARJ, temperatura, humedad, fecha, hora) VALUES ('$ID_TARJ', '$temp', '$hum', CURDATE(), CURTIME())"; // Aquí se ingresa el valor recibido a la base de datos.
echo "sql1...".$sql1; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php, en caso de algún error.
$result1 = $mysqli->query($sql1);
echo "result es...".$result1; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.

?>
