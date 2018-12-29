<?php
function showdata($con,$algo,$title){
?>
	<H2><?php echo$title?></H2>
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
			$query = mysqli_query($con,"SELECT * FROM ".$algo."_c".$i."");
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
}

function showprepro($con){
?>
	<H2>DATA HASIL PREPROCESSING</H2>
	<table cellpadding="0" cellspacing="0" border="1px" class="table">
		<thead>
		<tr bgcolor="black" style="color: white;">
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
			<td> <?php echo $record['Data']; ?></td>
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
?>