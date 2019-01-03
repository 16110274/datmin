<?php
//error_reporting(0);
require_once ("koneksi.php");
require_once ("count.php");
require_once ("NB.php");

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