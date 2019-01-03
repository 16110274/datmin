<?php
ini_set('max_execution_time', 0); // for infinite time of execution 
$time_start = microtime(true);  //Start Timer
require_once ("koneksi.php");
require_once ("prep.php");
require_once ("count.php");
require_once ("NB.php");
echo "<H2>[Perbandingan / Integrasi] Metode Klasifikasi dan Clustering dalam Penentuan Prioritas Bantuan Posko Bencana Gunung Merapi Tahun 2010</H2>";
?>
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
	<button name="show" type="submit">Show Data Training</button>
	<input name="prep" type="checkbox">Prepare Data Training</input><br><br>
	<button name="nb" type="submit">Naive Bayes</button>
	<input name="INDT" type="checkbox">Insert new data in data training</input>
</td>
<td>
<!--K-Means Clustering-->
	<button name="km" type="submit">K-Means</button>
</td>
</tr>
</tbody>
</table>
</form>

<?php
if(isset($_POST['show'])){
	if(isset($_POST['prep'])){
	prep($con);
	}
?>
<H2>DATA TRAINING</H2>
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
<th>Kelas</th>
<tr>
</thead>
<tbody>
<?php
$j=0;
for ($i=1;$i<=5;$i++){
	$query = mysqli_query($con,"SELECT * FROM naivebayes_c".$i."");
	while ($hasil = mysqli_fetch_assoc($query)) {
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
	<td><?php echo "C".$i."";?></td>
	</tr>
	
<?php
	}
?>
	<tr bgcolor="#000000">
	<td colspan="8" >Black</td>
	</tr>
<?php
}
?>
	</tbody>
	</table>
<?php
}else 
if(isset($_POST['nb'])){
	if(isset($_POST['INDT'])){
		echo "Hasil dengan memasukkan data baru ke dalam data training";
	}else{
		echo "Hasil tanpa memasukkan data baru ke dalam data training";
	}
?>
<H2>Naive Bayes Classification</H2>
<table cellpadding="0" cellspacing="0" border="1px" class="table">
<thead>
<tr>
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
	$prob = NB($con,$hasil);
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
<td><?php echo $prob['max'];?></td>
<td><?php echo $prob['class'];?></td>
</tr>
<?php 
	if(isset($_POST['INDT'])){
		INDT($con,$hasil,$prob);
	}
} ?>
</tbody>
</table>
<?php
}else
{
?>
<H2>DATA HASIL PREPROCESSING</H2>
<table cellpadding="0" cellspacing="0" border="1px" class="table">
<thead>
<tr>
<th>No.</th>
<th>Data No</th>
<th>Update Terakhir</th>
<th>Nama Posko</th>
<th>Dusun</th>
<th>Desa</th>
<th>Kecamatan</th>
<th>Kabupaten</th>
<th>Asal Pengungsi</th>
<th>Total Pengungsi</th>
<th>Kebutuhan Mendesak</th>
<th>Relawan Medis</th>
<th>Relawan Psikolog dan Rohani</th>
<th>Relawan Teknis</th>
<th>Prioritas</th>
<tr>
</thead>
<tbody>

<?php
$j=0;
$query = mysqli_query($con,"SELECT * FROM mentah");
while ($record = mysqli_fetch_assoc($query)) {
	$j++;
?>
<tr>
<td><?php echo $j; ?></td>
<td> <?php echo $record['No']; ?></td>
<td> <?php echo $record['Update_Terakhir']; ?></td>
<td> <?php echo $record['Nama_Posko']; ?></td>
<td> <?php echo $record['Dusun']; ?></td>
<td> <?php echo $record['Desa']; ?></td>
<td> <?php echo $record['Kecamatan']; ?></td>
<td> <?php echo $record['Kabupaten']; ?></td>
<td> <?php echo $record['Asal_Pengungsi']; ?></td>
<td> <?php echo $record['Total_Pengungsi']; ?></td>
<td> <?php echo $record['Kebutuhan_Mendesak']; ?></td>
<td> <?php echo $record['Medis']; ?></td>
<td> <?php echo $record['Psikolog_Rohani']; ?></td>
<td> <?php echo $record['Teknis']; ?></td>
<td> <?php echo $record['Prioritas']; ?></td>
</tr>
<?php 
} 
?>
</tbody>
</table>
<?php
}
$time_end = microtime(true); //End Timer
//Calculate and Print Timer
$execution_time = ($time_end - $time_start);
echo '<b>Total Execution Time:</b> '.$execution_time.' Seconds';
?>