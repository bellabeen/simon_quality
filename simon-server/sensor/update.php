<?php
include_once(__DIR__."/../lib/sensor.php");
include_once(__DIR__."/../lib/DataFormat.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$humidity = isset($_POST['humidity']) ? $_POST['humidity']: null;
$temperature = isset($_POST['temperature']) ? $_POST['temperature']: null;
$resistansi_hidrogen_sulfida = isset($_POST['resistansi_hidrogen_sulfida']) ? $_POST['resistansi_hidrogen_sulfida']: null;
$nilai_hidrogen_sulfida = isset($_POST['nilai_hidrogen_sulfida']) ? $_POST['nilai_hidrogen_sulfida']: null;
$nilai_amonia_sulfida_benzena = isset($_POST['nilai_amonia_sulfida_benzena']) ? $_POST['nilai_amonia_sulfida_benzena']: null;
$resistansi_amonia_sulfida_benzena = isset($_POST['resistansi_amonia_sulfida_benzena']) ? $_POST['resistansi_amonia_sulfida_benzena']: null;
$nilai_gas_lpg = isset($_POST['nilai_gas_lpg']) ? $_POST['nilai_gas_lpg']: null;
$nilai_asap= isset($_POST['nilai_asap']) ? $_POST['nilai_asap']: null;
$nilai_karbonmonoksida = isset($_POST['nilai_karbonmonoksida']) ? $_POST['nilai_karbonmonoksida']: null;
$nilai_gas_metana = isset($_POST['nilai_gas_metana']) ? $_POST['nilai_gas_metana']: null;
$konsentrasi_debu= isset($_POST['konsentrasi_debu']) ? $_POST['konsentrasi_debu']: null;


$sensor = new Sensor();

$result = $sensor->update($_POST['humidity'], $_POST['temperature'], $_POST['resistansi_hidrogen_sulfida'], $_POST['nilai_hidrogen_sulfida'], $_POST['nilai_amonia_sulfida_benzena'], 
$_POST['resistansi_amonia_sulfida_benzena'], $_POST['nilai_gas_lpg']
, $_POST['nilai_asap'], $_POST['nilai_karbonmonoksida'], $_POST['nilai_gas_metana'], $_POST['konsentrasi_debu']);
$format= new DataFormat();
echo $format->asJSON($result);