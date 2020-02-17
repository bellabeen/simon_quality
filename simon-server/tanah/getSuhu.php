<?php
// $url=$_SERVER['REQUEST_URI'];
// header("Refresh: 5; URL=$url");
include_once(__DIR__."/../lib/tanah.php");
include_once(__DIR__."/../lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$sensor = new Sensor();
$data=$sensor->getSuhu();
$format=new DataFormat();
$view = isset($_GET['view']) ? $_GET['view']: null;
echo $format->asJSONSuhu($data);