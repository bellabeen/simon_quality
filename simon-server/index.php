<?php
include_once(__DIR__."/lib/sensor.php");
include_once(__DIR__."/lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$sensor = new Sensor();
if(isset($_GET['id'])){
    $data=$sensor->getSensorPilihan($_GET['id']);
} else {
    $data=$sensor->getAll();
}
$format=new DataFormat();


$view = isset($_GET['view']) ? $_GET['view']: null;

echo $format->asJSON($data);