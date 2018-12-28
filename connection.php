<?php 
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'merapi'; 
$con = mysqli_connect($server,$username,$password) or
die("Koneksi gagal");
mysqli_select_db($con, $database) or die("Database belum ada, silahkan import database");
?>