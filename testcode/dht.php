<?php
class dht11{
 public $link='';
 function __construct($temperature, $humidity, $resistansi_hidrogen_sulfida, $nilai_hidrogen_sulfida, $nilai_amonia_sulfida_benzena
 $resistansi_amonia_sulfida_benzena, $nilai_gas_lpg, $nilai_asap, $nilai_karbonmonoksida, $nilai_gas_metana
 $konsentrasi_debu){
  $this->connect();
  $this->storeInDB($temperature, $humidity, $resistansi_hidrogen_sulfida, $nilai_hidrogen_sulfida, $nilai_amonia_sulfida_benzena
  $resistansi_amonia_sulfida_benzena, $nilai_gas_lpg, $nilai_asap, $nilai_karbonmonoksida, $nilai_gas_metana
  $konsentrasi_debu);
 }
 
 function connect(){
    $this->link = mysqli_connect('fdb26.awardspace.net','3074218_latihanarjun','latihanarjun1') 
    or die('Cannot connect to the DB');
    mysqli_select_db($this->link,'3074218_latihanarjun') or die('Cannot select the DB');
 }
 
 function storeInDB($temperature, $humidity, $resistansi_hidrogen_sulfida, $nilai_hidrogen_sulfida, $nilai_amonia_sulfida_benzena
 $resistansi_amonia_sulfida_benzena, $nilai_gas_lpg, $nilai_asap, $nilai_karbonmonoksida, $nilai_gas_metana
 $konsentrasi_debu){
  $query = "insert into log set humidity='".$humidity."', temperature='".$temperature."', ";
  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);
 }
 
}
if($_GET['temperature'] != '' and  $_GET['humidity'] != ''){
 $dht11=new dht11($_GET['temperature'],$_GET['humidity']);
}


?>
