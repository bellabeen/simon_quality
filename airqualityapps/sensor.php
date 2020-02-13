<?php
class Sensor{
 public $link='';
 function __construct($temperature, $humidity, $nilai_amonia_sulfida_benzena, $resistansi_amonia_sulfida_benzena,
 $nilai_gas_lpg, $nilai_asap, $nilai_karbonmonoksida, $nilai_gas_metana){
  $this->connect();

  $this->storeInDB($temperature, $humidity, $nilai_amonia_sulfida_benzena, $resistansi_amonia_sulfida_benzena,
  $nilai_gas_lpg, $nilai_asap, $nilai_karbonmonoksida, $nilai_gas_metana);
 }
 
 function connect(){
    $this->link = mysqli_connect('localhost','bellabeen','kepoajalu') 
    or die('Cannot connect to the DB');
    mysqli_select_db($this->link,'quality') or die('Cannot select the DB');
 }
 
 function storeInDB($temperature, $humidity, $nilai_amonia_sulfida_benzena, $resistansi_amonia_sulfida_benzena, 
 $nilai_gas_lpg, $nilai_asap, $nilai_karbonmonoksida, $nilai_gas_metana){
  $query = "INSERT INTO log set humidity='".$humidity."', temperature='".$temperature."',
  nilai_amonia_sulfida_benzena='".$nilai_amonia_sulfida_benzena."', resistansi_amonia_sulfida_benzena='".$resistansi_amonia_sulfida_benzena."',
  nilai_gas_lpg='".$nilai_gas_lpg."', nilai_asap='".$nilai_asap."',
  nilai_karbonmonoksida='".$nilai_karbonmonoksida."', nilai_gas_metana='".$nilai_gas_metana."'
   ";
  $result = mysqli_query($this->link,$query) or die('Error query:  '.$query);
 }
 
}
if($_GET['temperature'] != '' and  $_GET['humidity'] != '' 
and $_GET['nilai_amonia_sulfida_benzena'] != '' and $_GET['resistansi_amonia_sulfida_benzena'] != ''
and $_GET['nilai_gas_lpg'] != '' and $_GET['nilai_asap'] != '' 
and $_GET['nilai_karbonmonoksida'] != '' and $_GET['nilai_gas_metana'] != '' ){

 $sensor=new Sensor($_GET['temperature'], $_GET['humidity'],
 $_GET['nilai_amonia_sulfida_benzena'], $_GET['resistansi_amonia_sulfida_benzena'], 
 $_GET['nilai_gas_lpg'], $_GET['nilai_asap'], $_GET['nilai_karbonmonoksida'], $_GET['nilai_gas_metana']);
}

?>