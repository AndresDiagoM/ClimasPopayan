<?php
include "conexion.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.

$coordena = $_POST["coordena"]; // toma los valores de coordenada
// que trae la latitud y longitud en la misma variable

// Y se separan en dos variables, Latitud y longitud, para poder ingresarlas a la tabla ubicaciones de la base de datos.

$ubicacion_coma= strpos($coordena,","); // Ubica la posici�n del caracter coma en la variable.
$ubicacion_coma2 = $ubicacion_coma +1;
$largo_cad = strlen($coordena); // determina el largo de toda la cadena.
$largo_lat = $largo_cad - $ubicacion_coma; 
$latitud = substr($coordena,0,$ubicacion_coma); // asigna la subcadena de coordenada que le corresponde a la latitud.
$longitud = substr($coordena,$ubicacion_coma2,$largo_lat); // asigna la subcadena de coordenada que le corresponde a la longitud.

$nombre = "Ubicacion XX1";

echo "lat...".$latitud;
echo "long...".$longitud;

$sql1 = "INSERT INTO puntos_tarjetas (latitud, longitud, nombre) values ('$latitud','$longitud','$nombre')"; // 
//echo "sql1...".$sql1; 
$result1 = $mysqli->query($sql1);
//echo "result1 es...".$result1;
if ($result1 == 1)
  {
             header('Location: programa3.php?mensaje=1');
  }
else
  {
             header('Location: programa3.php?mensaje=2');
  }
?>