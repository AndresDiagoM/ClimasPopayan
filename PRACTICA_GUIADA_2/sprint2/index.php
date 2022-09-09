<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title> Página de Inicio Sistema de Invernadero Automatizado
		  </title>
      <meta charset="utf-8">
      <meta http-equiv="refresh" content="15" />
    </head>
    <body>
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="#FFFFFF">
    	 <tr>
         <td valign="top" align=center width=70%  bgcolor="green"">
           <img src="img/invernadero.jpg" width=650 height=200>
         </td>
         <td valign="top" align=center width=30% bgcolor="green"">
           <h2> <font color=white>Ingreso de Usuarios </font></h2>
            <form method="POST" action="validar.php">
              <table width="100%" align=center border=0 bgcolor="green">
  	            <tr>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="green" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
         		       Usuario:
                  </td>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="green" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
                     <input type=text value="" name="login1" required> 
                  </td>
                </tr>  
  	            <tr>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="green" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
                    Password:
                  </td>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="green" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
                     <input type=password value="" name="passwd1" required> 
                  </td>
                </tr>  
  	            <tr>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="green" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
                    &nbsp;&nbsp;
                  </td>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="green" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
                   <input type=submit value="Enviar" name="Enviar"> 
                  </td>
                </tr>  
                <?php
                if (isset($_GET["mensaje"]))
                 {
                 $mensaje = $_GET["mensaje"];
                    if ($_GET["mensaje"]!=""){
                ?>
  	            <tr>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="#FFCCCC" class="_espacio_celdas_p" 					
                    style="color: #FF0000; 
			             font-weight: bold">
                    <u>Datos Incorrectos:</u>
                  </td>
                  <td width="25%" height="20%" align="left" 				
                    bgcolor="#FFDDDD" class="_espacio_celdas_p" 					
                    style="color: #FF0000; 
			             font-weight: bold">
                    <?php 
                       if ($mensaje == 1)
                         echo "El password del usuario no coincide.";
                       if ($mensaje == 2)
                         echo "No hay usuarios con el login (usuario) ingresado o está inactivo.";
                       if ($mensaje == 3)
                         echo "No se ha logueado en el Sistema. Por favor ingrese los datos.";
                       if ($mensaje == 4)
                         echo "Su tipo de usuario, no tiene las credenciales suficientes para ingresar a esta opción.";
                    ?>                         
                  </td>
                </tr>  
                <?php 
                   }
                 }
                ?>
               </table>  
             </form> 
         </td>
 	     </tr>
 	     <tr>
         <td valign="top" align=center width=80& colspan=2 bgcolor="green"">
           <h1> <font color=white>Sistema de Invernadero Automatizado</font></h1>
         </td>
 	     </tr>
    	 <tr>
         <td valign="top" align=left width=80& colspan=2 bgcolor="#C8DDC8">
           <h2> <font color=black>Descripci&oacute;n del Sistema </font></h2>
           <p align=justify> <font color=#555555 size=3>
    	       ssdjag jags djagsdjasguwtejhgsd jasgdhagsqw jsgadjuwtequ ajsgdsag
             ssdjag jags djagsdjasguwtejhgsd jasgdhagsqw jsgadjuwtequ ajsgdsag
             ssdjag jags djagsdjasguwtejhgsd jasgdhagsqw jsgadjuwtequ ajsgdsag
             ssdjag jags djagsdjasguwtejhgsd jasgdhagsqw jsgadjuwtequ ajsgdsag 
          </font></p>
          <br>
           <h2> <font color=black>Servicios </font></h2>
           <p align=justify> <font color=#555555 size=3>
    	       ssdjag jags djagsdjasguwtejhgsd jasgdhagsqw jsgadjuwtequ ajsgdsag
             ssdjag jags djagsdjasguwtejhgsd jasgdhagsqw jsgadjuwtequ ajsgdsag
             ssdjag jags djagsdjasguwtejhgsd jasgdhagsqw jsgadjuwtequ ajsgdsag
             ssdjag jags djagsdjasguwtejhgsd jasgdhagsqw jsgadjuwtequ ajsgdsag 
          </font></p>
          <br>
           <h2> <font color=black>Quienes Somos </font></h2>
           <p align=justify> <font color=#555555 size=3>
    	       ssdjag jags djagsdjasguwtejhgsd jasgdhagsqw jsgadjuwtequ ajsgdsag
             ssdjag jags djagsdjasguwtejhgsd jasgdhagsqw jsgadjuwtequ ajsgdsag
             ssdjag jags djagsdjasguwtejhgsd jasgdhagsqw jsgadjuwtequ ajsgdsag
             ssdjag jags djagsdjasguwtejhgsd jasgdhagsqw jsgadjuwtequ ajsgdsag 
          </font></p>
         </td>
 	     </tr>
       </table>
     </body>
   </html>