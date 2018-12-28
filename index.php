<?php
	//Time Handler
	ini_set('max_execution_time', 0); // for infinite time of execution 
	$time_start = microtime(true);  //Start Timer

	//Import library
	require_once ("connection.php");
	require_once ("kmeans.php");
	require_once ("naivebayes.php");
	require_once ("showdata.php");
	
?>
<!--HTML START-->
<H2>[Perbandingan / Integrasi] Metode Klasifikasi dan Clustering dalam Penentuan Prioritas Bantuan Posko Bencana Gunung Merapi Tahun 2010</H2>

<!--DATA TRAINING PREPARATION-->
<form method="post" action=''>
	<button name="" type="submit">Data Preprocessing</button><br><br>
	<table>
		<thead>
		<tr>
			<th> NAIVE BAYES Classification </th>
			<th> K-Means Clustering </th>
		</tr>
		</thead>
	<tbody>
		<tr>
			<td>
				<!--Naive Bayes Classification-->
				<button name="dt" type="submit">Show Data Training</button>
				<input name="prep" type="checkbox">Prepare Data Training</input><br><br>
				<button name="nb" type="submit">Naive Bayes</button>
				<input name="ins" type="checkbox">Insert new data in data training</input>
			</td>
			<td>
				<!--K-Means Clustering-->
				<button name="km" type="submit">K-Means</button>
			</td>
		</tr>
	</tbody>
	</table>
</form>
<!--HTML END-->

<?php
	if(isset($_POST['dt'])){
		//if button show data training is pressed
		if(isset($_POST['prep'])){
			//if prepare data training is checked
			//function preparation is called
		}
		//function show data is called
	}else if(isset($_POST['nb'])){
		//if button naive bayes is pressed
		if(isset($_POST['ins'])){
			//if insert in data training is checked
			//function insert to data training is called after every row is calculated
		}
		//function naive bayes is called
	}else if(isset($_POST['km'])){
		//if button kmeans is pressed
		//function kmeans is called
	}else {
		//default view
	}
?>

<?php
	$time_end = microtime(true); //End Timer
	//Calculate and Print Timer
	$execution_time = ($time_end - $time_start);
	echo '<b>Total Execution Time:</b> '.$execution_time.' Seconds';
?>