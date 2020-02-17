<?php
include_once(__DIR__."/../lib/tanah.php");
include_once(__DIR__."/../lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$sensor = new Sensor();
if(isset($_GET['id'])){
    $data=$sensor->getTanahPilihan($_GET['id']);
} else {
    $data=$sensor->getAll();
}

// /get-api.php?order=desc&limit=1

// berrat

// $order = $_GET['order']; //isinya desc
// $limit = $_GET['limit']; //isinya 1
$format=new DataFormat();
echo $format->asJSONAll($data);

// if($_GET['view']=='json') {
//     echo $format->asJSONAll($data);
// } else {
//     echo $format->asTable($data["data"]);
// }
