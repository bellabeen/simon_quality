<?php
// $url=$_SERVER['REQUEST_URI'];
// header("Refresh: 1; URL=$url");
include_once(__DIR__."/../../lib/tanah.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$sensor = new Sensor();
if(isset($_GET['id'])){
    $data=$sensor->getTanahPilihan($_GET['id']);
} else {
    $data=$sensor->getAll();
}
$format=new DataFormat();
$format->asJSONAll($data);
echo $format->asJSONAll($data);