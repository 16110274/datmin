<?php
// DATA TRAINING PREPARATION
function prep($con){
	mysqli_query($con ,"TRUNCATE `naivebayes_c1`");
	mysqli_query($con ,"TRUNCATE `naivebayes_c2`");
	mysqli_query($con ,"TRUNCATE `naivebayes_c3`");
	mysqli_query($con ,"TRUNCATE `naivebayes_c4`");
	mysqli_query($con ,"TRUNCATE `naivebayes_c5`");
	mysqli_query($con ,"TRUNCATE `naivebayes_sisa`");
	
	$query = mysqli_query($con,"SELECT * FROM mentah");
	while ($record = mysqli_fetch_array($query)) {

//Pengelompokkan data total pengungsi	
	if($record['Total_Pengungsi']<100){
		$record['Total_Pengungsi'] = "<100";
	}else if ($record['Total_Pengungsi']>500){
		$record['Total_Pengungsi'] = ">500";
	}else{
		$record['Total_Pengungsi'] = "100-500";
	}
//Pengelompokkan data kebutuhan mendesak
	if($record['Kebutuhan_Mendesak']<50){
		$record['Kebutuhan_Mendesak'] = "<50";
	}else if ($record['Kebutuhan_Mendesak']>100){
		$record['Kebutuhan_Mendesak'] = ">100";
	}else{
		$record['Kebutuhan_Mendesak'] = "50-100";
	}
//Pengelompokkan data Relawan Medis
	if($record['Medis']==1){
		$record['Medis'] = "Medis Tidak Ada";
	}else if ($record['Medis']==2){
		$record['Medis'] = "Medis Kurang";
	}else if ($record['Medis']==3){
		$record['Medis'] = "Medis Mencukupi";
	}
//Pengelompokkan data Relawan Psikolog & Rohani
	if($record['Psikolog_Rohani']==1){
		$record['Psikolog_Rohani'] = "Psikolog dan Rohani Tidak Ada";
	}else if ($record['Psikolog_Rohani']==2){
		$record['Psikolog_Rohani'] = "Psikolog dan Rohani Kurang";
	}elseif ($record['Psikolog_Rohani']==3){
		$record['Psikolog_Rohani'] = "Psikolog dan Rohani Mencukupi";
	}
//Pengelompokkan data Relawan Teknis
	if($record['Teknis']==1){
		$record['Teknis'] = "Teknis Tidak Ada";
	}else if ($record['Teknis']==2){
		$record['Teknis'] = "Teknis Kurang";
	}else if ($record['Teknis']==3){
		$record['Teknis'] = "Teknis Mencukupi";
	}	
	
    if (strlen($record['Prioritas']) == 1){
		switch ($record['Prioritas']) {
			case '1':
				$var = 1;
				break;
			case '2':
				$var = 2;
				break;
			case '3':
				$var = 3;
				break;
			case '4':
				$var = 4;
				break;
			case '5':
				$var = 5;
				break;
			default:
				break;
		}
		mysqli_query($con,"INSERT INTO `naivebayes_c".$var."` (`Data`, `Total_Pengungsi`, `Kebutuhan_Mendesak`, `Medis`, `Psikolog_Rohani`, `Teknis`) 
						   VALUES ('".$record['No']."', '".$record['Total_Pengungsi']."', '".$record['Kebutuhan_Mendesak']."', '".$record['Medis']."', '".$record['Psikolog_Rohani']."', '".$record['Teknis']."')");
	} else {
		mysqli_query($con,"INSERT INTO `naivebayes_sisa` (`Data`, `Total_Pengungsi`, `Kebutuhan_Mendesak`, `Medis`, `Psikolog_Rohani`, `Teknis`) 
						   VALUES ('".$record['No']."', '".$record['Total_Pengungsi']."', '".$record['Kebutuhan_Mendesak']."', '".$record['Medis']."', '".$record['Psikolog_Rohani']."', '".$record['Teknis']."')");
	}
}
}
?>