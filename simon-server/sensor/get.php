<?php
include_once(__DIR__."/../lib/sensor.php");
include_once(__DIR__."/../lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$sensor = new Sensor();
if(isset($_GET['id'])){
    $data=$sensor->getSensorPilihan($_GET['id']);
} else {
    $data=$sensor->getAll();
}
$format=new DataFormat();


$view = isset($_GET['view']) ? $_GET['view']: null;
// $view = isset($_GET['view']) ? strtotime($_GET['view']:

if($_GET['view']=='json') {
    echo $format->asJSON($data);
} else {
    echo $format->asTable($data["data"]);
}

// SELECT `humidity` AS `humidity` , `temperature` AS `temperature` FROM log