<?php 

include 'config.php';
date_default_timezone_set('Asia/Makassar');

function data_operasional($date,$gb,$ob){
	global $con;
	$tabel = "SELECT * FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND DATE($ob)='$date' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND status_order=''";
	$result = $con->query($tabel."GROUP BY $gb ORDER BY $gb ASC,$ob ASC");
	while($row = $result->fetch_array()){
		$orderId = $row['no_nota'];
		$karyawan = $row[$gb];
		$lokasi = $row['workshop'];

		$data[] = array('id' => $orderId, 'karyawan' => $karyawan, 'lokasi' => $lokasi);
	} 
	return $data;
}

function jumlah_berat($date,$gb,$ob,$karyawan){
	global $con;
	$tabel = "SELECT COALESCE(SUM(berat),0) FROM reception WHERE DATE($ob)='$date' AND $gb='$karyawan' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND status_order=''";
	$result = $con->query($tabel);
	$row = $result->fetch_array();
	$data = round($row[0],2);
	return $data;
}

function jumlah_item($date,$gb,$ob,$karyawan){
	global $con;
	$tabel = "SELECT COALESCE(SUM(jumlah),0) FROM reception WHERE DATE($ob)='$date' AND $gb='$karyawan' AND jenis='p' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND status_order=''";
	$result = $con->query($tabel);
	$row = $result->fetch_array();
	$data = round($row[0],2);
	return $data;
}

function jumlah_order($date,$gb,$ob,$karyawan){
	global $con;
	$tabel = "SELECT COUNT(*) FROM reception WHERE DATE($ob)='$date' AND $gb='$karyawan' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND status_order=''";
	$result = $con->query($tabel);
	$row = $result->fetch_array();
	$data = round($row[0],2);
	return $data;
}

function jumlah_bayar($date,$gb,$ob,$karyawan){
	global $con;
	$tabel = "SELECT COALESCE(SUM(total_bayar),0) FROM reception WHERE DATE($ob)='$date' AND $gb='$karyawan' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND status_order=''";
	$result = $con->query($tabel);
	$row = $result->fetch_array();
	$data = number_format($row[0],0,',','.');
	return $data;
}

function express($date,$gb,$ob,$karyawan){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(*),0) as bonus FROM reception WHERE $gb='$karyawan' AND express<>'0' AND jenis='k' AND DATE($ob)='$date' AND DATEDIFF($ob, tgl_spk)<='1'");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function priority($date,$gb,$ob,$karyawan){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(*),0) as bonus FROM reception WHERE $gb='$karyawan' AND express='0' AND priority='1' AND jenis='k' AND DATE($ob)='$date' AND DATEDIFF($ob, tgl_spk)<='1'");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

$date = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
$email = "quicknclean.indonesia@gmail.com, aruldyan14@gmail.com, nic.jonathan.susanto@gmail.com";
$subject = "Pencapaian dan Produktivitas Harian";
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Additional headers
$headers .= 'to :'.$email.'' . "\r\n";
$headers .= 'From: Pencapaian dan Produktivitas Harian Operasional <admin@qnclaundry.com>' . "\r\n";

$message = '<h3>Pencapaian dan Produktivitas Harian Operasional</h3>';
$message .= '<p><'.strip_tags(date('d M Y', strtotime($date))).'></p>';
$message .= '
	<div id="tabel-pencapaian">
		<table border="1" width="100%" style="font-size: 12px">
			<thead>
				<tr>
					<th rowspan="2" width="15%">Nama Karyawan</th>
					<th rowspan="2" width="19%">Lokasi</th>
					<th colspan="4">Jumlah</th>
					<th rowspan="2" width="9%">Poin Dasar</th>
					<th rowspan="2" width="9%">Poin Express</th>
					<th rowspan="2" width="9%">Poin Priority</th>
				</tr>
				<tr>
					<th width="9%">Berat (K)</th>
					<th width="9%">Item (P)</th>
					<th width="9%">Order</th>
					<th width="12%">Bayar (Rp)</th>
				</tr>
			</thead>
			<tbody>';
			foreach (data_operasional($date,"op_cuci","tgl_cuci") as $val):
