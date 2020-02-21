<?php
include_once(__DIR__."/../lib/tanah.php");
include_once(__DIR__."/../lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$sensor = new Sensor();
$format=new DataFormat();
$getAll=$sensor->getAll();
$resultAll= isset($getAll['data']) ? $getAll['data'] : [];
?>
<html>
	<head>
		<title>Monitoring Suhu GGP</title>
		<link rel="stylesheet" href="./include/css/style.css">
		<link rel="stylesheet" href="./include/css/bootstrap.css">
		<link rel="stylesheet" href="./include/js/bootstrap.js">
		<link rel="stylesheet" href="./include/js/highchart.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="./include/js/modules/data.js"></script>
		<script type="text/javascript" src="./include/js/modules/exporting.js"></script>
		<script type="text/javascript" src="./include/js/highcharts.js"></script>
		<script type="text/javascript" src="./include/js/bootstrap.js"></script>
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
				<div id="container2"></div>
			</div>
		</div>
	</body>
</html>

	<?php
		foreach($resultAll as $result){
			echo($result['suhu']);'<br>';
			echo($result['waktu']);'<br>';
			$result['suhu'];
			$result['waktu'];
			echo"
			<script>
			// var data_ph = $result[suhu];
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
						   showFirstLabel:true,
						   showLastLabel:true,
						   min:Date.UTC(2020,1,21),
						   minRange: 24 * 360 * 100,
						   dateTimeLabelFormats : {
							   hour: '%I %p',
							   minute: '%I:%M %p'
							   }
					},
					  series: [{	
					   	pointInterval: 900 * 1000,
						 pointStart:Date.UTC(2020,1,21,), 
						// data: [10, 7, 9, 15]
						data: [($result[suhu])]
					  }]
			   });
		   </script>
		   ";
		}
	?>



<?php echo "ini";
 print_r($result['suhu']);
 echo "tanggal";
 print_r($result['waktu']); ?>

<!-- $(function () {
  var chart = new Highcharts.Chart({

    chart: {
      renderTo: 'container',
      type: 'line'
    },
    title: {
      text: 'Windspeed & Direction',
      x: -20 //center
    },
    subtitle: {
      text: 'User Submitted',
      x: -20
    },
    credits: {
      enabled: false
    },
    legend: {
      enabled: false
    },
    xAxis: {
      type: 'datetime',
      showFirstLabel:true,
      showLastLabel:true,
      min:Date.UTC(2012,11,31,6,0,0,0),
      minRange: 24 * 3600 * 1000,
      dateTimeLabelFormats: {
        hour: '%H:%M',
      }
    },
    yAxis: {
      lineColor: '#999',
      lineWidth: 1,
      tickColor: '#666',
      tickWidth: 1,
      tickLength: 3,
      gridLineColor: '#ddd',
      title: {
        text: 'Wind Speed (K)'
      },
    },
    series: [{
      pointInterval: 3600 * 1000,
      pointStart:Date.UTC(2013,1,1,6,0,0,0),                            
      data: [12, 1, 3, 7, 14, 50]
    }]

  });
}); -->

<!-- <script>
var data_ph = <?php echo $result['ph']; ?>;
  var chart = new Highcharts.Chart({

    chart: {
      renderTo: 'container',
      type: 'line'
    },
    title: {
      text: 'Windspeed & Direction',
      x: -20 //center
    },
    subtitle: {
      text: 'User Submitted',
      x: -20
    },
    credits: {
      enabled: false
    },
    legend: {
      enabled: false
    },
    xAxis: {
      type: 'datetime',
      showFirstLabel:true,
      showLastLabel:true,
      min:Date.UTC(2012,11,31,6,0,0,0),
      minRange: 24 * 3600 * 1000,
      dateTimeLabelFormats: {
        hour: '%H:%M',
      }
    },
    yAxis: {
      lineColor: '#999',
      lineWidth: 1,
      tickColor: '#666',
      tickWidth: 1,
      tickLength: 3,
      gridLineColor: '#ddd',
      title: {
        text: 'Wind Speed (K)'
      },
    },
    series: [{
      pointInterval: 3600 * 1000,
      pointStart:Date.UTC(2012,11,31,6,0,0,0),
      data: [data_ph]
    }]

  });
});
</script> -->

<!-- <script>
Highcharts.chart('container1', {

chart: {
	scrollablePlotArea: {
		minWidth: 700
	}
},

data: {
	csvURL: 'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/analytics.csv',
	beforeParse: function (csv) {
		return csv.replace(/\n\n/g, '\n');
	}
},

title: {
	text: 'Daily sessions at www.highcharts.com'
},

subtitle: {
	text: 'Source: Google Analytics'
},

xAxis: {
	tickInterval: 7 * 24 * 3600 * 1000, // one week
	tickWidth: 0,
	gridLineWidth: 1,
	labels: {
		align: 'left',
		x: 3,
		y: -3
	}
},

yAxis: [{ // left y axis
	title: {
		text: null
	},
	labels: {
		align: 'left',
		x: 3,
		y: 16,
		format: '{value:.,0f}'
	},
	showFirstLabel: false
}, { // right y axis
	linkedTo: 0,
	gridLineWidth: 0,
	opposite: true,
	title: {
		text: null
	},
	labels: {
		align: 'right',
		x: -3,
		y: 16,
		format: '{value:.,0f}'
	},
	showFirstLabel: false
}],

legend: {
	align: 'left',
	verticalAlign: 'top',
	borderWidth: 0
},

tooltip: {
	shared: true,
	crosshairs: true
},

plotOptions: {
	series: {
		cursor: 'pointer',
		point: {
			events: {
				click: function (e) {
					hs.htmlExpand(null, {
						pageOrigin: {
							x: e.pageX || e.clientX,
							y: e.pageY || e.clientY
						},
						headingText: this.series.name,
						maincontentText: Highcharts.dateFormat('%A, %b %e, %Y', this.x) + ':<br/> ' +
							this.y + ' sessions',
						width: 200
					});
				}
			}
		},
		marker: {
			lineWidth: 1
		}
	}
},

series: [{
	name: 'All sessions',
	lineWidth: 4,
	marker: {
		radius: 4
	}
}, {
	name: 'New users'
}]
});
</script> -->