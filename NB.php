<?php
function NB($con,$record){  
$jumlah = array();
$total = 0;
for ($i=1;$i<=5;$i++){
	$count = counting($con,$i);
	$plot = plotting($count);
	array_push($jumlah[$i]= $plot);
	$total = $total + $jumlah[$i]['Total'];
	array_push($jumlah['Total']= $total);
}

$prob = array();
for ($i=1;$i<=5;$i++){
	$hitung = ((($jumlah[$i]['TP'][$record['Total_Pengungsi']])/($jumlah[$i]['Total']))*
				(($jumlah[$i]['KM'][$record['Kebutuhan_Mendesak']])/($jumlah[$i]['Total']))*
				(($jumlah[$i]['M'][$record['Medis']])/($jumlah[$i]['Total']))*
				(($jumlah[$i]['PR'][$record['Psikolog_Rohani']])/($jumlah[$i]['Total']))*
				(($jumlah[$i]['T'][$record['Teknis']])/($jumlah[$i]['Total']))*
				(($jumlah[$i]['Total'])/($jumlah['Total'])));
	array_push($prob[$i] = $hitung);
}
$MAX = max($prob);
$key = array_search ($MAX, $prob);

echo '<br> Probabilitas ';
echo $MAX;
echo '<br> Prioritas ';
echo $key;
}
?>