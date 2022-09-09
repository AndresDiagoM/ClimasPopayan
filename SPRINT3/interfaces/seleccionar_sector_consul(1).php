<?php

// PROGRAMA DE MENU CONSULTA
include "conexion.php";
                                                 

?>

       <head>
           <title> Seleccionar Sector
           <meta http-equiv="refresh" content="15" />
           </title>
        </head>
       <body>
           
           <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       <script>
            function alertaSinDatos(){
               Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'No se encuentran Datos en este Día'
                }).then(
                   // function() {
                    //    window.location = 'generar_grafico_fecha1.php'
                    //}
                );
            }
        </script>
           
        <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
    	   <tr>
           <td valign="top" align=left width=70%>
              <table width="100%" align=center border=0>
                  <tr>
                     <td valign="top" align=center width=80& colspan=8 bgcolor="#FFFFFF"">
                     <h1><font color=green>Climas Popayan </font></h1>
             	    </td>
             	    </td>
                </tr>
            	   <tr>
                  <td valign="top" align=center width=80& colspan=8 bgcolor="#FFFFFF"">
                     <img src="img/clima-tipos.jpg" border=0 width=1000 height=280> 
             	    </td>
                  
           	    </tr>
         	    </table>
         
	     </tr>
     </table>
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
 <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
            <?php
            include "menu_consul.php";
            ?>
            <tr valign="top">
              <td height="20%" align="left" 				
                  bgcolor="#FFFFFF" class="_espacio_celdas" 					
                  style="color: #FFFFFF; 
                  font-weight: bold">
                  <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Seleccionar Sector</h1></b></font>  
              </td>
              <td height="20%" align="right" 				
                  bgcolor="#FFFFFF" class="_espacio_celdas" 					
                  style="color: #FFFFFF; 
                  font-weight: bold">
                  <img src="img/Seleccionar_sector_consul.png" border=0 width=115 height=115>    
              </td>
            </tr>
          </table> 
 
 
 	    
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title>Seleccionar sector
		  </title>
    </head>
    <body>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       <script>
            function alertaSinDatos(){
               Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'No se encuentran Datos en este Día'
                }).then(
                   // function() {
                    //    window.location = 'generar_grafico_fecha1.php'
                    //}
                );
            }
        </script>
        
       <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
 	     <tr>
         <td valign="top" align=center width=80& colspan=8 bgcolor="#4DB9D1"">
           <h1> <font color=white>Últimos datos medidos Climas Popayan</font></h1>
           <?php  include "Tarea15.php";  ?>
         </td>
       </table>
        
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    	
 	     <tr>
         <td valign="top" align=center width=80& colspan=8 bgcolor="#4DB9D1"">
           <h1> <font color=white>Seleccionar sector</font></h1>
         </td>  
 	     </tr>
 	    
