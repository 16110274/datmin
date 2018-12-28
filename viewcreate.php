<?php
require_once ("connection.php");

function union($table){
	$query = mysqli_query($con,"SELECT * FROM ".$table."_c1 UNION
								SELECT * FROM ".$table."_c2 UNION
								SELECT * FROM ".$table."_c3 UNION
								SELECT * FROM ".$table."_c4 UNION
								SELECT * FROM ".$table."_c5");
	while ($record = mysqli_fetch_assoc($query)) {
		mysqli_query($con,"INSERT INTO `union_".$table."` (`Data`, `Total_Pengungsi`, `Kebutuhan_Mendesak`, `Medis`, `Psikolog_Rohani`, `Teknis`, `Prioritas`) 
						   VALUES ('".$record['No']."', '".$record['Total_Pengungsi']."', '".$record['Kebutuhan_Mendesak']."',
								   '".$record['Medis']."', '".$record['Psikolog_Rohani']."', '".$record['Teknis']."',`".$record['Prioritas']."`)");
	}
}

function km_t_nb(){
	$query = mysqli_query($con,"SELECT * FROM mentah join union_naivebayes on mentah.No = union_naivebayes.Data");
	while ($record = mysqli_fetch_assoc($query)) {
		mysqli_query($con,"INSERT INTO `kmeans_training_naivebayes` (`No` ,`Update_Terakhir` ,`Nama_Posko` ,`Dusun` ,`Desa` ,`Kecamatan` ,`Kabupaten` ,`Asal_Pengungsi` ,
						  `Total_Pengungsi` ,`Kebutuhan_Mendesak` ,`Medis` ,`Psikolog_Rohani` ,`Teknis` ,`Prioritas`)
						   VALUES ('".$record[No]."',  '".$record[Update_Terakhir]."',  '".$record[Nama_Posko]."',  '".$record[Dusun]."',  '".$record[Desa]."',  '".$record[Kecamatan]."',  '".$record[Kabupaten]."',  '".$record[Asal_Pengungsi]."',  
						   '".$record[Total_Pengungsi]."',  '".$record[Kebutuhan_Mendesak]."',  '".$record[Medis]."',  '".$record[Psikolog_Rohani]."',  '".$record[Teknis]."',  '".$record[Prioritas]."');");
	}
}
?>