<?php 
$server = 'sql202.epizy.com';
$username = 'epiz_23212043';
$password = 'iCe2Dw4NT9';
$database = 'epiz_23212043_merapi'; 
$con = mysqli_connect($server,$username,$password) or
die("Koneksi gagal");
mysqli_select_db($con, $database) or die("Database belum ada, silahkan import database");
?>