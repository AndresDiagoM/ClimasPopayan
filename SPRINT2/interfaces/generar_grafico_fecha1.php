
   
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
    <title> Datos Promedios por Día </title>
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
                  <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Datos Promedios por Día</h1></b></font>  
              </td>
              <td height="20%" align="right" 				
                  bgcolor="#FFFFFF" class="_espacio_celdas" 					
                  style="color: #FFFFFF; 
                  font-weight: bold">
                  <img src="img/barras_avg2.png" border=0 width=115 height=115>    
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
       $med = $_POST["medida"];
       $ubi = $_POST["ubicacion"];
       
       $sq0 = "SELECT location  FROM ubicacion WHERE id ='$ubi'";
       $result0 = $mysqli->query($sq0);
       $UBI = $result0->fetch_array(MYSQLI_NUM);
      

       include ("conexion.php");
       $mysqli = new mysqli($host, $user, $pw, $db);
       
       
         $sql = "SELECT ROUND(AVG($med),2) as count FROM datos_medidos WHERE (fecha='$fecha_ini' AND ID_TARJ='$ubi')
                   GROUP BY HOUR(hora) ORDER BY hora";
           $sql1="SELECT DISTINCT hour(hora)   from datos_medidos  WHERE fecha = '$fecha_ini'
           ORDER BY HOUR(hora) ;";
           
         $viewer = mysqli_query($mysqli,$sql);
           $viewer  = mysqli_fetch_all($viewer,MYSQLI_ASSOC);
         $viewer = json_encode(array_column($viewer, 'count'),JSON_NUMERIC_CHECK);
          
           // $viewer1 = mysqli_query($mysqli,$sql1);
           $viewer1 = $mysqli->query($sql1);
           // $viewer1  = mysqli_fetch_all($viewer1 ,MYSQLI_ASSOC);
         // $viewer1 = json_encode(array_column($viewer1 , 'count'),JSON_NUMERIC_CHECK);
          
         
           // Los datos generados a traves del json_enconde les quedan como se presenta abajo en comentarios:
           //$viewer = "[8,5,5]";
           
         /* Getting demo_click table data */
           $con=0;
           while($row1 = $viewer1->fetch_array(MYSQLI_NUM))
           {
           
               
            
            $category[$con] = $row1[0];
               // $ejemplo = $row1[0];
               
               // echo $ejemplo;
              
               // echo "-";
               $con++;
           }
          
       
           ?>  
           
           <!DOCTYPE html>
<html>
<head>
	<title>HighChart</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>

<script type="text/javascript">

$(function () { 

    
    var data_viewer = <?php echo $viewer; ?>;

    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<?php echo 'Datos promedio de '.$med.' en '.$UBI[0] ?>'
        },
        xAxis: {
            categories: ['<?php 
                for ($i = 0; $i < $con; $i++) {
                echo $category[$i];?>','<?php
                }
                ?>']
        },
        yAxis: {
            title: {
                text: '<?php echo $med ?>',
            }
        },
        series: [{
            name: 'Hora (Fomarto 24H)',
            data: data_viewer
        }]
    });
});

</script>

<div class="container">
	<br/>
	<!-- <h2 class="text-center"></h2> -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <!-- <div class="panel-heading"></div> -->
                <td valign="top" align=center width=80& colspan=6 bgcolor="#337DFF"">
                <div class="panel-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>      


       
           <?php
 echo '
      <tr>	
        <form method=POST action="generar_grafico_fecha1.php">
				  <td bgcolor="#EEEEEE" align=center colspan=6> 
				    <input type="submit" value="Volver" name="Volver">  
          </td>	
        </form>	
       </tr>';
 

    } // FIN DEL IF, si ya se han recibido las fechas del formulario
   }  // FIN DEL IF, si la variable enviado existe, que es cuando ya se env�o el formulario
  else
    {
?>    
     <form method=POST action="generar_grafico_fecha1.php">
 	     <tr>	
      		<td bgcolor="#CCEECC" align=center> 
			   	  <font FACE="arial" SIZE=2 color="#000044"> <b>Ingrese Fecha:</b></font>  
			</td>	
		    <td bgcolor="#EEEEEE" align=center> 
				    <input type="date" name="fecha_ini" value="" required>  
            </td>	
	     </tr>
	     <tr>	
          	<td bgcolor="#A8DDA8" align=center> 
				  <font FACE="arial" SIZE=2 color="#004400"> <b>Medida:</b></font>  
				</td>
				<td bgcolor="#EEEEEE" align=center> 
			    <select name=medida required> 
                   <?php
                   $Medidas = array("temperatura","humedad");
                   $con = '0';
                   while($con < sizeof($Medidas)){
                   ?>   
                      <option value="<?php echo $Medidas[$con]; ?>"> <?php echo $Medidas[$con]; ?></option>  
                   <?php
                   $con++;
                    }
                   ?>           
                  </select>
				</td>	
	     </tr>
	     <tr>
			<td bgcolor="#A8DDA8" align=center> 
				  <font FACE="arial" SIZE=2 color="#004400"> <b>Ubicacion:</b></font>  
			</td>
			<td bgcolor="#EEEEEE" align=center> 
			   <select name=ubicacion required> 
               <?php 	
               $sql6 = "SELECT * from ubicacion  order by Id ASC";
               $result6 = $mysqli->query($sql6);
               while($row6 = $result6->fetch_array(MYSQLI_NUM))
                {
                  $ID = $row6[0];
                  $ID_TARJ = $row6[1];
               ?>   
                  <option value="<?php echo $ID; ?>"> <?php echo $ID_TARJ; ?></option>  
               <?php
                }
               ?>           
               </select>
			</td>	
		</tr>
 	  
       <tr>	
				  <td bgcolor="#EEEEEE" align=center colspan=2> 
				    <input type="hidden" name="enviado" value="S1">  
				    <input type="submit" value="Consultar" name="Consultar">  
          </td>	
	     </tr>
      </form>	  

<?php
    } 
?>    


      
      
     </body>
   </html>