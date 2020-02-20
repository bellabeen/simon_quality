<?php
   	include("connection.php");
   	
   	//$link=Connection();
   date_default_timezone_set("Asia/Jakarta");
   $temp1=$_POST["temp1"];
	$hum1=$_POST["hum1"];

	$query = "INSERT INTO `tbl_log` (`logger`, `log`) 
		VALUES ('$temp1','$hum1')"; 
   	
   if  ((is_null($temp) or is_null($hum1)))
   {
      //echo "Ada yang kosong";
   }
   else
   {
      mysql_query($query);
      
   }
   header("Location: index.php");
?>
