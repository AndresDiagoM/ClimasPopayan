<?php

include ("conexion.php");
$mysqli = new mysqli($host, $user, $pw, $db);

	$sql = "SELECT SUM(numberofview) as count FROM demo_viewer 
			GROUP BY YEAR(created_at) ORDER BY created_at";
	$viewer = mysqli_query($mysqli,$sql);
    $viewer = mysqli_fetch_all($viewer,MYSQLI_ASSOC);
	$viewer = json_encode(array_column($viewer, 'count'),JSON_NUMERIC_CHECK);
    
    // Los datos generados a traves del json_enconde les quedan como se presenta abajo en comentarios:
    //$viewer = "[8,5,5]";
    
	/* Getting demo_click table data */
	$sql = "SELECT SUM(numberofclick) as count FROM demo_click 
			GROUP BY YEAR(created_at) ORDER BY created_at";
	$click = mysqli_query($mysqli,$sql);
	$click = mysqli_fetch_all($click,MYSQLI_ASSOC);
	$click = json_encode(array_column($click, 'count'),JSON_NUMERIC_CHECK);
    $category[0] = "2012";
    $category[1] = "2013";
    $category[2] = "2014";
    
    

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

    var data_click = <?php echo $click; ?>;
    var data_viewer = <?php echo $viewer; ?>;

    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Yearly Website Ratio'
        },
        xAxis: {
            categories: ['<?php echo $category[0]?>','<?php echo $category[1]?>','<?php echo $category[2]?>']
        },
        yAxis: {
            title: {
                text: 'Rate'
            }
        },
        series: [{
            name: 'Click',
            data: data_click
        }, {
            name: 'View',
            data: data_viewer
        }]
    });
});

</script>

<div class="container">
	<br/>
	<h2 class="text-center">Highcharts php mysql json example</h2>
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