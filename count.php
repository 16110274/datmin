<?php
// NOT CONNECTED TO DATABASE
// COUNT DATA IN DATABASE
function counting($con,$str){  
$data = array();
$query = mysqli_query($con,"SELECT * FROM naivebayes_c".$str."");
while ($hasil = mysqli_fetch_assoc($query)) {
	array_push($data, $hasil);

}
$count = array();
foreach($data as $one){
	@$count[$one['Data']]++;
    @$count[$one['Total_Pengungsi']]++;
    @$count[$one['Kebutuhan_Mendesak']]++;
    @$count[$one['Medis']]++;
    @$count[$one['Psikolog_Rohani']]++;
    @$count[$one['Teknis']]++;
}

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
			'M1' => $count['M1'],
			'M2' => $count['M2'],
			'M3' => $count['M3'],
		
		),
		'PR' => array(
			'PR1' => $count['PR1'],
			'PR2' => $count['PR2'],
			'PR3' => $count['PR3'],
        
		),
		'T' => array(
			'T1' => $count['T1'],
			'T2' => $count['T2'],
			'T3' => $count['T3'],
		),
    );
	return $plot;
}
?>