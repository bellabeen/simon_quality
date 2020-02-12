<?php
include_once (__DIR__ . '/lib/DB.php');

$connect= new DB();

class Sensor{
    private $table_name='log';
    private $db = null;

    function __construct1(){
        if ($this->db ==  null){
            $conn = new DB();
            $this->db = $conn->db;
        }
    }

   function __construct($temperature, $humidity, $resistansi_hidrogen_sulfida, $nilai_hidrogen_sulfida,
    $nilai_amonia_sulfida_benzena, $resistansi_amonia_sulfida_benzena, $nilai_gas_lpg,
    $nilai_asap, $nilai_karbonmonoksida, $nilai_gas_metana, $konsentrasi_debu){
   
      $connect = $this->new DB();

     $this->storeInDB($temperature, $humidity, $resistansi_hidrogen_sulfida, $nilai_hidrogen_sulfida,
     $nilai_amonia_sulfida_benzena, $resistansi_amonia_sulfida_benzena, $nilai_gas_lpg,
     $nilai_asap, $nilai_karbonmonoksida, $nilai_gas_metana, $konsentrasi_debu);
    }

   
   function storeInDB($temperature, $humidity, $resistansi_hidrogen_sulfida, $nilai_hidrogen_sulfida,
   $nilai_amonia_sulfida_benzena, $resistansi_amonia_sulfida_benzena, $nilai_gas_lpg, $nilai_asap,
   $nilai_karbonmonoksida, $nilai_gas_metana, $konsentrasi_debu ){
    $query = "INSERT INTO log set humidity='".$humidity."', temperature='".$temperature."', 
    resistansi_hidrogen_sulfida='".$resistansi_hidrogen_sulfida."', nilai_hidrogen_sulfida='".$nilai_hidrogen_sulfida."', 
    nilai_amonia_sulfida_benzena='".$nilai_amonia_sulfida_benzena."', resistansi_amonia_sulfida_benzena='".$resistansi_amonia_sulfida_benzena."', 
    nilai_gas_lpg='".$nilai_gas_lpg."', nilai_asap='".$nilai_asap."', nilai_karbonmonoksida='".$nilai_karbonmonoksida."',
    nilai_gas_metana='".$nilai_gas_metana."', konsentrasi_debu='".$konsentrasi_debu."'
     ";
     
   //  $connect = new DB();
    $result = mysqli_query($this->$connect,$query) or die('Error query:  '.$query);
   }
}

if($_GET['temperature'] != '' and  $_GET['humidity'] != '' and $_GET['resistansi_hidrogen_sulfida'] != ''
and $_GET['nilai_hidrogen_sulfida'] != '' and $_GET['nilai_amonia_sulfida_benzena'] != '' and $_GET['resistansi_amonia_sulfida_benzena'] != ''
and $_GET['nilai_gas_lpg'] != '' and $_GET['nilai_asap'] != '' and $_GET['nilai_karbonmonoksida'] != '' 
and $_GET['nilai_gas_metana'] != '' and $_GET['konsentrasi_debu'] != ''){
 $sensor=new Sensor($_GET['temperature'], $_GET['humidity'], $_GET['resistansi_hidrogen_sulfida'],
 $_GET['nilai_hidrogen_sulfida'], $_GET['nilai_amonia_sulfida_benzena'], 
 $_GET['resistansi_amonia_sulfida_benzena'], $_GET['nilai_gas_lpg'], $_GET['nilai_asap'], $_GET['nilai_karbonmonoksida'],
$_GET['nilai_gas_metana'], $_GET['konsentrasi_debu']);
}

?>



http://latihanarjun.dx.am/testcode/sensor.php?temperature=22&humidity=111&resistansi_hidrogen_sulfida=10&nilai_hidrogen_sulfida=11&nilai_amonia_sulfida_benzena=12&resistansi_amonia_sulfida_benzena=10&nilai_gas_lpg=11&nilai_asap=20&nilai_karbonmonoksida=11&nilai_gas_metana=12&konsentrasi_debu=12