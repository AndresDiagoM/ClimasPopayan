<?php

include ("conexion.php");
$mysqli = new mysqli($host, $user, $pw, $db);


	$sql = "SELECT AVG(temperatura) as count FROM datos_medidos GROUP BY HOUR(hora) ORDER BY hora";
    $sql1= "SELECT AVG (hour(hora)) AS COUNT from datos_medidos GROUP BY HOUR(hora)";
    //echo $sql1
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
    
    for ($i = 2; $i <= 23; $i++) {
        $category[$i] = $i;
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
            text: 'Day Website Ratio'
        },
        xAxis: {
            categories: ['<?php 
                for ($i = 2; $i <= 23; $i++) {
                echo $category[$i];?>','<?php
                }
                ?>']
        },
        yAxis: {
            title: {
                text: 'Temperatura'
            }
        },
        series: [{
            name: 'View',
            data: data_viewer
        }]
    });
});

</script>

<div class="container">
	<br/>
	<h2 class="text-center">TEMPERATURA</h2>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>      