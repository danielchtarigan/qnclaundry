<?php 
include '../config.php';

date_default_timezone_set('Asia/Makassar');
$startDate = '2017/05/26';
$endDate = '2017/06/25';

$startDate2 = '2017/04/26';
$endDate2 = '2017/05/25';



$omsetnow = mysqli_query($con, "SELECT SUM(total_bayar) AS omset from reception WHERE DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate' AND nama_outlet<>'mojokerto' AND jenis='p'");
$data = mysqli_fetch_row($omsetnow);

$omsetlalu = mysqli_query($con, "SELECT SUM(total_bayar) AS omset from reception WHERE DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate2' AND '$endDate2' AND nama_outlet<>'mojokerto' AND jenis='p'");
$data2 = mysqli_fetch_row($omsetlalu);

?>
<legend>Perbandingan Omset Potongan Cab Makassar</legend>
<table border="1">
	<tr>
		<td>Omset Bulan Lalu</td>
		<td>:</td>
		<td><?php echo $data2[0] ?></td>
	</tr>
	<tr>
		<td>Omset Bulan Ini</td>
		<td>:</td>
		<td><?php echo $data[0] ?></td>
	</tr>
</table>