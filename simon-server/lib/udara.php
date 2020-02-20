<?php
include_once (__DIR__ . "/DB.php");
class Sensor{
    private $table_name='log';
    private $db = null;
    public  $id;
    private $humidity=null;
    private $temperature=null;
    private $resistansi_hidrogen_sulfida=null;
    private $nilai_hidrogen_sulfida=null;
    private $nilai_amonia_sulfida_benzena=null;
    private $resistansi_amonia_sulfida_benzena=null;
    private $nilai_gas_lpg=null;
    private $nilai_asap=null;
    private $nilai_karbonmonoksida=null;
    private $nilai_gas_metana=null;
    private $konsentrasi_debu=null;
    function __construct(){
        if ($this->db ==  null){
            $conn = new DB();
            $this->db = $conn->db;
        }
    }

    function setValue($humidity, $temperature, $resistansi_hidrogen_sulfida, $nilai_hidrogen_sulfida, $nilai_amonia_sulfida_benzena, $resistansi_amonia_sulfida_benzena,
    $nilai_gas_lpg, $nilai_asap, $nilai_karbonmonoksida, $nilai_gas_metana, $konsentrasi_debu){
        // $this();
        // $this->id = $id;
        $this->humidity = $humidity;
        $this->temperature= $temperature;
        $this->resistansi_hidrogen_sulfida = $resistansi_hidrogen_sulfida;
        $this->nilai_hidrogen_sulfida = $nilai_hidrogen_sulfida;
        $this->nilai_amonia_sulfida_benzena = $nilai_amonia_sulfida_benzena;
        $this->resistansi_amonia_sulfida_benzena = $resistansi_amonia_sulfida_benzena;
        $this->nilai_gas_lpg = $nilai_gas_lpg;
        $this->nilai_asap = $nilai_asap;
        $this->nilai_karbonmonoksida = $nilai_karbonmonoksida;
        $this->nilai_gas_metana = $nilai_gas_metana;
        $this->konsentrasi_debu = $konsentrasi_debu;

    }


    ///fungsi pennyimpanan data berhasil atau tidak
    function create(){
        // $count = count($this->getBukuPilihan($this->kode_buku));
        $bk= $this->getSensorPilihan($this->id);
        $count = count($bk["data"]);
        if ($count>0) {
            http_response_code(503);
            return array('msg' => "Data sudah ada, tidak berhasil disimpan");
        } 

        else{
            $kueri = "INSERT INTO ".$this->table_name." SET ";
            $kueri .= "humidity='".$this->humidity ."',";
            $kueri .= "temperature='".$this->temperature ."',";
            $kueri .= "resistansi_hidrogen_sulfida='".$this->resistansi_hidrogen_sulfida ."',";
            $kueri .= "nilai_hidrogen_sulfida='".$this->nilai_hidrogen_sulfida ."',";
            $kueri .= "nilai_amonia_sulfida_benzena='".$this->nilai_amonia_sulfida_benzena ."',";
            $kueri .= "resistansi_amonia_sulfida_benzena='".$this->resistansi_amonia_sulfida_benzena ."',";
            $kueri .= "nilai_gas_lpg='".$this->nilai_gas_lpg ."',";
            $kueri .= "nilai_asap='".$this->nilai_asap ."',";
            $kueri .= "nilai_karbonmonoksida='".$this->nilai_karbonmonoksida ."',";
            $kueri .= "nilai_gas_metana='".$this->nilai_gas_metana ."',";
            $kueri .= "konsentrasi_debu='".$this->konsentrasi_debu."'";
            $hasil = $this->db->query($kueri);
            if ($hasil) {
                http_response_code(200);
                return array('msg' => 'success');
            } else {
                http_response_code(503);
                return array('msg' => 'Data Gagal disimpan '.$this->db->error);
            }

        }
    }

