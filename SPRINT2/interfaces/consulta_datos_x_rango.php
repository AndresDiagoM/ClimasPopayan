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
                  <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Agregar Tarjeta</h1></b></font>  
              </td>
              <td height="20%" align="right" 				
                  bgcolor="#FFFFFF" class="_espacio_celdas" 					
                  style="color: #FFFFFF; 
                  font-weight: bold">
                  <img src="img/add3.jpg" border=0 width=115 height=115>    
              </td>
            </tr>
          </table>
      
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">    	 

<?php
if ((isset($_POST["enviado"])))
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
    {
       $fecha_ini = $_POST["fecha_ini"];  // en estas variables se almacenan los datos de fechas recibidos del formulario HTML inicial
       $fecha_fin = $_POST["fecha_fin"];
       $resul_fechas = $_POST["resul_fechas"];
       $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
?>
    </table>
    <table width="80%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
    	 <tr>
         <td valign="top" align=center bgcolor="#E1E1E1" colspan=6>
            <b>Rango de fechas consultado: desde <?php echo $fecha_ini; ?> hasta <?php echo $fecha_fin; ?></b>
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
 	     </tr>

<?php
    $mysqli = new mysqli($host, $user, $pw, $db);
    $id_usuario1 = $_SESSION["id_usuario"];
    $sqlusu1 = "SELECT * from usuarios where id='$id_usuario1'"; //CONSULTA EL ID TARJETA DEL USUARIO LOGUEADO
    $resultusu1 = $mysqli->query($sqlusu1);
    $rowusu1 = $resultusu1->fetch_array(MYSQLI_NUM);
    $id_tarjeta= $rowusu1[8];

    // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
    $sql1 = "SELECT * from datos_medidos where ID_TARJ='$id_tarjeta' and fecha >= '$fecha_ini' and fecha <= '$fecha_fin' order by fecha DESC LIMIT $resul_fechas"; 
    
    $result1 = $mysqli->query($sql1); // se ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
    // la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos tenga alg�n registro resultante. Como la consulta arroja X resultados, se ejecutar� X veces el siguiente ciclo while.
    // el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, as� sucesivamente
    $contador = 0;
    while($row1 = $result1->fetch_array(MYSQLI_NUM))
    {
      $temp = $row1[2];
      $hum = $row1[3];
      $fecha = $row1[4];
      $hora = $row1[5];
      $contador++;
?>
    	 <tr>
         <td valign="top" align=center>
           <?php echo $contador; ?> 
         </td>
         <td valign="top" align=center>
           <?php echo $id_tarjeta; ?> 
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
 	     </tr>
<?php
    }  // FIN DEL WHILE
 echo '
      <tr>	
        <form method=POST action="consulta_datos_x_rango.php">
				  <td bgcolor="#EEEEEE" align=center colspan=6> 
				    <input type="submit" value="Volver" name="Volver">  
          </td>	
        </form>	
       </tr>';

    } // FIN DEL IF, si ya se han recibido las fechas del formulario

      if ($enviado == "S2")
      {
        $temp_ini = $_POST["temp_ini"];  // en estas variables se almacenan los datos de fechas recibidos del formulario HTML inicial
        $temp_fin = $_POST["temp_fin"];
        $resul_temp = $_POST["resul_temp"];
        $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
  ?>
      </table>
      <table width="80%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
        <tr>
          <td valign="top" align=center bgcolor="#E1E1E1" colspan=6>
              <b>Rango de temperaturas consultado: desde <?php echo $temp_ini; ?> hasta <?php echo $temp_fin; " °C"?></b>
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
        </tr>

  <?php
      $mysqli = new mysqli($host, $user, $pw, $db);
      $id_usuario1 = $_SESSION["id_usuario"];
      $sqlusu1 = "SELECT * from usuarios where id='$id_usuario1'"; //CONSULTA EL ID TARJETA DEL USUARIO LOGUEADO
      $resultusu1 = $mysqli->query($sqlusu1);
      $rowusu1 = $resultusu1->fetch_array(MYSQLI_NUM);
      $id_tarjeta= $rowusu1[8];

      // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
      $sql1 = "SELECT * from datos_medidos where ID_TARJ='$id_tarjeta' and temperatura >= '$temp_ini' and temperatura <= '$temp_fin' order by temperatura DESC LIMIT $resul_temp"; 
      
      $result1 = $mysqli->query($sql1); // se ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
      // la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos tenga alg�n registro resultante. Como la consulta arroja X resultados, se ejecutar� X veces el siguiente ciclo while.
      // el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, as� sucesivamente
      $contador = 0;
      while($row1 = $result1->fetch_array(MYSQLI_NUM))
      {
        $temp = $row1[2];
        $hum = $row1[3];
        $fecha = $row1[4];
        $hora = $row1[5];
        $contador++;
  ?>
        <tr>
          <td valign="top" align=center>
            <?php echo $contador; ?> 
          </td>
          <td valign="top" align=center>
            <?php echo $id_tarjeta; ?> 
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
        </tr>
  <?php
      }  // FIN DEL WHILE
  echo '
        <tr>	
          <form method=POST action="consulta_datos_x_rango.php">
            <td bgcolor="#EEEEEE" align=center colspan=6> 
              <input type="submit" value="Volver" name="Volver">  
            </td>	
          </form>	
        </tr>';

      } // FIN DEL IF, si ya se han recibido las fechas del formulario


  }  // FIN DEL IF, si la variable enviado existe, que es cuando ya se env�o el formulario
  else{
?>    
    </table>	
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
        <tr valign="top">
          <td height="20%" align="left" bgcolor="#FFFFFF" class="_espacio_celdas" style="color: #FFFFFF; font-weight: bold">
            <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Consulta datos medidos (por rango de fechas)</h1></b></font>  
          </td>
            <td height="20%" align="right" 				
                      bgcolor="#FFFFFF" class="_espacio_celdas" 					
                      style="color: #FFFFFF; 
                    font-weight: bold">
              <img src="img/consultar_datos_x_rango.jpg" border=0 width=115 height=115>    
            </td>
        </tr>
      </table>
    
    <table width="70%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
     <form method=POST action="consulta_datos_x_rango.php">
 	     <tr>	
      		<td bgcolor="#CCEECC" align=center> 
			   	  <font FACE="arial" SIZE=2 color="#004400"> <b>Fecha Inicial:</b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="date" name="fecha_ini" value="" required>  
          </td>	
	     </tr>
 	     <tr>	
      		<td bgcolor="#CCEECC" align=center> 
			   	  <font FACE="arial" SIZE=2 color="#004400"> <b>Fecha Final:</b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="date" name="fecha_fin" value="" required>  
          </td>	
	     </tr>
       <tr>	
      		<td bgcolor="#CCEECC" align=center> 
			   	  <font FACE="arial" SIZE=2 color="#004400"> <b>Máximo de resultados:</b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="number" min="1" pattern="^[0-9]+" name="resul_fechas" value="" required>  
          </td>	
	     </tr>
       <tr>	
				  <td bgcolor="#EEEEEE" align=center colspan=2> 
				    <input type="hidden" name="enviado" value="S1">  
				    <input type="submit" value="Consultar" name="Consultar">  
          </td>	
	     </tr>
     </form>	 

      <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
        <tr valign="top">
          <td height="20%" align="left" bgcolor="#FFFFFF" class="_espacio_celdas" style="color: #FFFFFF; font-weight: bold">
            <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Consulta datos medidos (por rango de temperatura)</h1></b></font>  
          </td>
            <td height="20%" align="right" 				
                      bgcolor="#FFFFFF" class="_espacio_celdas" 					
                      style="color: #FFFFFF; 
                    font-weight: bold">
              <img src="img/termo2.webp" border=0 width=115 height=115>    
            </td>
        </tr>
      </table>

    <table width="70%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
     <form method=POST action="consulta_datos_x_rango.php">
 	     <tr>	
      		<td bgcolor="#CCEECC" align=center> 
			   	  <font FACE="arial" SIZE=2 color="#004400"> <b>Temperatura Inicial:</b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="number" name="temp_ini" value="" required>  
          </td>	
	     </tr>
 	     <tr>	
      		<td bgcolor="#CCEECC" align=center> 
			   	  <font FACE="arial" SIZE=2 color="#004400"> <b>Temperatura Final:</b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="number" name="temp_fin" value="" required>  
          </td>	
	     </tr>
       <tr>	
      		<td bgcolor="#CCEECC" align=center> 
			   	  <font FACE="arial" SIZE=2 color="#004400"> <b>Máximo de resultados:</b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="number" min="1" pattern="^[0-9]+" name="resul_temp" value="" required>  
          </td>	
	     </tr>
       <tr>	
				  <td bgcolor="#EEEEEE" align=center colspan=2> 
				    <input type="hidden" name="enviado" value="S2">  
				    <input type="submit" value="Consultar" name="Consultar">  
          </td>	
	     </tr>
      </form>	  
<?php
    } 
?>
      
     </table>
   </body>
</html>