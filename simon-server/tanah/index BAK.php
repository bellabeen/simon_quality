<?php
include_once(__DIR__."/../lib/tanah.php");
include_once(__DIR__."/../lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$sensor = new Sensor();
$format=new DataFormat();

// $data=$sensor->getpH();

// $file = file_get_contents("../tanah/tanah.json");
// $array = json_decode($file, true);
// $resultArray = isset($array['data']) ? $array['data'] : [];
// ?>
<html>
	<head>
		<title>Sistem Monitoring</title>
		<link rel="stylesheet" href="./include/css/style.css">
		<link rel="stylesheet" href="./include/css/bootstrap.css">
		
		
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
			<div class="col-md-3">
				<table class="table table-bordered">
					<thead>
						<td><center><p class="tebel" style="margin-top:0px; margin-bottom:0px; font-size:18px">Suhu (&degC)</p></center></td>
					</thead>
					<tr class="success">
					<?php 
					$url = file_get_contents("../tanah/.json/suhu.json");
					$array = json_decode($url, true);
					$resultArray = isset($array['data']) ? $array['data'] : [];
					foreach ($resultArray as $ph){
						echo '<td><center><p class="tebel gede"style="margin-top:5px"> '.(isset($ph['suhu']) ? $ph['suhu'] : '-') .'</p></center></td>';

						}?>
					</tr>
				</table>
			</div>
			<div class="col-md-3">
				<table class="table table-bordered">
					<thead>
						<td><center><p class="tebel" style="margin-top:0px; margin-bottom:0px; font-size:18px">Kelembapan Tanah (%)</p></center></td>
					</thead>
					<tr class="info">
						<td><center><p class="tebel gede" style="margin-top:5px">79</p></center></td>
					</tr>
				</table>
			</div>
			<div class="col-md-3">
				<table class="table table-bordered">
					<thead>
						<td><center><p class="tebel" style="margin-top:0px; margin-bottom:0px; font-size:18px">pH (&degC)</p></center></td>
					</thead>
					<tr class="warning">
					<?php 
					$url = file_get_contents("../tanah/.json/ph.json");
					$array = json_decode($url, true);
					$resultArray = isset($array['data']) ? $array['data'] : [];
					foreach ($resultArray as $ph){
						echo '<td><center><p class="tebel gede"style="margin-top:5px"> '.(isset($ph['ph']) ? $ph['ph'] : '-') .'</p></center></td>';

						}?>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-4">
				<p class="tebel">Ringkasan Data:</p>
					<table class="table table-striped table-hover">
						<tr>
							<td>Last Update</td>
							<td>:</td>
							<td>2018-11-18 13:32:46</td>
						</tr>
						<tr>
							<td>Interval Update</td>
							<td>:</td>
							<td>5 Detik</td>
						</tr>
						<tr>
							<td>Jumlah Data</td>
							<td>:</td>
							<td>2022</td>
						</tr>
					</table>
			</div>
			
		</div>
    </div>
	</body>
	<?php include "master/footer.php" ?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="./js/modules/data.js"></script>
	<script type="text/javascript" src="./js/modules/exporting.js"></script>
	<script type="text/javascript" src="./js/highcharts.js"></script>
	<script type="text/javascript" src="./js/bootstrap.js"></script>
	
</html>