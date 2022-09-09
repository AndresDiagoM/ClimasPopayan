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
    <title> Datos Promedios por Rango de Días </title>
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                  <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Datos Promedios por Rangos de Días</h1></b></font>  
              </td>
              <td height="20%" align="right" 				
                  bgcolor="#FFFFFF" class="_espacio_celdas" 					
                  style="color: #FFFFFF; 
                  font-weight: bold">
                  <img src="img/rango_dias.png" border=0 width=115 height=115>    
              </td>
            </tr>
          </table>

      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    	 
<?php

 if ((isset($_POST["enviado"])))
   {
           
  
        $fecha_ini = $_POST["fecha_ini"];  // en estas variables se almacenan los datos de fechas recibidos del formulario HTML inicial
       $fecha_fin= $_POST["fecha_fin"];
   $fecha_ini = $_POST["fecha_ini"];
    $med = $_POST["medida"];
    
    
    $aux1= substr($fecha_ini, -5,2);
     $aux2= substr($fecha_fin, -5,2);
      $aux3= substr($fecha_ini, -10,4);
       $aux4= substr($fecha_fin, -10,4);
    
       if( ($aux1 != $aux2) or ($aux3 != $aux4)){
      
       echo  sweet_alert(1);
       
       
                  
 echo '
      <tr>	
        <form method=POST action="generar_grafico_fecha_mes.php">
				  <td bgcolor="#EEEEEE" align=center colspan=6> 
				    <input type="submit" value="Volver" name="Volver">  
          </td>	
        </form>	
       </tr>';
 

  

       
       
          
      }else{

   $enviado = $_POST["enviado"];
   
   
    

  
        
      
   
   
   if ($enviado == "S1")
    {
    
       
       
       if($med == 'temperatura'){
           $med1=$med.'  (°C)';
       }
       if($med == 'humedad'){
           $med1=$med.'  (%)';
       }
       
       $ubi = $_POST["ubicacion"];
       
       
  
      
   
    
     
       
       
       
       
       
       $sq0 = "SELECT location  FROM ubicacion WHERE id ='$ubi'";
       $result0 = $mysqli->query($sq0);
       $UBI = $result0->fetch_array(MYSQLI_NUM);
      

       include ("conexion.php");
       $mysqli = new mysqli($host, $user, $pw, $db);
       
       
         $sql = "SELECT ROUND(AVG($med),2) as count FROM datos_medidos WHERE ((fecha>='$fecha_ini' and fecha <='$fecha_fin') AND ID_TARJ='$ubi') GROUP BY DAY(fecha) ORDER BY fecha;";
           $sql1="SELECT DISTINCT DAY(fecha)   from datos_medidos  WHERE (fecha>='$fecha_ini' and fecha <='$fecha_fin') ORDER BY DAY(fecha) ;";
           
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
            type: 'line'
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
                text: '<?php echo $med1?>',
            }
        },
        series: [{
            name: 'Día',
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
        <form method=POST action="generar_grafico_fecha_mes.php">
				  <td bgcolor="#EEEEEE" align=center colspan=6> 
				    <input type="submit" value="Volver" name="Volver">  
          </td>	
        </form>	
       </tr>';
 

    } }// FIN DEL IF, si ya se han recibido las fechas del formulario
   }  // FIN DEL IF, si la variable enviado existe, que es cuando ya se env�o el formulario
 else{
     table();
?>    
     	  

<?php
 }
 
 
 
 

 
    
    function sweet_alert($aux){
           if($aux=1){
               $alerta="<script> Swal.fire(
                  'Consulta Erronea!',
                  'Fechas deben ser del mismo mes y año',
                  'warning'
                ) </script>";
           }
           return $alerta;
       }
       
?>    


      
      
     </body>
   </html>