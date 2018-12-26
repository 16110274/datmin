<?php
error_reporting(0);
require_once ("koneksi.php");
require_once ("prep.php");
require_once ("count.php");

//DATA TRAINING PREPARATION
//prep($con);

//Init Array supaya indeks awal data = 1
$jumlah = array(
	0 => 0
);

for ($i=1;$i<=5;$i++){
	$count = counting($con,$i);
	$plot = plotting($count);
	array_push($jumlah, $plot);
}

echo '<pre>';
print_r($jumlah);
echo '</pre>';

echo ($jumlah[1]['TP']['<100']);
?>