$message .= ' 	<tr>
					<td>'.$val['karyawan'].'</td>
					<td>Cuci ('.$val['lokasi'].')</td>
					<td>'.jumlah_berat($date,"op_cuci","tgl_cuci",$val['karyawan']).'</td>
					<td>'.jumlah_item($date,"op_cuci","tgl_cuci",$val['karyawan']).'</td>
					<td>'.jumlah_order($date,"op_cuci","tgl_cuci",$val['karyawan']).'</td>
					<td>'.jumlah_bayar($date,"op_cuci","tgl_cuci",$val['karyawan']).'</td>
					<td>'.(jumlah_order($date,"op_cuci","tgl_cuci",$val['karyawan'])/2).'</td>
					<td>'.(express($date,"op_cuci","tgl_cuci",$val['karyawan'])/2).'</td>
					<td>'.(priority($date,"op_cuci","tgl_cuci",$val['karyawan'])/4).'</td>
				</tr>';
			endforeach;
$message .= '
			</tbody>
		</table>

		<br>
		<table border="1" width="100%" style="font-size: 12px">
			<thead>
				<tr>
					<th rowspan="2" width="15%">Nama Karyawan</th>
					<th rowspan="2" width="19%">Lokasi</th>
					<th colspan="4">Jumlah</th>
					<th rowspan="2" width="9%">Poin Dasar</th>
					<th rowspan="2" width="9%">Poin Express</th>
					<th rowspan="2" width="9%">Poin Priority</th>
				</tr>
				<tr>
					<th width="9%">Berat (K)</th>
					<th width="9%">Item (P)</th>
					<th width="9%">Order</th>
					<th width="12%">Bayar (Rp)</th>
				</tr>
			</thead>
			<tbody>';
			foreach (data_operasional($date,"op_pengering","tgl_pengering") as $val):
$message .=	'	<tr>
					<td>'.$val['karyawan'].'</td>
					<td>Pengering ('.$val['lokasi'].')</td>
					<td>'.jumlah_berat($date,"op_pengering","tgl_pengering",$val['karyawan']).'</td>
					<td>'.jumlah_item($date,"op_pengering","tgl_pengering",$val['karyawan']).'</td>
					<td>'.jumlah_order($date,"op_pengering","tgl_pengering",$val['karyawan']).'</td>
					<td>'.jumlah_bayar($date,"op_pengering","tgl_pengering",$val['karyawan']).'</td>
					<td>'.(jumlah_order($date,"op_pengering","tgl_pengering",$val['karyawan'])/2).'</td>
					<td>'.(express($date,"op_pengering","tgl_pengering",$val['karyawan'])/2).'</td>
					<td>'.(priority($date,"op_pengering","tgl_pengering",$val['karyawan'])/4).'</td>
				</tr>';
			endforeach;
$message .=	'</tbody>
		</table>

		<br>
		<table border="1" width="100%" style="font-size: 12px">
			<thead>
				<tr>
					<th rowspan="2" width="15%">Nama Karyawan</th>
					<th rowspan="2" width="19%">Lokasi</th>
					<th colspan="4">Jumlah</th>
					<th rowspan="2" width="9%">Poin Dasar</th>
					<th rowspan="2" width="9%">Poin Express</th>
					<th rowspan="2" width="9%">Poin Priority</th>
				</tr>
				<tr>
					<th width="9%">Berat (K)</th>
					<th width="9%">Item (P)</th>
					<th width="9%">Order</th>
					<th width="12%">Bayar (Rp)</th>
				</tr>
			</thead>
			<tbody>';
			foreach (data_operasional($date,"user_setrika","tgl_setrika") as $val):
