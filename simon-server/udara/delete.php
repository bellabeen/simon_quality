<?php
include_once(__DIR__."/../lib/udara.php");
include_once(__DIR__."/../lib/DataFormat.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$sensor = new Sensor();
$result = $sensor->delete($_POST['id']);
$format= new DataFormat();
echo $format->asJSON($result);
