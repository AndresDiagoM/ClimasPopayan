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

   if ((isset($_POST["enviado"])))  // Ingresa a este if si el formulario ha sido enviado..., al ingresar actualiza los datos ingresados en el formulario, en la base de datos.
   {
       $enviado = $_POST["enviado"];
       
       if ($enviado == "S1")
        {
              $location = $_POST["location"];
              $Id = $_POST["Id"];              
              $coordena = $_POST["coordena"]; // toma los valores de coordenada
              // que trae la latitud y longitud en la misma variable

              // Y se separan en dos variables, Latitud y longitud, para poder ingresarlas a la tabla ubicaciones de la base de datos.
              $ubicacion_coma= strpos($coordena,","); // Ubica la posici�n del caracter coma en la variable.
              $ubicacion_coma2 = $ubicacion_coma +1;
              $largo_cad = strlen($coordena); // determina el largo de toda la cadena.
              $largo_lat = $largo_cad - $ubicacion_coma; 
              $latitud = substr($coordena,0,$ubicacion_coma); // asigna la subcadena de coordenada que le corresponde a la latitud.
              $longitud = substr($coordena,$ubicacion_coma2,$largo_lat);
              
              if($Id == 0  or $Id==" " or $location==" " or $coordena==""){
                  echo '<script> alerta(); </script>';
                  //echo '<script> alert("pp'.$location.'pp"); </script>';                  
              }else{
                  $mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la 
                  $sql1 = "INSERT INTO ubicacion (Id, location, latitud, longitud) VALUES ('$Id','$location','$latitud', '$longitud')";
                  $result1 = $mysqli->query($sql1);
                  
                  echo sweet_alert($result1);
              }
        } // FIN DEL IF, si ya se han recibido los datos del formulario
   }  // FIN DEL IF, si la variable enviado existe, que es cuando ya se envío el formulario
 

    if ((isset($_GET["mensaje"])))
       {
       $mensaje = $_GET["mensaje"];
     	 echo '<tr>	
          		<td bgcolor="#EEEEFF" align=center colspan=2> 
    			   	  <font FACE="arial" SIZE=2 color="#000044"> <b>'.$mensaje.'</b></font>  
    				  </td>	
    	     </tr>';
    }
       
       function sweet_alert($result1){
           if($result1==0){
               $alerta="
                    <script>
                        alert(' YA EXISTE ¡¡¡¡¡¡');
                    </script>
               ";
           }else{
               $alerta="<script> Swal.fire(
                  'Registro Exitoso!',
                  'Datos guardados correctamente!',
                  'success'
                ) </script>";
           }
           return $alerta;
       }
?>    

     <form method=POST action="Agregar_Tarjeta2.php">     	
 	     <tr>	
 	        <td bgcolor="#EEEEEE" align=center> 
			   	  <font FACE="arial" SIZE=2 color=black> 
			   	    <b>ID tarjeta: </b>
			   	  </font>  
			</td>	
		    <td bgcolor="#EEEEEE" align=center> 
				<input type="text" name="Id" value=" " required>  
            </td>	
            
      		<td bgcolor="#EEEEEE" align=center> 
			   	  <font FACE="arial" SIZE=2 color=black> 
			   	    <b>Ubicacion:  </b>
			   	  </font>  
			</td>	
			<td bgcolor="#EEEEEE" align=center> 
				<input type="text" name="location" value=" " required>  
            </td>	          
	     </tr>
	     
        <tr>
          <td bgcolor="#EEEEEE" align=center colspan=8> 
			<font FACE="TIMES NEW ROMAN" SIZE=5 color=black> 
                 <b>Ubicación:</b>
            </font>  
            <?php  include "agregar_Tarjeta_map2.php"; ?>
        </tr>
	     
         <tr>	
				  <td bgcolor="#EEEEEE" align=center colspan=9> 
				    <input type="hidden" name="enviado" value="S1">  
				    <input type="submit" value="Actualizar" name="Actualizar" style='width:100px; height:32px'>  
          </td>	
	     </tr>
	  </form>
      
     </table>
   </body>
</html>