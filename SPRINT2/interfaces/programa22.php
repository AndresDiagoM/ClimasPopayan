<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.

// LAs siguientes son líneas de código HTML simple, para crear una página web
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
      
      
      
      <head>
		<style type="text/css">
			
			* {
				margin:0px;
				padding:0px;
			}
			
			#header {
				margin:auto;
				width:500px;
				font-family:Arial, Helvetica, sans-serif;
			}
			
			ul, ol {
				list-style:none;
			}
			
			.nav > li {
				float:left;
			}
			
			.nav li a {
				background-color:#000;
				color:#fff;
				text-decoration:none;
				padding:10px 12px;
				display:block;
			}
			
			.nav li a:hover {
				background-color:#434343;
			}
			
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
			}
			
			.nav li:hover > ul {
				display:block;
			}
			
			.nav li ul li {
				position:relative;
			}
			
			.nav li ul li ul {
				right:-140px;
				top:0px;
			}
			
		</style>
	</head>
	<body>
		<div id="header">
			<ul class="nav">
				<li><a href="">Inicio</a></li>
				<li><a href="">Opciones</a>
					<ul>
						<li><a href="/SPRINT2/interfaces/programa4.php">Cosultar y Modificar Datos Maximos</a></li>
						<li><a href="/SPRINT2/interfaces/programa6.php">Alertas de Temperatura y Humedad</a></li>
						<li><a href="/SPRINT2/interfaces/programa3.php">Consultar Clima</a></li>
						<li><a href="/SPRINT2/interfaces/Sectores_Medicion.php">Datos Historicos</a></li>
						<li><a href="/SPRINT2/interfaces/seleccionarSector.php">Selecionar Sector</a></li>
					</ul>
				</li>
				
				<li><a href="/SPRINT2/interfaces/index.php">Iniciar Sesion</a></li>
				
			</ul>
		</div>
	</body>
      
      
      
    <head>
      <title> ULTIMOS datos medidos de TEMPERATURA y HUMEDAD dispositivo IoT
		  </title>
      <meta http-equiv="refresh" content="15" />
    </head>
    <body>
      <table width="100%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    	 <tr>
         <td valign="top" align=center width=80& colspan=8 bgcolor="#4DB9D1"">
           <img src="img/clima-tipos.jpg" width=800 height=250>
         </td>
 	     </tr>
 	     <tr>
         <td valign="top" align=center width=80& colspan=8 bgcolor="#4DB9D1"">
           <h1> <font color=white>Últimos datos medidos sistema medición clima</font></h1>
           <?php  include "Tarea15.php";  ?>
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
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Estado_Lluvia</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Ubicacion</b>
         </td>
 	     </tr>
<?php
// la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
$sql4 = "SELECT * from ubicacion where Id";
$result4 = $mysqli->query($sql4);
while($row4 = $result4->fetch_array(MYSQLI_NUM)){
        $sql1 = "SELECT * from datos_medidos where ID_TARJ=$row4[0] order by id DESC LIMIT 3";
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
             
               //if($estado_lluvia == 10){
                 //   $estado_lluvia = "SIN LLUVIA";
                //}
                //if($estado_lluvia == 20){
                 //   $estado_lluvia = "LLOVIZNANDO";
               // }
               // if($estado_lluvia == 30){
               //     $estado_lluvia = "LLUVIA";
               // }
              
              
            
                $sql2 = "SELECT * from ubicacion where Id=$ID_TARJ"; 
                $result2 = $mysqli->query($sql2);
                $row2 = $result2->fetch_array(MYSQLI_NUM);
                $Ubicacion =$row2[1];
                
                
                //ultimos 3 datos de cada tajeta
                
            
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
                       <?php echo $estado_lluvia; ?> 
                     </td>
                     <td valign="top" align=center>
                       <?php echo $Ubicacion; ?> 
                     </td>
             	     </tr>
<?php
}
}
?>
</html>
     
   </html>