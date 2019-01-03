<?php
ini_set('max_execution_time', 0); // for infinite time of execution 

function union($con, $table){
    mysqli_query($con ,"TRUNCATE `union_".$table."`");
    for ($i=1;$i<=5;$i++){
	    $query = mysqli_query($con,"SELECT * FROM `".$table."_c".$i."`");
	    while ($record = mysqli_fetch_assoc($query)) {
		    mysqli_query($con,"INSERT INTO `union_".$table."` (`Data`, `Total_Pengungsi`, `Kebutuhan_Mendesak`, `Medis`, `Psikolog_Rohani`, `Teknis`, `Prioritas`) VALUES 
            ('".$record['Data']."', '".$record['Total_Pengungsi']."', '".$record['Kebutuhan_Mendesak']."', '".$record['Medis']."', '".$record['Psikolog_Rohani']."', '".$record['Teknis']."', '".$record['Prioritas']."');");
        }
	}
}

function km_t_nb($con){
    mysqli_query($con ,"TRUNCATE `kmeans_training_naivebayes`");
	$query = mysqli_query($con,"SELECT `mentah`.`Data`, `mentah`.`Total_Pengungsi`, `mentah`.`Kebutuhan_Mendesak`, `mentah`.`Medis`, `mentah`.`Psikolog_Rohani`, `mentah`.`Teknis`, `mentah`.`Prioritas` 
                                FROM `mentah` join `union_naivebayes` on `mentah`.`Data` = `union_naivebayes`.`Data`");
	while ($record = mysqli_fetch_assoc($query)) {
		mysqli_query($con,"INSERT INTO 'kmeans_training_naivebayes` (`Data`, `Total_Pengungsi`, `Kebutuhan_Mendesak`, `Medis`, `Psikolog_Rohani`, `Teknis`, `Prioritas`) VALUES 
        ('".$record['Data']."', '".$record['Total_Pengungsi']."',  '".$record['Kebutuhan_Mendesak']."',  '".$record['Medis']."',  '".$record['Psikolog_Rohani']."',  '".$record['Teknis']."',  '".$record['Prioritas']."');");
	}
}
?>