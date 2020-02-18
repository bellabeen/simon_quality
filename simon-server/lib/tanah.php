<?php
include_once (__DIR__ . "/DB.php");
class Sensor{
    private $table_name='tanah';
    private $db = null;
    public  $id;
    private $suhu=null;
    private $kelembapan_tanah=null;  
    private $ph=null;  

    function __construct(){
        if ($this->db ==  null){
            $conn = new DB();
            $this->db = $conn->db;
        }
    }

    function setValue($suhu, $kelembapan_tanah, $ph){
        // $this();
        // $this->id = $id;
        $this->suhu = $suhu;
        $this->kelembapan_tanah = $kelembapan_tanah;
        $this->ph = $ph;

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
            $kueri .= "suhu='".$this->suhu ."',";
            $kueri .= "kelembapan_tanah='".$this->kelembapan_tanah ."',";
            $kueri .= "ph='".$this->ph."'";
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
    function update($id, $suhu, $kelembapan_tanah, $ph){
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
            $this->setValue($hasil["data"][0]["suhu"],
            $hasil["data"][0]["kelembapan_tanah"],
            $hasil["data"][0]["ph"]
                    );

            if ($suhu!=null) $this->suhu=$suhu;
            if ($kelembapan_tanah!=null) $this->kelembapan_tanah=$kelembapan_tanah;
            if ($ph!=null) $this->ph=$ph;

            $kueri .= "suhu='".$this->suhu ."',";
            $kueri .= "kelembapan_tanah='".$this->kelembapan_tanah ."',";
            $kueri .= "ph='".$this->ph."'";


            $kueri = "UPDATE ".$this->table_name." SET ";
            $kueri .= "suhu='".$this->suhu ."',";
            $kueri .= "kelembapan_tanah='".$this->kelembapan_tanah."',";
            $kueri .= "ph='".$this->ph ."'";
            
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
        $kueri = "SELECT * FROM ".$this->table_name." ORDER BY waktu DESC";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if(count($data)==0)
            return array("msg"=>"Data Tidak Ada", "data"=>array());
        
        return array("data"=>$data);
    }

    function getAllFilter(){
        // return "test";
        $kueri = "SELECT * FROM ".$this->table_name." ORDER BY waktu DESC LIMIT 1";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if(count($data)==0)
            return array("msg"=>"Data Tidak Ada", "data"=>array());
        
        return array("data"=>$data);
    }

    function getnData(){
                // return "test";
                $kueri = "SELECT COUNT(*) AS jumlah FROM ".$this->table_name."";
                $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
                http_response_code(200);
                $data = array();
                while ($row = $hasil->fetch_assoc()){
                    $data[]=$row;
                }
                if(count($data)==0)
                    return array("msg"=>"Data Tidak Ada", "data"=>array());
                return array("data"=>$data);
    }


    function getpH(){
        // SELECT ph FROM table ORDER BY DESC LIMIT 1

        // return "test";
        $kueri = "SELECT ph FROM ".$this->table_name." ORDER BY waktu DESC LIMIT 1";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if (count($data)==0)
            return array("msg"=>"Data tidak ada ", "data"=>array());
        return array("data"=>$data);
    }

    function getSuhu(){
        // SELECT ph FROM table ORDER BY DESC LIMIT 1

        // return "test";
        $kueri = "SELECT suhu FROM ".$this->table_name." ORDER BY waktu DESC LIMIT 1";
        $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
        http_response_code(200);
        $data = array();
        while ($row = $hasil->fetch_assoc()){
            $data[]=$row;
        }
        if (count($data)==0)
            return array("msg"=>"Data tidak ada ", "data"=>array());
        return array("data"=>$data);
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