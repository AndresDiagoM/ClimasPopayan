<?php

// PROGRAMA DE MENU ADMINISTRADOR
include "conexion.php";
$mysqli = new mysqli($host, $user, $pw, $db);
                                                 
session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: index.php?mensaje=3');
    }
else
    {      
        $mysqli = new mysqli($host, $user, $pw, $db);
  	    $sqlusu = "SELECT * from tipo_usuario where id='1'"; //CONSULTA EL TIPO DE USUARIO CON ID=1, ADMINISTRADOR
        $resultusu = $mysqli->query($sqlusu);
        $rowusu = $resultusu->fetch_array(MYSQLI_NUM);
  	    $desc_tipo_usuario = $rowusu[1];
        if ($_SESSION["tipo_usuario"] != $desc_tipo_usuario)
          header('Location: index.php?mensaje=4');
    }

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>     
      <head>	
      <title> Datos Medidos</title>
	    </head>
	<body>	
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
    	   <tr>
           <td valign="top" align=left width=70%>
              <table width="100%" align=center border=0>
            	   <tr>
                  <td valign="top" align=center width=30%>
                     <img src="img/clima-tipos.jpg" border=0 width=350 height=80> 
             	    </td>
                  <td valign="top" align=center width=60%>
                     <h1><font color="0417B6">Climas Popayan</font></h1>
             	    </td>
           	    </tr>
         	    </table>
           </td>
           <td valign="top" align=right>
              <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php  echo "Nombre Usuario</u>:   ".$_SESSION["nombre_usuario"];?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php  echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </b></font><br>  
              <font FACE="arial" SIZE=2 color="#00FFFF"> <b><u> <a href="cerrar_sesion.php"> Cerrar Sesion </a></u></b></font>  

           </td>
	     </tr>
      </table> 	
      <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
      <?php
      include "menu_admin.php";
      ?>
            <tr valign="top">
              <td height="20%" align="left" 				
                  bgcolor="#FFFFFF" class="_espacio_celdas" 					
                  style="color: #FFFFFF; 
                  font-weight: bold">
                  <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Datos Medidos</h1></b></font>  
              </td>
              <td height="20%" align="right" 				
                  bgcolor="#FFFFFF" class="_espacio_celdas" 					
                  style="color: #FFFFFF; 
                  font-weight: bold">
                  <img src="img/datos_medidos.jpg" border=0 width=115 height=115>    
              </td>
            </tr>
          </table>
        <table width="100%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">          
          <tr>
            <td valign="top" align=center width=80& colspan=8 bgcolor="white"">              
              <?php  include "Tarea15.php";  ?>
            </td>
          </tr>
        </table>
      <table width="100%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
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
         
 	     </tr>
<?php
// la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
$sql4 = "SELECT * from ubicacion where Id";
$result4 = $mysqli->query($sql4);
while($row4 = $result4->fetch_array(MYSQLI_NUM)){
        $sql1 = "SELECT * from datos_medidos where ID_TARJ=$row4[0] order by id DESC LIMIT 3";
        $result1 = $mysqli->query($sql1);
            
        $result1 = $mysqli->query($sql1);
            $contador = 0;     
            while($row1 = $result1->fetch_array(MYSQLI_NUM))
            {
            
             $ID_TARJ = $row1[1];
             $temp = $row1[2];
             $hum = $row1[3];
             $fecha = $row1[4];
             $hora = $row1[5];
             $estado_lluvia = $row1[6];             
              
            
                $sql2 = "SELECT * from ubicacion where Id=$ID_TARJ"; 
                $result2 = $mysqli->query($sql2);
                $row2 = $result2->fetch_array(MYSQLI_NUM);
                $Ubicacion =$row2[1];
                           
             $contador++;
                echo "
                	 <tr>
                     <td valign=\"top\" align=center>
                         $contador
                     </td>
                     <td valign=\"top\" align=center>
                          $ID_TARJ
                     </td>
                     <td valign=\"top\" align=center>
                       $Ubicacion 
                     </td>
                     <td valign=\"top\" align=center>
                          $fecha
                     </td>
                     <td valign=\"top\" align=center>
                           $hora
                     </td>
                     <td valign=\"top\" align=center>
                        $temp *C 
                     </td>
                     <td valign=\"top\" align=center>
                        $hum %
                     </td>
                     <td valign=\"top\" align=center>
                        $estado_lluvia 
                     </td>
                     
             	     </tr>";
            }
}
?>
       </table>
      <br><br><hr>
  </body>     
</html>