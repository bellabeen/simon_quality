<?php
class Sensor{
 public $link='';
 function __construct($temperature, $humidity, $resistansi_hidrogen_sulfida, $nilai_hidrogen_sulfida, $nilai_amonia_sulfida_benzena, $resistansi_amonia_sulfida_benzena, $nilai_gas_lpg, $nilai_asap, $nilai_karbonmonoksida, $nilai_gas_metana, $konsentrasi_debu){
  $this->connect();
  $this->storeInDB($temperature, $humidity, $resistansi_hidrogen_sulfida, $nilai_hidrogen_sulfida, $nilai_amonia_sulfida_benzena, $resistansi_amonia_sulfida_benzena, $nilai_gas_lpg, $nilai_asap, $nilai_karbonmonoksida, $nilai_gas_metana, $konsentrasi_debu);
 }
 
 function connect(){
    $this->link = mysqli_connect('fdb26.awardspace.net','3074218_latihanarjun','latihanarjun1') 
    or die('Cannot connect to the DB');
    mysqli_select_db($this->link,'3074218_latihanarjun') or die('Cannot select the DB');
 }
 
 function storeInDB($temperature, $humidity, $resistansi_hidrogen_sulfida, $nilai_hidrogen_sulfida, $nilai_amonia_sulfida_benzena, $resistansi_amonia_sulfida_benzena, $nilai_gas_lpg, $nilai_asap, $nilai_karbonmonoksida, $nilai_gas_metana, $konsentrasi_debu){
  $query = "insert into log set humidity='".$humidity."', temperature='".$temperature."' ,resistansi_hidrogen_sulfida='".$resistansi_hidrogen_sulfida."'
  , nilai_amonia_sulfida_benzena='".$nilai_amonia_sulfida_benzena."', nilai_gas_lpg='".$nilai_gas_lpg."', nilai_karbonmonoksida='".$nilai_karbonmonoksida."', nilai_gas_metana='".$nilai_gas_metana."'
  , konsentrasi_debu='".$konsentrasi_debu."'";
  $result = mysqli_query($this->link,$query) or die('Error query:  '.$query);
 }
 
}
if($_GET['temperature'] != '' and  $_GET['humidity'] != '' and  $_GET['resistansi_hidrogen_sulfida'] != '' and  $_GET['nilai_amonia_sulfida_benzena'] != ''
and  $_GET['nilai_gas_lpg'] != '' and  $_GET['nilai_karbonmonoksida'] != '' and  $_GET['nilai_gas_metana'] != '' and  $_GET['konsentrasi_debu'] != ''){
 $sensor=new Sensor($_GET['temperature'],$_GET['humidity'],$_GET['resistansi_hidrogen_sulfida'],$_GET['nilai_amonia_sulfida_benzena'],$_GET['nilai_gas_lpg']
 ,$_GET['nilai_karbonmonoksida'],$_GET['konsentrasi_debu']);
}


?>
