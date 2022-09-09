<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.

// LAs siguientes son líneas de código HTML simple, para crear una página web
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title> Sectores de medicion
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
           <h1> <font color=white>Sectores de Medicion</font></h1>
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
            <b>Ubicacion</b>
         </td>
          <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Ir</b>
         </td>
 	     </tr>

<?php

$sql1 = "SELECT * from ubicacion order by Id ASC"; // Aquí se ingresa el valor recibido a la base de datos


// la siguiente línea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexión a la base de datos mysqli
$result1 = $mysqli->query($sql1);


$contador = 0;     
while($row1 = $result1->fetch_array(MYSQLI_NUM))
{

 $ID_TARJ = $row1[0];
 $ubic = $row1[1];
  

 $contador++;
?>
    	 <tr>
             <td valign="top" align=center>
               <?php echo $contador; ?> 
             </td>
             <td valign="top" align=center>
               <?php echo $ID_TARJ; ?> 
             </td>
             <td valign="top" align=center>
               <?php echo $ubic; ?> 
             </td>
             <td valign="top" align=center> 
               <?php echo $ubic; ?>
             </td>
 	     </tr>

<?php
}

?>
</body>
    </table>
     
   </html>
 
     