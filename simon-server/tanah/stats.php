
<html>
	<head>
		<title>Monitoring Suhu GGP</title>
		<link rel="stylesheet" href="./include/css/style.css">
		<link rel="stylesheet" href="./include/css/bootstrap.css">
		<link rel="stylesheet" href="./include/js/bootstrap.js">
		<link rel="stylesheet" href="./include/js/highchart.css">
	</head>
	<body>
	<?php include "master/header.php" ?>
	<br>
			<div class="row">
				<div class="col-md-2 col-md-offset-2">
					<div class="panel panel-primary">
  						<div class="panel-heading">
    					<h3 class="panel-title tengah">Log</h3>
  						</div>
  						<div class="panel-body" style="padding:0px;">
						  <?php include "master/side-menu.php" ?>
  					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div id="container1">
					<br>
				</div>
				<div id="container2">
						
				</div>
									</div>
		</div>
	</body>
</html>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="./js/modules/data.js"></script>
	<script type="text/javascript" src="./js/modules/exporting.js"></script>
	<script type="text/javascript" src="./js/highcharts.js"></script>
	<script type="text/javascript" src="./js/bootstrap.js"></script>
	<script>
		var chart = new Highcharts.Chart({
		      chart: {
		         renderTo: 'container1'
		      },
			  title: {
		            text: 'Grafik Data Suhu Harian'
		        },
				
			  xAxis: {
		    title: {
		        enabled: true,
		        text: 'Hours of the Day'
		    },
		    type: 'datetime',

		    dateTimeLabelFormats : {
		        hour: '%I %p',
		        minute: '%I:%M %p'
		    }
		},
		      series: [{
		         data: []
		      }]
		});
	</script>
	<script>
		var chart = new Highcharts.Chart({
		      chart: {
		         renderTo: 'container2'
		      },
			  title: {
		            text: 'Grafik Data RH Harian'
		        },
				
			  xAxis: {
		    title: {
		        enabled: true,
		        text: 'Hours of the Day'
		    },
		    type: 'datetime',

		    dateTimeLabelFormats : {
		        hour: '%I %p',
		        minute: '%I:%M %p'
		    }
		},
		      series: [{
		         data: []
		      }]
		});
	</script>