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
      <title> Agregar Tarjeta
		  </title>
    </head>
    <body>
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       <script>
            function alerta(){
               Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Datos Incorrectos, DIGITE BIEN! y complete ambos campos'
                });
            }
        </script>
        
      <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
          <tr>
            <td valign="top" align=left width=70%>
                <table width="100%" align=center border=0>
                    <tr>
                      <td valign="top" align=center width=30%>
                         <img src="img/clima-tipos.jpg" border=0 width=350 height=80> 
                 	    </td>
                      <td valign="top" align=center width=60%>
                         <h1><font color="0417B6">Climas Popayan </font></h1>
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
                  <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Estado de Dispositivos de Medición</h1></b></font>  
              </td>
              <td height="20%" align="right" 				
                  bgcolor="#FFFFFF" class="_espacio_celdas" 					
                  style="color: #FFFFFF; 
                  font-weight: bold">
                  <img src="img/dispositivo.png" border=0 width=115 height=115>    
              </td>
            </tr>
          </table>
      
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">    	 
<?php

// PROGRAMA DE MENU CONSULTA
include "conexion.php";
                                                 

?>

       <head>
           <title> Estado de Dispositivos de Medición
           <meta http-equiv="refresh" content="15" />
           </title>
        </head>
       <body>
       
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">


 
 	    
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title> Estado de Dispositivos de Medición
		  </title>
      <meta http-equiv="refresh" content="15" />
    </head>
    <body>
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    	 
 	     <tr>
         <td valign="top" align=center width=80% colspan=9 bgcolor="#4DB9D1"">
           <h1> <font color=white>Estado de Dispositivos de Medición</font></h1>
         </td>
 	     </tr>
    	 <tr>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>#</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Id de la Tarjeta</b>
         </td>
         </td>
           <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Ubicacion</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Estado de conexion</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Activo/Inactivo</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Lugar de Medición</b>
         </td>

 	     </tr>
<?php
// la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.

// CONSULTA TEMPERATURA MAXIMA
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
$sql1 = "SELECT * from datos_maximos where id=1"; 
// la siguiente línea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexión a la base de datos mysqli
$result2 = $mysqli->query($sql1);
$row2 = $result2->fetch_array(MYSQLI_NUM);
$temp_max = $row2[3];  

// CONSULTA HUMEDAD MAXIMA
$sql3 = "SELECT * from datos_maximos where id=2"; 
// la siguiente línea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexión a la base de datos mysqli
$result3 = $mysqli->query($sql3);
$row3 = $result3->fetch_array(MYSQLI_NUM);
$hum_max = $row3[3];  

// ------------------------------------------------
$sql4 = "SELECT * from ubicacion where Id";
$result4 = $mysqli->query($sql4);
while($row4 = $result4->fetch_array(MYSQLI_NUM)){
        $sql1 = "SELECT * from ubicaciones where id_tarj=$row4[0] order by id DESC LIMIT 1;";
        $result1 = $mysqli->query($sql1);

            $contador = 0;     
            while($row1 = $result1->fetch_array(MYSQLI_NUM)){
            
                $latitud_now =$row1[1];
                
                $longitud_now =$row1[2]; 
                $ID_TARJ = $row1[3];
                
                
            
                $sql2 = "SELECT * from ubicacion where Id=$ID_TARJ"; 
                $result2 = $mysqli->query($sql2);
                $row2 = $result2->fetch_array(MYSQLI_NUM);
                $Ubicacion =$row2[1];
                $latitud =$row2[2];
                $longitud =$row2[3];
                $conexion =$row2[4];
                $estado =$row2[5];
                
                $diferencia = 0;
                $lugar =  distance($latitud, $longitud, $latitud_now, $longitud_now);
               
                if($lugar > 500){
                    $diferencia = 1;  
                }else{
                    $diferencia = 0;
                }
                
                 
                           
             $contador++;
             
             ?>
    	 <tr>
         <td valign="top" align=center>
           <?php echo $contador; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $ID_TARJ; ?> 
         </td>
         </td>
          <td valign="top" align=center>
           <?php echo $Ubicacion; ?> 
         </td>
         <td valign="top" align=center>
           <?php 
           if ($conexion == 0)
            {
           ?> 
              <img src="img/nowifi.png" width=80 height=80>           
           <?php 
            }
           if($conexion == 1){
            ?> 
              <img src="img/siwifi.png" width=80 height=80>           
           <?php 
            }
           ?> 
         </td>
         <td valign="top" align=center>
           <?php 
          if($estado == 0){
           ?> 
              <img src="img/inactivo.png" width=80 height=80>           
           <?php 
            }
           if($estado == 1){
            ?> 
              <img src="img/activo.png" width=80 height=80>           
           <?php 
            }
           ?>
         </td>  
         <td valign="top" align=center>
           <?php 
          if($diferencia == 1){
           ?> 
              <img src="img/no.png" width=80 height=80>           
           <?php 
            }
           if($diferencia == 0){
            ?> 
              <img src="img/hum_ok.jpg" width=80 height=80>           
           <?php 
            }
           ?> 
           
         </td>
         
         
          

 	     </tr>
<?php
                
            }
//}
// ---------------------------------------------------


}
?>
     </body>


</html>

 <?php
 function distance($lat1, $lon1, $lat2, $lon2) {
                 
                  $theta = $lon1 - $lon2;
                  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                  $dist = acos($dist);
                  $dist = rad2deg($dist);
                  $miles = $dist * 60 * 1.1515;
                  $unit = strtoupper($unit);
                  
                  return ($miles * 1.609344 * 1000);
                  }
?> 
      
     </table>
     
   </body>
   
   
</html>