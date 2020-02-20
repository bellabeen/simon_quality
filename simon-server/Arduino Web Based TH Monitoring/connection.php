<?php
$servernya="xxxx";	//Nama Servernya dimasukkin kesini
$user="xxxxx"; 		//Nama user MySQL
$auth_pass="xxxxx";	//Password MySQL
$dbnya="xxxxx";		//NamaDB nya

mysql_connect($servernya,$user,$auth_pass);
mysql_select_db($dbnya);
?>