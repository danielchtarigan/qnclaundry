<?php 

include '../config.php';
date_default_timezone_set('Asia/Makassar');
$nowDate = date('Y-m-d');

function kas_delivery($user_id) {
	global $con, $nowDate;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE cara_bayar='cash' AND lunas=true AND nama_reception='$user_id' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') <= '$nowDate'");
	$data = mysqli_fetch_row($sql);
	return $data[0];
}

function biaya_delivery($user_id) {
	global $con, $nowDate;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(charge),0) AS total FROM delivery WHERE nama_pengantar='$user_id' AND DATE_FORMAT(tgl_ok, '%Y-%m-%d') <= '$nowDate'");
	$data = mysqli_fetch_row($sql);
	return $data[0];
}

function setoran_delivery($user_id) {
	global $con, $nowDate;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_delivery WHERE nama_delivery='$user_id' AND DATE_FORMAT(tanggal, '%Y-%m-%d') <= '$nowDate'");
	$data = mysqli_fetch_row($sql);
	return $data[0];
}


function saldo_delivery($user_id) {
	$data['kas_order'] = kas_delivery($user_id);	
	$data['setoran_delivery'] = setoran_delivery($user_id);
	$data['charge_delivery'] = biaya_delivery($user_id)-$data['setoran_delivery'];	
	if($data['charge_delivery']<0){
		$data['kas_order'] = $data['kas_order']+$data['charge_delivery'];
		$data['charge_delivery'] = 0;
	}	
	$data['saldo'] = $data['charge_delivery'];
	return $data;
}
?>

<!-- <table>
	<thead>
		<tr>
			<th>Tanggal Transaksi</th>
			<th>Nama Delivery</th>
			<th>Jenis Transaksi</th>
			<th>Jumlah Transaksi</th>
			<th></th>
		</tr>
	</thead>
</table> -->

<h3>Saldo Akhir Delivery</h3>

<?php 
$query = mysqli_query($con, "SELECT * FROM user WHERE level='Delivery' AND aktif='Ya' AND subagen=''");
while ($result = $query->fetch_array()) {
	$user_delivery = $result['name'];
	$data = saldo_delivery($user_delivery);

	echo '<b>'.$user_delivery.' = '.number_format($data['saldo']).'</b><br>';
}

?>
