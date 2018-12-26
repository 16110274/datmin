<?php
error_reporting(0);
require_once ("koneksi.php");
require_once ("prep.php");
require_once ("count.php");
require_once ("NB.php");

//DATA TRAINING PREPARATION
//prep($con);

$query = mysqli_query($con,"SELECT * FROM naivebayes_sisa");
while ($record = mysqli_fetch_assoc($query)) {
	NB($con,$record);
}
?>