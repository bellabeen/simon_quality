<?php

include_once(__DIR__."/../lib/tanah.php");
include_once(__DIR__."/../lib/DataFormat.php");
header('Access-Control-Allow-Origin:*');
$sensor = new Sensor();
// $data=$sensor->getAll();
// $format=new DataFormat();

//membuka file JSON
// $file = file_get_contents('../tanah/myfile.json');
// $json = json_decode($file, true);
// var_dump($json);
// foreach ($json as $key) {
//     echo $json->suhu . '<br>';



// // Read JSON file
//  $json = file_get_contents('../tanah/myfile.json');

// // //Decode JSON
//  $json_data = json_decode($json,true);

// // Print data
//  print_r($json_data);



// $url = '../tanah/myfile.json'; // path to your JSON file
// $data = file_get_contents($url); // put the contents of the file into a variable
// $json = json_decode($data, true); // decode the JSON feed

// echo $json[1]->id;

// foreach ($json as $json) {
// 	echo $json->id . '<br>';
// }


$file = file_get_contents("../tanah/myfile.json");
$json_data = json_decode($file, true);

foreach ($json_data as $k=>$v) {
            echo $k . ' : ' . $v . '<br />';
}

//     $html = "echo";
//     // $html .= "<table border='1'>";
//     foreach($json_data as $k=>$v){
//         if ($k==0){
//             foreach($v as $key=>$value){
//                 $html .=$key;
//             }
//             $html .=;
//         }
//         $html .= "<tr>";
//         if (is_array($v)) {
//             foreach($v as $key=>$value){
//                 $html .= "<td>".$value."</td>";
//         }
//     } else {
//         $html .='<td>'.$v.'<td/>';
//     }
//     $html .= "</tr>";
// }
//     $html .= "<table>";
//     return $html;