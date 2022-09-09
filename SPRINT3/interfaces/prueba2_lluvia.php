<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.

// LAs siguientes son líneas de código HTML simple, para crear una página web
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title> ULTIMOS datos medidos de TEMPERATURA y HUMEDAD dispositivo IoT
		  </title>
      <meta http-equiv="refresh" content="15" />
    </head>
    <body>
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    	 <tr>
         <td valign="top" align=center width=80& colspan=8 bgcolor="#4DB9D1"">
           <img src="img/clima-tipos.jpg" width=800 height=250>
         </td>
 	     </tr>
 	     <tr>
         <td valign="top" align=center width=80& colspan=8 bgcolor="#4DB9D1"">
           <h1> <font color=white>Ultimos datos medidos sistema medicion clima</font></h1>
         </td>
 	     </tr>
    	 <tr>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>#</b>
         </td>
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
            <b>Temperatura</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Humedad</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Estado_Lluvia</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Ubicacion</b>
         </td>
 	     </tr>
<?php
// la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
$sql1 = "SELECT * from datos_medidos where (ID_TARJ=2 or ID_TARJ=1 or ID_TARJ=3 or ID_TARJ=4)  order by id DESC LIMIT 25"; // Aquí se ingresa el valor recibido a la base de datos

//$sql2 = "SELECT * from ubicacion where ID_TARJ=2 or ID_TARJ=1 or ID_TARJ=3 or ID_TARJ=4"; 
//$sql3 = "SELECT * from dato_lluvia where (ID_TARJ=2 or ID_TARJ=1 or ID_TARJ=3 or ID_TARJ=4)  order by id DESC LIMIT 12";



// la siguiente línea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexión a la base de datos mysqli
$result1 = $mysqli->query($sql1);


$contador = 0;   
$cont1=0;
$cont2=0;
$cont3=0;

while($row1 = $result1->fetch_array(MYSQLI_NUM))
{
    
    

 

 $ID_TARJ=$row1[1];
 //ultimos 3 datos de cada tajeta

 
    
    
    
    
//para tarjeta 1
if($cont1 < 3 and $ID_TARJ==1 ){
       // $ID_TARJ = $row1[1];
         $temp = $row1[2];
      $hum = $row1[3];
        $fecha = $row1[4];
         $hora = $row1[5];
           $estado_lluvia = $row1[6];
 
    if($estado_lluvia == 10){
        $estado_lluvia = "SIN LLUVIA";
    }
    if($estado_lluvia == 20){
        $estado_lluvia = "LLOVIZNANDO";
    }
    if($estado_lluvia == 30){
        $estado_lluvia = "LLUVIA";
    }
  
     $sql2 = "SELECT * from ubicacion where Id=$ID_TARJ"; 
    $result2 = $mysqli->query($sql2);
    $row2 = $result2->fetch_array(MYSQLI_NUM);
    $Ubicacion =$row2[1];
    ?>
    	 <tr>
         <td valign="top" align=center>
           <?php echo $contador; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $ID_TARJ; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $fecha; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $hora; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $temp." *C"; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $hum." %"; ?> 
         </td>
          <td valign="top" align=center>
           <?php echo $estado_lluvia; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $Ubicacion; ?> 
         </td>
 	     </tr>
<?php
    
        $cont1++;
    }


//para tarjeta 1
if($cont2 < 3 and $ID_TARJ==2 ){
       // $ID_TARJ = $row1[1];
         $temp = $row1[2];
      $hum = $row1[3];
        $fecha = $row1[4];
         $hora = $row1[5];
           $estado_lluvia = $row1[6];
 
    if($estado_lluvia == 10){
        $estado_lluvia = "SIN LLUVIA";
    }
    if($estado_lluvia == 20){
        $estado_lluvia = "LLOVIZNANDO";
    }
    if($estado_lluvia == 30){
        $estado_lluvia = "LLUVIA";
    }
  
     $sql2 = "SELECT * from ubicacion where Id=$ID_TARJ"; 
    $result2 = $mysqli->query($sql2);
    $row2 = $result2->fetch_array(MYSQLI_NUM);
    $Ubicacion =$row2[1];
    ?>
    	 <tr>
         <td valign="top" align=center>
           <?php echo $contador; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $ID_TARJ; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $fecha; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $hora; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $temp." *C"; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $hum." %"; ?> 
         </td>
          <td valign="top" align=center>
           <?php echo $estado_lluvia; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $Ubicacion; ?> 
         </td>
 	     </tr>
<?php
    
        $cont2++;
    }
  
  
  
  //para tarjeta 1
if($cont3 < 3 and $ID_TARJ==3 ){
       // $ID_TARJ = $row1[1];
         $temp = $row1[2];
      $hum = $row1[3];
        $fecha = $row1[4];
         $hora = $row1[5];
           $estado_lluvia = $row1[6];
 
    if($estado_lluvia == 10){
        $estado_lluvia = "SIN LLUVIA";
    }
    if($estado_lluvia == 20){
        $estado_lluvia = "LLOVIZNANDO";
    }
    if($estado_lluvia == 30){
        $estado_lluvia = "LLUVIA";
    }
  
     $sql2 = "SELECT * from ubicacion where Id=$ID_TARJ"; 
    $result2 = $mysqli->query($sql2);
    $row2 = $result2->fetch_array(MYSQLI_NUM);
    $Ubicacion =$row2[1];
    ?>
    	 <tr>
         <td valign="top" align=center>
           <?php echo $contador; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $ID_TARJ; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $fecha; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $hora; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $temp." *C"; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $hum." %"; ?> 
         </td>
          <td valign="top" align=center>
           <?php echo $estado_lluvia; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $Ubicacion; ?> 
         </td>
 	     </tr>
<?php
    
        $cont3++;
    }

   
    
    
    

 $contador++;

  
}

?>
     
   </html>