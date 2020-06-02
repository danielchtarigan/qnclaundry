<?php
session_start();
	   $tgl=$_POST['tgl'];
	   $date = new DateTime($tgl);
$ot=$_SESSION['nama_outlet'];

 echo '<strong><font size=20>'.$date->format('d-M').'</font></strong><br>';
 echo '<strong><font size=20>'.$ot.'</font></strong><br>';


?>