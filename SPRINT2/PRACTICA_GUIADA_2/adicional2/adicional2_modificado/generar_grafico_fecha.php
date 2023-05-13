<?php
include "conexion.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.

// LAs siguientes son l�neas de c�digo HTML simple, para crear una p�gina web
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title> Consulta temperatura promedio por día
		  </title>
    </head>
    <body>
   
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    	 <tr>
         <td valign="top" align=center width=80& colspan=6 bgcolor="#337DFF"">
         <img src="img/clima-tipos.jpg" width=800 height=250>
         </td>
 	     </tr>
 	     <tr>
         <td valign="top" align=center width=80& colspan=6 bgcolor="#337DFF"">
           <h1> <font color=white>CONSULTA DE TEMPERATURA PROMEDIO POR DIAS</font></h1>
         </td>
 	     </tr>
<?php

 if ((isset($_POST["enviado"])))
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
    {
       $fecha_ini = $_POST["fecha_ini"];  // en estas variables se almacenan los datos de fechas recibidos del formulario HTML inicial
      
       

       include ("conexion.php");
       $mysqli = new mysqli($host, $user, $pw, $db);
       
         $sql = "SELECT AVG(temperatura) as count FROM datos_medidos WHERE fecha='$fecha_ini'
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
            text: ''
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
                text: 'Temperatura °C'
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
        <form method=POST action="generar_grafico_fecha.php">
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
     <form method=POST action="generar_grafico_fecha.php">
 	     <tr>	
      		<td bgcolor="#CCEECC" align=center> 
			   	  <font FACE="arial" SIZE=2 color="#000044"> <b>Ingrese Fecha:</b></font>  
				  </td>	
				  <td bgcolor="#EEEEEE" align=center> 
				    <input type="date" name="fecha_ini" value="" required>  
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