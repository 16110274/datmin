<?php
// NOT CONNECTED TO DATABASE
// COUNT DATA IN DATABASE
function counting($con,$str){  
$data = array();

$query = mysqli_query($con,"SELECT * FROM naivebayes_c".$str."");
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
return $count;
}

function plotting($count){
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
	return $plot;
}
?>