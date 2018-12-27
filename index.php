<?php
require_once ("koneksi.php");
require_once ("prep.php");
require_once ("count.php");
require_once ("NB.php");
echo "DATA MINING";
?>
<!--DATA TRAINING PREPARATION-->
<form method="post" action=''>
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
<tr>
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
	<td> <?php echo $j; ?></td>
	<td> <?php echo $hasil['Data']; ?></td>
	<td> <?php echo $hasil['Total_Pengungsi'];?></td>
	<td> <?php echo $hasil['Kebutuhan_Mendesak'];?></td>
	<td> <?php echo $hasil['Medis'];?></td>
	<td> <?php echo $hasil['Psikolog_Rohani'];?></td>
	<td> <?php echo $hasil['Teknis'];?></td>
	<td> <?php echo "C".$i."";?></td>
	</tr>
	
<?php
	}
}
?>
	</tbody>
	</table>
<?php
}
if(isset($_POST['nb'])){
	if(isset($_POST['INDT'])){
		echo "Hasil dengan memasukkan data baru ke dalam data training";
	}else{
		echo "Hasil tanpa memasukkan data baru ke dalam data training";
	}
?>
<table cellpadding="0" cellspacing="0" border="1px" class="table">
<thead>
<tr>
<th><span class="style1">Data</span></th>
<th><span class="style1">Probabilitas Tertinggi</span></th>
<th><span class="style1">Kelas</span></th>
<tr>
</thead>
<tbody>

<?php
$query = mysqli_query($con,"SELECT * FROM naivebayes_sisa");
while ($record = mysqli_fetch_assoc($query)) {
	$prob = NB($con,$record);
?>
<tr>
<td> <?php echo $record['Data']; ?></td>
<td> <?php echo $prob['max'];?></td>
<td> <?php echo $prob['class'];?></td>
</tr>
<?php 
	if(isset($_POST['INDT'])){
		INDT($con,$record,$prob);
	}
} ?>
</tbody>
</table>
<?php
}
?>