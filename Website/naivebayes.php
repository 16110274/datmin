<?php
//BELUM SELESAI TOLONG DILIHAT LAGI
// DATA TRAINING PREPARATION
function prep($con,$table){
	//Delete data from all class table
	mysqli_query($con ,"TRUNCATE `naivebayes_c1`");
	mysqli_query($con ,"TRUNCATE `naivebayes_c2`");
	mysqli_query($con ,"TRUNCATE `naivebayes_c3`");
	mysqli_query($con ,"TRUNCATE `naivebayes_c4`");
	mysqli_query($con ,"TRUNCATE `naivebayes_c5`");
	if($table == 'mentah'){
		mysqli_query($con ,"TRUNCATE `naivebayes_sisa`");
	}
	
	//Fetch data from source table
	$query = mysqli_query($con,"SELECT * FROM ".$table);
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
		
		//Indexing data to insert into data training table
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
		
		//Insert good index to data training table
		mysqli_query($con,"INSERT INTO `naivebayes_c".$var."` (`Data`, `Total_Pengungsi`, `Kebutuhan_Mendesak`, `Medis`, `Psikolog_Rohani`, `Teknis`) 
						   VALUES ('".$record['Data']."', '".$record['Total_Pengungsi']."', '".$record['Kebutuhan_Mendesak']."', '".$record['Medis']."', '".$record['Psikolog_Rohani']."', '".$record['Teknis']."')");
		} else {
		//Insert bad index to other table to be calculated with naive bayes
		mysqli_query($con,"INSERT INTO `naivebayes_sisa` (`Data`, `Total_Pengungsi`, `Kebutuhan_Mendesak`, `Medis`, `Psikolog_Rohani`, `Teknis`) 
						   VALUES ('".$record['Data']."', '".$record['Total_Pengungsi']."', '".$record['Kebutuhan_Mendesak']."', '".$record['Medis']."', '".$record['Psikolog_Rohani']."', '".$record['Teknis']."')");
		}
	}
}

//NAIVE BAYES CALCULATION
function naivebayes($con,$record){  
	//Init variable & array
	$jumlah = array();
	$total = 0;
	
	for ($i=1;$i<=5;$i++){				
		$data = array();

	$query = mysqli_query($con,"SELECT * FROM naivebayes_c".$i."");
	while ($hasil = mysqli_fetch_assoc($query)) {
	array_push($data, $hasil);
	}

	$count = array(
		'<100' =>0,
		'100-500' =>0,
		'>500' =>0,
		'<50' => 0,
		'50-100' => 0,
		'>100' => 0,
		'Medis Tidak Ada' => 0,
		'Medis Kurang' => 0,
		'Medis Mencukupi' => 0,
		'Psikolog dan Rohani Tidak Ada' => 0,
		'Psikolog dan Rohani Kurang' => 0,
		'Psikolog dan Rohani Mencukupi' => 0,
        'Teknis Tidak Ada' => 0,
		'Teknis Kurang' => 0,
		'Teknis Mencukupi' => 0,
		'Total' => 0,
    );
	//coba diubah jadi multi dimensi untuk setiap atribut supaya bisa lebih rapih untuk tampilan data relawan medis, psikologi & rohani, dan teknis
	foreach($data as $one){
		@$count[$one['Total_Pengungsi']]++;
		@$count[$one['Kebutuhan_Mendesak']]++;
		@$count[$one['Medis']]++;
		@$count[$one['Psikolog_Rohani']]++;
		@$count[$one['Teknis']]++;
		@$hitung++;
	}
	array_push($count,$count["Total"] = $hitung);		
				
				
		$plot = array(
			'TP' => array(
				'<100' =>$count['<100'],
				'100-500' =>$count['100-500'],
				'>500' =>$count['>500'],
			),
			'KM' => array(
				'<50' => $count['<50'],
				'50-100' => $count['50-100'],
				'>100' => $count['>100'],
			),
			'M' => array(
				'Medis Tidak Ada' => $count['Medis Tidak Ada'],
				'Medis Kurang' => $count['Medis Kurang'],
				'Medis Mencukupi' => $count['Medis Mencukupi'],
			),
			'PR' => array(
				'Psikolog dan Rohani Tidak Ada' => $count['Psikolog dan Rohani Tidak Ada'],
				'Psikolog dan Rohani Kurang' => $count['Psikolog dan Rohani Kurang'],
				'Psikolog dan Rohani Mencukupi' => $count['Psikolog dan Rohani Mencukupi'],        
			),
			'T' => array(
				'Teknis Tidak Ada' => $count['Teknis Tidak Ada'],
				'Teknis Kurang' => $count['Teknis Kurang'],
				'Teknis Mencukupi' => $count['Teknis Mencukupi'],
			),
			'Total' => $count['Total'],
		);
		
		//array_push($jumlah,$jumlah[$i]= $plot);
		$jumlah[$i]= $plot;
		$total = $total + $jumlah[$i]['Total'];
		//array_push($jumlah,$jumlah['Total']= $total);
		$jumlah['Total']= $total;
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

//INSERT TO DATA TRAINING
function insertDT($con,$record,$prob){
	mysqli_query($con,"INSERT INTO `naivebayes_c".$prob['class']."` (`Data`, `Total_Pengungsi`, `Kebutuhan_Mendesak`, `Medis`, `Psikolog_Rohani`, `Teknis`) 
				  VALUES ('".$record['Data']."', '".$record['Total_Pengungsi']."', '".$record['Kebutuhan_Mendesak']."', '".$record['Medis']."', '".$record['Psikolog_Rohani']."', '".$record['Teknis']."')");
				  
	mysqli_query($con,"DELETE FROM `naivebayes_sisa` WHERE `naivebayes_sisa`.`Data` = ".$record['Data']."");
}

//SHOW NAIVE BAYES
function showNB($con){
?>
<H2>Naive Bayes Classification</H2>
<table cellpadding="0" cellspacing="0" border="1px" class="table">
<thead>
<tr bgcolor="black" style="color: white;">
<th>No.</th>
<th>Data Nomor</th>
<th>Total Pengungsi</th>
<th>Kebutuhan Mendesak</th>
<th>Relawan Medis</th>
<th>Relawan Psikolog / Rohani</th>
<th>Relawan Teknis</th>
<th>Probabilitas Tertinggi</th>
<th>Kelas</th>
<tr>
</thead>
<tbody>

<?php
$j=0;
$query = mysqli_query($con,"SELECT * FROM naivebayes_sisa");
while ($hasil = mysqli_fetch_assoc($query)) {
	$prob = naivebayes($con,$hasil);
	$j++;
?>
<tr>
<td><?php echo $j; ?></td>
<td><?php echo $hasil['Data']; ?></td>
<td><?php echo $hasil['Total_Pengungsi'];?></td>
<td><?php echo $hasil['Kebutuhan_Mendesak'];?></td>
<td><?php echo $hasil['Medis'];?></td>
<td><?php echo $hasil['Psikolog_Rohani'];?></td>
<td><?php echo $hasil['Teknis'];?></td>
<td><?php echo number_format((float)$prob['max'], 10, '.', '');?></td>
<td><?php echo 'C'.$prob['class'];?></td>
</tr>
<?php 
	if(isset($_POST['ins'])){
		insertDT($con,$hasil,$prob);
	}
} ?>
</tbody>
</table>
<?php
}
//Next Function if needed
?>