<?php
 if ((isset($_POST["enviado"])))
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
   {
       $location = $_POST["location"];  // en estas variables se almacenan los datos de fechas recibidos del formulario HTML inicial
       //echo("out-> $location");
       $location = strtoupper($location);
      
       $mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
       
         $sql5 = "SELECT * from ubicacion where location='$location'"; 
          $result5 = $mysqli->query($sql5);
          $row5 = $result5->fetch_array(MYSQLI_NUM);
          $latitud = $row5[2];
          $longitud = $row5[3];   
?>    	 
    	 <tr>	
      		<td bgcolor="#CCEECC" align=center colspan=8> 
			   	  <font FACE="TIMES NEW ROMAN" SIZE=5 color="#050202 "> <b>Ubicación:
			   	      <?php 
			   	  if($location == $row5[1]){
			   	       echo("$location");
			   	       include "generarMarcador.php";
			   	  }else{
			   	      echo("$location, No encontrada...");
			   	  }			   	  
		?>
		
		</b></font>  				 
	     
    	 <tr>
         <td valign="top" align=center bgcolor="#E1E1E1" colspan=8>   
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
            <b>LLuvia</b>
         </td>
                 
 	     </tr>
 	
<?php
// la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.

    $sql2 = "SELECT * from ubicacion where location='$location'"; 
    $result2 = $mysqli->query($sql2);
    $row2 = $result2->fetch_array(MYSQLI_NUM);
    $ID_TARJ =$row2[0];
    
    //echo($ID_TARJ);


$sql1 = "SELECT * from datos_medidos where ID_TARJ=$ID_TARJ order by id DESC LIMIT 10"; 
// la siguiente línea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexión a la base de datos mysqli
               $varAlerta = mysqli_query($mysqli,$sql1);
               $varAlerta = $varAlerta->fetch_array(MYSQLI_NUM);
                if (!$varAlerta) {
                    echo '<script> alertaSinDatos(); </script>';
                }
$result1 = $mysqli->query($sql1);
// la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos
// tenga algún registro resultante. Como la consulta arroja X resultados, se ejecutará X veces el siguiente ciclo while.
// el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, así sucesivamente
$contador = 0;
while($row1 = $result1->fetch_array(MYSQLI_NUM))
{
 $temp = $row1[2];
 $hum = $row1[3];
 $fecha = $row1[4];
 $hora = $row1[5];
 $ID_TARJ = $row1[1];
  $sql3 = "SELECT * from ubicacion where Id=$ID_TARJ"; 
    $result3 = $mysqli->query($sql3);
    $row3 = $result3->fetch_array(MYSQLI_NUM);
    $Ubicacion =$row3[1];
    $lluv =$row1[6];
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
           <?php echo $Ubicacion; ?> 
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
           <?php echo $lluv; ?> 
         </td>
          
 	     </tr>
<?php
}  // FIN DEL WHILE

echo' 
   <tr>	
        <form method=POST align=center action="seleccionar_sector_consul.php">
		<td bgcolor="#EEEEEE" align=center colspan=8> 
		<input type="submit" value="Volver" name="Volver">  
        </td>	
        </form>	
    </tr>';

    } // FIN DEL IF, si ya se han recibido las fechas del formulario
   }  // FIN DEL IF, si la variable enviado existe, que es cuando ya se envío el formulario
  else
    {
?> 
    
       <form method=POST action="seleccionar_sector_consul.php">            
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
 	     </tr>
 	     	     
    <?php
        $mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la
        $sql4 = "SELECT * from ubicacion order by Id ASC"; // Aquí se ingresa el valor recibido a la base de datos

        // la siguiente línea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexión a la base de datos mysqli
        $result4 = $mysqli->query($sql4);

        $contador3 = 0;     
        while($row4 = $result4->fetch_array(MYSQLI_NUM))
        {

        $ID_TARJ = $row4[0];
        $ubic = $row4[1];
        $contador3++;
    ?>
    	 <tr>
             <td valign="top" align=center>
               <?php echo $contador3; ?> 
             </td>
             <td valign="top" align=center>
               <?php echo $ID_TARJ; ?> 
             </td>
             <td valign="top" align=center>
               <?php echo $ubic; ?> 
             </td>
 	     </tr>

<?php
}
?>     
 	       	
 	     <tr>	
      		<td bgcolor="#EEEEEE" align=center > 
			   	  <font FACE="arial" SIZE=2 color=black> <b>Seleccionar sector: </b></font>  
				  </td>					 
          <td bgcolor="#EEEEEE" align=center colspan=3> 
            <select name=location required> 
              <?php 	
              //echo "hola";
              $sql_loca = "SELECT * from ubicacion order by id ASC";
              $result_loca = $mysqli->query($sql_loca);
              while($row_loca = $result_loca->fetch_array(MYSQLI_NUM))
                {
                  $location_1 = $row_loca[0];
                  $location_2 = $row_loca[1];
                  //$desc_tipo_usuario_con = $row6[1];
                  //echo "hola";
              ?>                  
                <option name="location" value="<?php echo $location_2; ?>"> <?php echo $location_2; ?></option>  
              <?php
                }
              ?>           
            </select>
          </td>			     
	     </tr>  
         <tr>	
			<td bgcolor="#EEEEEE" align=center colspan=3> 
			    <input type="hidden" name="enviado" value="S1">  
			    <input type="submit" fontsize=6 src="search.png" value="BUSCAR"  name="Actualizar" style='width:100px; height:32px' >  
          </td>	
	     </tr>	     
      </form>	  

<?php
    } 
?>    
            
       </table>
     </body>
   </html>
