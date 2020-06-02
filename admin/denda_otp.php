<?php 

$otpopr = mysqli_query($con, "SELECT * FROM reception WHERE (DATEDIFF(tgl_cuci, tgl_spk))>1 AND DATE_FORMAT(tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");

$otppacker = mysqli_query($con, "SELECT * FROM reception WHERE (DATEDIFF(tgl_packing, tgl_spk))>2 AND DATE_FORMAT(tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");


$dendaopr = mysqli_num_rows($otpopr);
$dendapacker = mysqli_num_rows($otppacker);
?>