<?php

$koneksi = mysqli_connect("fdb26.awardspace.net","3074218_latihanarjun","latihanarjun1","3074218_latihanarjun");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>
