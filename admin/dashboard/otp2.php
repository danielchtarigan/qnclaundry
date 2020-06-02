<?php 


date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$startDate = date('Y-m-d', strtotime('-9 days', strtotime($date)));
$endDate = date('Y-m-d', strtotime('-3 days', strtotime($date)));

function semua_data_input($startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND nama_outlet<>'mojokerto' AND nama_outlet<>'support' AND nama_outlet<>'Nipa-Nipa' AND nama_outlet<>'Cendrawasih' ");
	$dataquery = mysqli_fetch_array($query);
	$data = $dataquery['jumlah'];
	return $data;
}

function otp_all($startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND datediff(tgl_kembali, tgl_input)<='3' AND nama_outlet<>'mojokerto' AND nama_outlet<>'support' AND nama_outlet<>'Nipa-Nipa' AND nama_outlet<>'Cendrawasih' ");
	$dataquery = mysqli_fetch_array($query);
	$data = $dataquery['jumlah'];
	return $data;
}

function otp_spk($startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND datediff(tgl_spk, tgl_input)<='0.5' AND nama_outlet<>'mojokerto' AND nama_outlet<>'support' AND nama_outlet<>'Nipa-Nipa' AND nama_outlet<>'Cendrawasih' ");
	$dataquery = mysqli_fetch_array($query);
	$data = $dataquery['jumlah'];
	return $data;
}

function otp_operasional($startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND datediff(tgl_packing, tgl_spk)<='2' AND nama_outlet<>'mojokerto' AND nama_outlet<>'support' AND nama_outlet<>'Nipa-Nipa' AND nama_outlet<>'Cendrawasih' ");
	$dataquery = mysqli_fetch_array($query);
	$data = $dataquery['jumlah'];
	return $data;
}


function data_otp($startDate,$endDate){
	$data['otp_all'] = round(otp_all($startDate,$endDate)/semua_data_input($startDate,$endDate)*100,2);
	$data['otp_spk'] = round(otp_spk($startDate,$endDate)/semua_data_input($startDate,$endDate)*100,2);
	$data['otp_operasional'] = round(otp_operasional($startDate,$endDate)/semua_data_input($startDate,$endDate)*100,2);	
	return $data;

}

$data = data_otp($startDate,$endDate);

$day = date('l', strtotime($startDate));
$day2 = date('l', strtotime($endDate));

switch ($day){
	case "Sunday" : $hari = "Minggu"; break;
	case "Monday" : $hari = "Senin"; break;
	case "Tuesday" : $hari = "Selasa"; break;
	case "Wednesday" : $hari = "Rabu"; break;
	case "Thursday" : $hari = "Kamis"; break;
	case "Friday" : $hari = "Jumat"; break;
	case "Saturday" : $hari = "Sabtu"; break;
}

switch ($day2){
	case "Sunday" : $hari2 = "Minggu"; break;
	case "Monday" : $hari2 = "Senin"; break;
	case "Tuesday" : $hari2 = "Selasa"; break;
	case "Wednesday" : $hari2 = "Rabu"; break;
	case "Thursday" : $hari2 = "Kamis"; break;
	case "Friday" : $hari2 = "Jumat"; break;
	case "Saturday" : $hari2 = "Sabtu"; break;
}
?>

	<p align="center"><strong>OTP Mingguan : <?php echo $hari.' - '.$hari2; ?></strong></p>
		<table style="font-family: arial">
			<tr>
				<td>Jumlah Nota</td>
				<td>&nbsp; &nbsp; &nbsp; &nbsp;</td>
				<td>:&nbsp;</td>
				<td><?php echo semua_data_input($startDate,$endDate); ?></td>
			</tr>
			<tr>
				<td>OTP UMUM</td>
				<td>&nbsp; &nbsp; &nbsp; &nbsp;</td>
				<td>:&nbsp;</td>
				<td><?php echo $data['otp_all']; ?></td>
				<td>&nbsp; %</td>
			</tr>
			<tr>
				<td>OTP Outlet</td>
				<td>&nbsp; &nbsp; &nbsp; &nbsp;</td>
				<td>:&nbsp;</td>
				<td><?php echo $data['otp_spk']; ?></td>
				<td>&nbsp; %</td>
			</tr>
			<tr>
				<td>OTP OPERASIONAL</td>
				<td>&nbsp; &nbsp; &nbsp; &nbsp;</td>
				<td>:&nbsp;</td>
				<td><?php echo $data['otp_operasional']; ?></td>
				<td>&nbsp; %</td>
			</tr>	
		</table>
		
		<a href="detail_otp.php" style="font-size: 10px; font-style: italic; font-weight: bold">Detail OTP Outlet</a>



  