$message .=	'	<tr>
					<td>'.$val['karyawan'].'</td>
					<td>Setrika ('.$val['lokasi'].')</td>
					<td>'.jumlah_berat($date,"user_setrika","tgl_setrika",$val['karyawan']).'</td>
					<td>'.jumlah_item($date,"user_setrika","tgl_setrika",$val['karyawan']).'</td>
					<td>'.jumlah_order($date,"user_setrika","tgl_setrika",$val['karyawan']).'</td>
					<td>'.jumlah_bayar($date,"user_setrika","tgl_setrika",$val['karyawan']).'</td>
					<td>'.jumlah_berat($date,"user_setrika","tgl_setrika",$val['karyawan']).'</td>
					<td>'.express($date,"user_setrika","tgl_setrika",$val['karyawan']).'</td>
					<td>0</td>
				</tr>';
			endforeach;
$message .=	'</tbody>
		</table>

		<br>
		<table border="1" width="100%" style="font-size: 12px">
			<thead>
				<tr>
					<th rowspan="2" width="15%">Nama Karyawan</th>
					<th rowspan="2" width="19%">Lokasi</th>
					<th colspan="4">Jumlah</th>
					<th rowspan="2" width="9%">Poin Dasar</th>
					<th rowspan="2" width="9%">Poin Express</th>
					<th rowspan="2" width="9%">Poin Priority</th>
				</tr>
				<tr>
					<th width="9%">Berat (K)</th>
					<th width="9%">Item (P)</th>
					<th width="9%">Order</th>
					<th width="12%">Bayar (Rp)</th>
				</tr>
			</thead>
			<tbody>';
			foreach (data_operasional($date,"user_packing","tgl_packing") as $val):
$message .= '	<tr>
					<td>'.$val['karyawan'].'</td>
					<td>Packing ('.$val['lokasi'].')</td>
					<td>'.jumlah_berat($date,"user_packing","tgl_packing",$val['karyawan']).'</td>
					<td>'.jumlah_item($date,"user_packing","tgl_packing",$val['karyawan']).'</td>
					<td>'.jumlah_order($date,"user_packing","tgl_packing",$val['karyawan']).'</td>
					<td>'.jumlah_bayar($date,"user_packing","tgl_packing",$val['karyawan']).'</td>
					<td>'.(jumlah_order($date,"user_packing","tgl_packing",$val['karyawan'])+jumlah_item($date,"user_packing","tgl_packing",$val['karyawan'])).'</td>
					<td>'.(express($date,"user_packing","tgl_packing",$val['karyawan'])).'</td>
					<td>0</td>
				</tr>';
			endforeach;
$message .= '</tbody>
		</table>
	</div>
	';

$message .= '
<br>
<table style="font-size: 12px; border-top: 1px double #000">
	<tr>
		<td>Keterangan:</td>
		<td></td>
	</tr>
	<tr>
		<td> </td>
		<td>Poin Dasar Cuci = 1/2*Order</td>
	</tr>
	<tr>
		<td> </td>
		<td>Poin Dasar Pengering = 1/2*Order</td>
	</tr>
	<tr>
		<td> </td>
		<td>Poin Dasar Setrika = Berat</td>
	</tr>
	<tr>
		<td> </td>
		<td>Poin Dasar Packing = Order+Item(p)</td>
	</tr>
	<tr>
		<td> </td>
		<td>Poin Express Cuci = 1/2*Order Express (Jika Order diproses <= 1 hari dari tanggal SPK)</td>
	</tr>
	<tr>
		<td> </td>
		<td>Poin Express Pengering = 1/2*Order Express (Jika Order diproses <= 1 hari dari tanggal SPK)</td>
	</tr>
	<tr>
		<td> </td>
		<td>Poin Express Setrika = Order Express</td>
	</tr>
	<tr>
		<td> </td>
		<td>Poin Express Packing = Order Express</td>
	</tr>
	<tr>
		<td> </td>
		<td>Poin Priority Cuci = 1/4*Order Priority</td>
	</tr>
	<tr>
		<td> </td>
		<td>Poin Priority Pengering = 1/4*Order Priority</td>
	</tr>
	<tr>
		<td> </td>
		<td>Poin Priority Setrika dan Packing = 0 (Tidak ada)</td>
	</tr>
</table>
';

mail($email, $subject, $message, $headers);

?>





	

