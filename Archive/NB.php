<?php
function NB($con,$record){  
$jumlah = array();
$total = 0;
for ($i=1;$i<=5;$i++){
	$count = counting($con,$i);
	$plot = plotting($count);
	array_push($jumlah,$jumlah[$i]= $plot);
	$total = $total + $jumlah[$i]['Total'];
	array_push($jumlah,$jumlah['Total']= $total);
}

$prob = array();
for ($i=1;$i<=5;$i++){
	$hitung = ((($jumlah[$i]['TP'][$record['Total_Pengungsi']])/($jumlah[$i]['Total']))*
			   (($jumlah[$i]['KM'][$record['Kebutuhan_Mendesak']])/($jumlah[$i]['Total']))*
			   (($jumlah[$i]['M'][$record['Medis']])/($jumlah[$i]['Total']))*
			   (($jumlah[$i]['PR'][$record['Psikolog_Rohani']])/($jumlah[$i]['Total']))*
			   (($jumlah[$i]['T'][$record['Teknis']])/($jumlah[$i]['Total']))*
			   (($jumlah[$i]['Total'])/($jumlah['Total'])));
	array_push($prob,$prob[$i] = $hitung);
}
$max = max($prob);
$class = array_search ($max, $prob);
array_push($prob,$prob['max']= $max);
array_push($prob,$prob['class']= $class);
return $prob;
}

function INDT($con,$record,$prob){
	mysqli_query($con,"INSERT INTO `naivebayes_c".$prob['class']."` (`Data`, `Total_Pengungsi`, `Kebutuhan_Mendesak`, `Medis`, `Psikolog_Rohani`, `Teknis`) 
				  VALUES ('".$record['Data']."', '".$record['Total_Pengungsi']."', '".$record['Kebutuhan_Mendesak']."', '".$record['Medis']."', '".$record['Psikolog_Rohani']."', '".$record['Teknis']."')");
				  
	mysqli_query($con,"DELETE FROM `naivebayes_sisa` WHERE `naivebayes_sisa`.`Data` = ".$record['Data']."");
}
?>