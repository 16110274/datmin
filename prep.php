<?php
// NOT CONNECTED TO DATABASE
// DATA TRAINING PREPARATION
function prep($con){  
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
//Pengelompokkan data kebutuhan mendesak
	if($record['Medis']==1){
		$record['Medis'] = "M1";
	}else if ($record['Medis']==2){
		$record['Medis'] = "M2";
	}else if ($record['Medis']==3){
		$record['Medis'] = "M3";
	}
//Pengelompokkan data kebutuhan mendesak
	if($record['Psikolog_Rohani']==1){
		$record['Psikolog_Rohani'] = "PR1";
	}else if ($record['Psikolog_Rohani']==2){
		$record['Psikolog_Rohani'] = "PR2";
	}elseif ($record['Psikolog_Rohani']==3){
		$record['Psikolog_Rohani'] = "PR3";
	}
//Pengelompokkan data kebutuhan mendesak
	if($record['Teknis']==1){
		$record['Teknis'] = "T1";
	}else if ($record['Teknis']==2){
		$record['Teknis'] = "T2";
	}else if ($record['Teknis']==3){
		$record['Teknis'] = "T3";
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
		$querys="INSERT INTO `naivebayes_c".$var."` (`Data`, `Total_Pengungsi`, `Kebutuhan_Mendesak`, `Medis`, `Psikolog_Rohani`, `Teknis`) 
				 VALUES ('".$record['No']."', '".$record['Total_Pengungsi']."', '".$record['Kebutuhan_Mendesak']."', '".$record['Medis']."', '".$record['Psikolog_Rohani']."', '".$record['Teknis'].	"')";
		$hasil=mysqli_query($con,$querys);
	} else {
		$querys="INSERT INTO `naivebayes_sisa` (`Data`, `Total_Pengungsi`, `Kebutuhan_Mendesak`, `Medis`, `Psikolog_Rohani`, `Teknis`) 
				VALUES ('".$record['No']."', '".$record['Total_Pengungsi']."', '".$record['Kebutuhan_Mendesak']."', '".$record['Medis']."', '".$record['Psikolog_Rohani']."', '".$record['Teknis'].	"')";
		$hasil=mysqli_query($con,$querys);
	}
}
}
?>