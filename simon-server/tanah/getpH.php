<?php
include_once(__DIR__."/../lib/tanah.php");
include_once(__DIR__."/../lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$sensor = new Sensor();
$data=$sensor->getpH();
$format=new DataFormat();
$view = isset($_GET['view']) ? $_GET['view']: null;
echo $format->asJSONpH($data);