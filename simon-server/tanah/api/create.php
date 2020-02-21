<?php
include_once(__DIR__."/../../lib/tanah.php");
include_once(__DIR__."/../../lib/DataFormat.php");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$sensor = new Sensor();
$format= new DataFormat();

$suhu = isset($_GET['suhu']) ? $_GET['suhu']: null;
$kelembapan_tanah = isset($_GET['kelembapan_tanah']) ? $_GET['kelembapan_tanah']: null;
$ph = isset($_GET['ph']) ? $_GET['ph']: null;
$sensor->setValue($suhu, $kelembapan_tanah, $ph);
$result = $sensor->create();
date_default_timezone_set("Asia/Bangkok");
echo date_default_timezone_get();
echo $format->asJSONAll($result);

?>