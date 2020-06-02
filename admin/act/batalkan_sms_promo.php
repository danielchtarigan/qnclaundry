<?php 
include '../../config.php';

$hari = $_GET['hari'];
$jam = $_GET['jam'];

mysqli_query($con, "DELETE FROM siap_sms WHERE hari LIKE '%$hari%' AND jam='$jam' AND sent='0' AND konten='' ");



?>