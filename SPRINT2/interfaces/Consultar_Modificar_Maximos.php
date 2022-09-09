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
      <title> Consultar y Modificar datos Maximos
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
                  <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Consultar y Modificar Datos Maximos</h1></b></font>  
              </td>
              <td height="20%" align="right" 				
                  bgcolor="#FFFFFF" class="_espacio_celdas" 					
                  style="color: #FFFFFF; 
                  font-weight: bold">
                 <img src="img/Consultar_modificar_maximos.png" border=0 width=115 height=115>   
              </td>
            </tr>
          </table>
      
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">


  <html>
    <head>
      <title> Consultar y Modificar Datos Maximos
		  </title>
    </head>
    <body>
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
 	     <tr>
         <td valign="top" align=center width=80& colspan=6 bgcolor="#4DB9D1"">
           <h1> <font color=white>Consultar y Modificar Datos Maximos</font></h1>
         </td>
 	     </tr>
<?php

 if ((isset($_POST["enviado"])))  // Ingresa a este if si el formulario ha sido enviado..., al ingresar actualiza los datos ingresados en el formulario, en la base de datos.
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
    {
          $temp_max = $_POST["temp_max"];  // en estas variables se almacenan los datos de fechas recibidos del formulario HTML inicial
          $hum_max = $_POST["hum_max"];
          $mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
          // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. 
          // se actualiza la tabla de valores máximos
          $sql1 = "UPDATE datos_maximos set maximo='$temp_max' where id=1";  
          //echo "sql1...".$sql1;
          // la siguiente línea ejecuta la consulta guardada en la variable sql1, con ayuda del objeto de conexión a la base de datos mysqli
          $result1 = $mysqli->query($sql1);

          $sql2 = "UPDATE datos_maximos set maximo='$hum_max' where id=2"; 
          // la siguiente línea ejecuta la consulta guardada en la variable sql1, con ayuda del objeto de conexión a la base de datos mysqli
          //echo "sql2...".$sql2;
          $result2 = $mysqli->query($sql2);

          if (($result1 == 1)&&($result2 == 1))
             $mensaje = "Datos actualizados correctamente";
          else
             $mensaje = "Inconveniente actualizando datos";
   
          //header('Location: programa4.php?mensaje='.$mensaje);

    } // FIN DEL IF, si ya se han recibido los datos del formulario
   }  // FIN DEL IF, si la variable enviado existe, que es cuando ya se envío el formulario
  
// AQUI CONSULTA LOS VALORES ACTUALES DE HUMEDAD y TEMPERATURA, PARA PRESENTARLOS EN EL FORMULARIO

// CONSULTA TEMPERATURA MAXIMA
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
$sql1 = "SELECT * from datos_maximos where id=1"; 
// la siguiente línea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexión a la base de datos mysqli
$result1 = $mysqli->query($sql1);
$row1 = $result1->fetch_array(MYSQLI_NUM);
$temp_max = $row1[3];  

// CONSULTA HUMEDAD MAXIMA
$sql2 = "SELECT * from datos_maximos where id=2"; 
// la siguiente línea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexión a la base de datos mysqli
$result2 = $mysqli->query($sql2);
$row2 = $result2->fetch_array(MYSQLI_NUM);
$hum_max = $row2[3];  

if ((isset($_GET["mensaje"])))
   {
   $mensaje = $_GET["mensaje"];
 	 echo '<tr>	
      		<td bgcolor="#EEEEFF" align=center colspan=2> 
			   	  <font FACE="arial" SIZE=2 color="#000044"> <b>'.$mensaje.'</b></font>  
				  </td>	
	     </tr>';
   }
?>    

     <form method=POST action="Consultar_Modificar_Maximos.php">
 	     <tr>	
      		<td bgcolor="#CCEECC" align=center> 
			   	  <font FACE="arial" SIZE=2 color="#000044"> <b>Valor Máximo Temperatura: </b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="number" name="temp_max" value="<?php echo $temp_max; ?>" required>  
          </td>	
	     </tr>
 	     <tr>	
      		<td bgcolor="#CCEECC" align=center> 
			   	  <font FACE="arial" SIZE=2 color="#000044"> <b>Valor Máximo Humedad: </b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="number" name="hum_max" value="<?php echo $hum_max; ?>" required>  
          </td>	
	     </tr>
       <tr>	
				  <td bgcolor="#EEEEEE" align=center colspan=2> 
				    <input type="hidden" name="enviado" value="S1">  
				    <input type="submit" value="Actualizar" name="Actualizar">  
          </td>	
	     </tr>
      </form>	  

       </table>
     </body>
   </html>
   