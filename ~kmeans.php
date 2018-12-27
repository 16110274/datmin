<?php
//error_reporting(0);
require_once ("koneksi.php");

//Centroid Awal
$Centroid = array(
		'C1' => array(
			'TP'=> 900,
			'KM'=> 177,
			'M'=> 1,
			'PR'=> 1,
			'T'=> 1,
		),
		'C2' => array(
			'TP'=> 545,
			'KM'=> 66,
			'M'=> 1,
			'PR'=> 3,
			'T'=> 1,
		),
		'C3' => array(
			'TP'=> 648,
			'KM'=> 53,
			'M'=> 1,
			'PR'=> 3,
			'T'=> 3,
		
		),
		'C4' => array(
			'TP'=> 10,
			'KM'=> 7,
			'M'=> 1,
			'PR'=> 2,
			'T'=> 3,
        
		),
		'C5' => array(
			'TP'=> 806,
			'KM'=> 61,
			'M'=> 3,
			'PR'=> 1,
			'T'=> 1,
		),
    );
	
	mysqli_query($con ,"TRUNCATE `kmeans_c1`");
	mysqli_query($con ,"TRUNCATE `kmeans_c2`");
	mysqli_query($con ,"TRUNCATE `kmeans_c3`");
	mysqli_query($con ,"TRUNCATE `kmeans_c4`");
	mysqli_query($con ,"TRUNCATE `kmeans_c5`");
	
$jarak = array();
$query = mysqli_query($con,"SELECT * FROM mentah");
while ($record = mysqli_fetch_assoc($query)) {
for ($i=1;$i<=5;$i++){
	$jarak[$i] = SQRT(($record['Total_Pengungsi']-$Centroid['C'.$i]['TP'])**2+
				($record['Kebutuhan_Mendesak']-$Centroid['C'.$i]['KM'])**2+
				($record['Medis']-$Centroid['C'.$i]['M'])**2+
				($record['Psikolog_Rohani']-$Centroid['C'.$i]['PR'])**2+
				($record['Teknis']-$Centroid['C'.$i]['T'])**2);
	}
$min = min($jarak);
$class = array_search ($min, $jarak);

mysqli_query($con,"INSERT INTO `kmeans_c".$class."`(`Data`, `Total_Pengungsi`, `Kebutuhan_Mendesak`, `Medis`, `Psikolog_Rohani`, `Teknis`) 
 			VALUES ('".$record['No']."', '".$record['Total_Pengungsi']."', '".$record['Kebutuhan_Mendesak']."', '".$record['Medis']."', '".$record['Psikolog_Rohani']."', '".$record['Teknis']."')");
}



?>