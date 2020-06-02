<?php 

include '../config.php';

$b = mysqli_query($con, "UPDATE user_driver SET status='0',lokasiform='',lokasi='',keterangan='' WHERE name='$_POST[driver]'");

if($b){
	echo "1";
}