    //fungsi update data
    function update($id,$humidity=null, $temperature=null, $resistansi_hidrogen_sulfida=null, $nilai_hidrogen_sulfida=null, $nilai_amonia_sulfida_benzena=null, $resistansi_amonia_sulfida_benzena=null,

    $nilai_gas_lpg=null, $nilai_asap=null, $nilai_karbonmonoksida=null, $nilai_gas_metana=null, $konsentrasi_debu=null){
        $hasil= $this->getSensorPilihan($id);
        $count=count($hasil["data"]);
        if ($count==0){ 
            http_response_code(503);
            return array('msg' => "Data tidak  ada, tidak dapat disimpan" );
        }
        else if ($id  == null){
            http_response_code(503);
            return array('msg' => "Kode tidak boleh kosong, tidak berhasil disimpan" );
        } else {
            $this->setValue($hasil["data"][0]["humidity"],
            $hasil["data"][0]["temperature"],
            $hasil["data"][0]["resistansi_hidrogen_sulfida"],
            $hasil["data"][0]["nilai_hidrogen_sulfida"],
            $hasil["data"][0]["nilai_amonia_sulfida_benzena"],
            $hasil["data"][0]["resistansi_amonia_sulfida_benzena"],
            $hasil["data"][0]["nilai_gas_lpg"],
            $hasil["data"][0]["nilai_asap"],
            $hasil["data"][0]["nilai_karbonmonoksida"],
            $hasil["data"][0]["nilai_gas_metana"],
            $hasil["data"][0]["konsentrasi_debu"]
                    );

            if ($humidity!=null) $this->humidity=$humidity;
            if ($temperature!=null) $this->temperature=$temperature;
            if ($resistansi_hidrogen_sulfida!=null) $this->resistansi_hidrogen_sulfida=$resistansi_hidrogen_sulfida;
            if ($nilai_hidrogen_sulfida!=null) $this->nilai_hidrogen_sulfida=$nilai_hidrogen_sulfida;
            if ($nilai_amonia_sulfida_benzen!=null) $this->nilai_amonia_sulfida_benzen=$nilai_amonia_sulfida_benzen;
            if ($resistansi_amonia_sulfida_benzena!=null) $this->resistansi_amonia_sulfida_benzena=$resistansi_amonia_sulfida_benzena;
            if ($nilai_gas_lpg!=null) $this->nilai_gas_lpg=$nilai_gas_lpg;
            if ($nilai_asap!=null) $this->nilai_asap=$nilai_asap;
            if ($nilai_karbonmonoksida!=null) $this->nilai_karbonmonoksida=$nilai_karbonmonoksida;
            if ($nilai_gas_metana!=null) $this->nilai_gas_metana=$nilai_gas_metana;
            if ($konsentrasi_debu!=null) $this->konsentrasi_debu=$konsentrasi_debu;

            $kueri .= "humidity='".$this->humidity ."',";
            $kueri .= "temperature='".$this->temperature ."',";
            $kueri .= "resistansi_hidrogen_sulfida='".$this->resistansi_hidrogen_sulfida ."',";
            $kueri .= "nilai_hidrogen_sulfida='".$this->nilai_hidrogen_sulfida ."',";
            $kueri .= "nilai_amonia_sulfida_benzena='".$this->nilai_amonia_sulfida_benzena ."',";
            $kueri .= "resistansi_amonia_sulfida_benzena='".$this->resistansi_amonia_sulfida_benzena ."',";
            $kueri .= "nilai_gas_lpg='".$this->nilai_gas_lpg ."',";
            $kueri .= "nilai_asap='".$this->nilai_asap ."',";
            $kueri .= "nilai_karbonmonoksida='".$this->nilai_karbonmonoksida ."',";
            $kueri .= "nilai_gas_metana='".$this->nilai_gas_metana ."',";
            $kueri .= "konsentrasi_debu='".$this->konsentrasi_debu."'";


            $kueri = "UPDATE ".$this->table_name." SET ";
            $kueri .= "humidity='".$this->humidity ."',";
            $kueri .= "temperature='".$this->temperature ."',";
            $kueri .= "resistansi_hidrogen_sulfida='".$this->resistansi_hidrogen_sulfida ."',";
            $kueri .= "nilai_hidrogen_sulfida='".$this->nilai_hidrogen_sulfida ."',";
            $kueri .= "nilai_amonia_sulfida_benzena='".$this->nilai_amonia_sulfida_benzena ."',";
            $kueri .= "resistansi_amonia_sulfida_benzena='".$this->resistansi_amonia_sulfida_benzena ."',";
            $kueri .= "nilai_gas_lpg='".$this->nilai_gas_lpg ."',";
            $kueri .= "nilai_asap='".$this->nilai_asap ."',";
            $kueri .= "nilai_karbonmonoksida='".$this->nilai_karbonmonoksida ."',";
            $kueri .= "nilai_gas_metana='".$this->nilai_gas_metana ."',";
            $kueri .= "konsentrasi_debu='".$this->konsentrasi_debu."'";
            $kueri .= " WHERE id='".$this->id."'";
            $hasil = $this->db->query($kueri);
            if ($hasil){
                http_response_code(201);
                return array('msg'=>'success');
            } else {
                http_response_code(503);
                return array('msg'=>'Data Gagal Disimpan '.$this->db->error." ".$kueri); 
            }
            // return array('msg'=>$kueri);
        }
    }
    

    function getAll(){
        // return "test";
        $kueri = "SELECT * FROM ".$this->table_name." ORDER BY id";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if(count($data)==0)
            return array("msg"=>"Data Tidak Ada", "data"=>array());
        
        return array("msg"=>"success", "data"=>$data);
    }


    function getHumidity(){
        // return "test";
        $kueri = "SELECT HOUR(date) FROM ".$this->table_name." ORDER BY id";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if (count($data)==0)
            return array("msg"=>"Data tidak ada ", "data"=>array());
        return array("msg"=>"success", "data"=>$data);
    }


    function getSensorPilihan($id){
        // return "test";
        $kueri = "SELECT * FROM ".$this->table_name;
        $kueri .=" WHERE id='".$id."'";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if (count($data)==0)
            return array("msg"=>"Data tidak ada ", "data"=>array());
        return array("msg"=>"success", "data"=>$data);
    }
    

    


    ///fungsi delete data
    function delete($id){
        // return "test";
        $data="";
        $row = $this->getSensorPilihan($id);
        if (count($row["data"])==0) {
            http_response_code(304);
            return array("msg"=>$row["msg"]."id ".$id);
            return array('msg'=>$kueri);
        }

        $kueri = "DELETE FROM ".$this->table_name;
        $kueri .=" WHERE id='".$id  ."'";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);

        http_response_code(200);
        return array("msg"=>"success");
    }

}