<?php
include_once(__DIR__."/../lib/udara.php");
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
    echo $format->asJSONEncode($data);
} else {
    echo $format->asTable($data["data"]);
}

// echo $format->asJSON($data["data"]);

// SELECT `humidity` AS `humidity` , `temperature` AS `temperature` FROM log