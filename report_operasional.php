<?php 
include 'config.php';
date_default_timezone_set('Asia/Makassar');


function data_operasional($m,$y,$ob){
	global $con;
	$tabel1 = "SELECT * FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND YEAR($ob)='$y' AND MONTH($ob)='$m' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND status_order=''";
	$result = $con->query($tabel1."ORDER BY $ob ASC");
	while($row = $result->fetch_array()){
		$data[] = $row;
	} 
	return $data;
}

$m = '01';
$y = '2019';

if(isset($_POST['submit'])){
	$m = $_POST['month'];
	$y = $_POST['year'];
}

?>

<form method="POST">
	<label>Bulan</label>
	<select name="month">
		<?php 
		for($i=1;$i<=12;$i++){
			$i = sprintf('%02s',$i);
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		?>
		
	</select>
	<label>Tahun</label>
	<select name="year">
		<?php 
		for($i=0;$i<=5;$i++){
			$i = date('Y')-$i;
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		?>		
	</select>
	<input type="submit" name="submit" value="Submit">
</form>


<h3>Laporan Operasional</h3><button onclick="toggleTag(1)">S/H</button>


<table border="1" id="op1">
	<thead>
		<tr>
			<th rowspan="2">Tanggal Workshop</th>
			<th rowspan="2">No Order</th>
			<th rowspan="2">Workshop</th>
			<th rowspan="2">Jenis Item</th>
			<th rowspan="2">Jumlah Bayar</th>
			<th rowspan="2">Jumlah Item</th>
			<th rowspan="2">Berat Item</th>
			<th colspan="4">Operator</th>
			<th rowspan="2">Status Terakhir</th>
		</tr>
		<tr>
			<th>Cuci</th>
			<th>Pengering</th>
			<th>Setrika</th>
			<th>Packing</th>
		</tr>
	</thead>
	<tbody>
		<?php 				
		foreach (data_operasional($m,$y,"tgl_workshop") as $key) {
			if ($key['ambil']=="1") {
				$status="Ambil";
			} elseif($key['kembali']=="1"){
				$status="Kembali";
			} elseif($key['packing']=="1"){
				$status="Packing";
			} elseif($key['setrika']=="1"){
				$status="Setrika";
			} elseif($key['pengering']=="1"){
				$status="Pengering";
			} elseif($key['cuci']=="1"){
				$status="Cuci";
			} else{
				$status="Checkin ".$key['workshop'];
			}
			if($key['workshop']=="Daya"){
				$key['workshop']="Antang";
			}

			echo '
			<tr>
			<td>'.date('Y-m-d', strtotime($key['tgl_workshop'])).'</td>
			<td>'.$key['no_nota'].'</td>
			<td>'.$key['workshop'].'</td>
			<td>'.$key['jenis'].'</td>
			<td>'.$key['total_bayar'].'</td>
			<td>'.$key['jumlah'].'</td>
			<td>'.$key['berat'].'</td>
			<td>'.$key['op_cuci'].'</td>
			<td>'.$key['op_pengering'].'</td>
			<td>'.$key['user_setrika'].'</td>
			<td>'.$key['user_packing'].'</td>
			<td>'.$status.'</td>
			</tr>
			';
		}

		?>
	</tbody>
</table>

<h3>Laporan Cuci</h3><button onclick="toggleTag(2)">S/H</button>
<table border="1" id="op2">
	<thead>
		<tr>
			<th>Tanggal Cuci</th>
			<th>No Order</th>
			<th>Workshop</th>
			<th>Jenis Item</th>
			<th>Jumlah Bayar</th>
			<th>Jumlah Item</th>
			<th>Berat Item</th>
			<th>Operator</th>
			<th>Status Terakhir</th>
		</tr>
	</thead>
	<tbody>
		<?php 				
		foreach (data_operasional($m,$y,"tgl_cuci") as $key) {
			if ($key['ambil']=="1") {
				$status="Ambil";
			} elseif($key['kembali']=="1"){
				$status="Kembali";
			} elseif($key['packing']=="1"){
				$status="Packing";
			} elseif($key['setrika']=="1"){
				$status="Setrika";
			} elseif($key['pengering']=="1"){
				$status="Pengering";
			} elseif($key['cuci']=="1"){
				$status="Cuci";
			} else{
				$status="Checkin ".$key['workshop'];
			}
			if($key['workshop']=="Daya"){
				$key['workshop']="Antang";
			}

			echo '
			<tr>
			<td>'.date('Y-m-d', strtotime($key['tgl_cuci'])).'</td>
			<td>'.$key['no_nota'].'</td>
			<td>'.$key['workshop'].'</td>
			<td>'.$key['jenis'].'</td>
			<td>'.$key['total_bayar'].'</td>
			<td>'.$key['jumlah'].'</td>
			<td>'.$key['berat'].'</td>
			<td>'.$key['op_cuci'].'</td>
			<td>'.$status.'</td>
			</tr>
			';
		}

		?>
	</tbody>
</table>


<h3>Laporan Pengering</h3><button onclick="toggleTag(3)">S/H</button>
<table border="1" id="op3">
	<thead>
		<tr>
			<th>Tanggal Kering</th>
			<th>No Order</th>
			<th>Workshop</th>
			<th>Jenis Item</th>
			<th>Jumlah Bayar</th>
			<th>Jumlah Item</th>
			<th>Berat Item</th>
			<th>Operator</th>
			<th>Status Terakhir</th>
		</tr>
	</thead>
	<tbody>
		<?php 				
		foreach (data_operasional($m,$y,"tgl_pengering") as $key) {
			if ($key['ambil']=="1") {
				$status="Ambil";
			} elseif($key['kembali']=="1"){
				$status="Kembali";
			} elseif($key['packing']=="1"){
				$status="Packing";
			} elseif($key['setrika']=="1"){
				$status="Setrika";
			} elseif($key['pengering']=="1"){
				$status="Pengering";
			} elseif($key['cuci']=="1"){
				$status="Cuci";
			} else{
				$status="Checkin ".$key['workshop'];
			}
			if($key['workshop']=="Daya"){
				$key['workshop']="Antang";
			}

			echo '
			<tr>
			<td>'.date('Y-m-d', strtotime($key['tgl_pengering'])).'</td>
			<td>'.$key['no_nota'].'</td>
			<td>'.$key['workshop'].'</td>
			<td>'.$key['jenis'].'</td>
			<td>'.$key['total_bayar'].'</td>
			<td>'.$key['jumlah'].'</td>
			<td>'.$key['berat'].'</td>
			<td>'.$key['op_pengering'].'</td>
			<td>'.$status.'</td>
			</tr>
			';
		}

		?>
	</tbody>
</table>


<h3>Laporan Setrika</h3><button onclick="toggleTag(4)">S/H</button>
<table border="1" id="op4">
	<thead>
		<tr>
			<th>Tanggal Setrika</th>
			<th>No Order</th>
			<th>Workshop</th>
			<th>Jenis Item</th>
			<th>Jumlah Bayar</th>
			<th>Jumlah Item</th>
			<th>Berat Item</th>
			<th>Operator</th>
			<th>Status Terakhir</th>
		</tr>
	</thead>
	<tbody>
		<?php 				
		foreach (data_operasional($m,$y,"tgl_setrika") as $key) {
			if ($key['ambil']=="1") {
				$status="Ambil";
			} elseif($key['kembali']=="1"){
				$status="Kembali";
			} elseif($key['packing']=="1"){
				$status="Packing";
			} elseif($key['setrika']=="1"){
				$status="Setrika";
			} elseif($key['pengering']=="1"){
				$status="Pengering";
			} elseif($key['cuci']=="1"){
				$status="Cuci";
			} else{
				$status="Checkin ".$key['workshop'];
			}
			if($key['workshop']=="Daya"){
				$key['workshop']="Antang";
			}

			echo '
			<tr>
			<td>'.date('Y-m-d', strtotime($key['tgl_setrika'])).'</td>
			<td>'.$key['no_nota'].'</td>
			<td>'.$key['workshop'].'</td>
			<td>'.$key['jenis'].'</td>
			<td>'.$key['total_bayar'].'</td>
			<td>'.$key['jumlah'].'</td>
			<td>'.$key['berat'].'</td>
			<td>'.$key['user_setrika'].'</td>
			<td>'.$status.'</td>
			</tr>
			';
		}

		?>
	</tbody>
</table>


<h3>Laporan Packing</h3><button onclick="toggleTag(5)">S/H</button>
<table border="1" id="op5">
	<thead>
		<tr>
			<th>Tanggal Packing</th>
			<th>No Order</th>
			<th>Workshop</th>
			<th>Jenis Item</th>
			<th>Jumlah Bayar</th>
			<th>Jumlah Item</th>
			<th>Berat Item</th>
			<th>Operator</th>
			<th>Status Terakhir</th>
		</tr>
	</thead>
	<tbody>
		<?php 				
		foreach (data_operasional($m,$y,"tgl_packing") as $key) {
			if ($key['ambil']=="1") {
				$status="Ambil";
			} elseif($key['kembali']=="1"){
				$status="Kembali";
			} elseif($key['packing']=="1"){
				$status="Packing";
			} elseif($key['setrika']=="1"){
				$status="Setrika";
			} elseif($key['pengering']=="1"){
				$status="Pengering";
			} elseif($key['cuci']=="1"){
				$status="Cuci";
			} else{
				$status="Checkin ".$key['workshop'];
			}
			if($key['workshop']=="Daya"){
				$key['workshop']="Antang";
			}

			echo '
			<tr>
			<td>'.date('Y-m-d', strtotime($key['tgl_packing'])).'</td>
			<td>'.$key['no_nota'].'</td>
			<td>'.$key['workshop'].'</td>
			<td>'.$key['jenis'].'</td>
			<td>'.$key['total_bayar'].'</td>
			<td>'.$key['jumlah'].'</td>
			<td>'.$key['berat'].'</td>
			<td>'.$key['user_packing'].'</td>
			<td>'.$status.'</td>
			</tr>
			';
		}

		?>
	</tbody>
</table>

<h3>Laporan Penjualan</h3><button onclick="toggleTag(6)">S/H</button>
<table border="1" id="op6">
	<thead>
		<tr>
			<th>Tanggal Masuk</th>
			<th>No Order</th>
			<th>Outlet</th>
			<th>Jenis Item</th>
			<th>Jumlah Bayar</th>
			<th>Jumlah Item</th>
			<th>Berat Item</th>
			<th>Reception</th>
			<th>Status Terakhir</th>
		</tr>
	</thead>
	<tbody>
		<?php 				
		foreach (data_operasional($m,$y,"tgl_input") as $key) {
			if ($key['ambil']=="1") {
				$status="Ambil";
			} elseif($key['kembali']=="1"){
				$status="Kembali";
			} elseif($key['packing']=="1"){
				$status="Packing";
			} elseif($key['setrika']=="1"){
				$status="Setrika";
			} elseif($key['pengering']=="1"){
				$status="Pengering";
			} elseif($key['cuci']=="1"){
				$status="Cuci";
			} else{
				$status="Checkin ".$key['workshop'];
			}
			
			echo '
			<tr>
			<td>'.date('Y-m-d', strtotime($key['tgl_input'])).'</td>
			<td>'.$key['no_nota'].'</td>
			<td>'.$key['nama_outlet'].'</td>
			<td>'.$key['jenis'].'</td>
			<td>'.$key['total_bayar'].'</td>
			<td>'.$key['jumlah'].'</td>
			<td>'.$key['berat'].'</td>
			<td>'.$key['nama_reception'].'</td>
			<td>'.$status.'</td>
			</tr>
			';
		}

		?>
	</tbody>
</table>

<h3>Laporan SPK</h3><button onclick="toggleTag(7)">S/H</button>
<table border="1" id="op7">
	<thead>
		<tr>
			<th>Tanggal SPK</th>
			<th>No Order</th>
			<th>Outlet</th>
			<th>Jenis Item</th>
			<th>Jumlah Bayar</th>
			<th>Jumlah Item</th>
			<th>Berat Item</th>
			<th>Reception</th>
			<th>Status Terakhir</th>
		</tr>
	</thead>
	<tbody>
		<?php 				
		foreach (data_operasional($m,$y,"tgl_spk") as $key) {
			if ($key['ambil']=="1") {
				$status="Ambil";
			} elseif($key['kembali']=="1"){
				$status="Kembali";
			} elseif($key['packing']=="1"){
				$status="Packing";
			} elseif($key['setrika']=="1"){
				$status="Setrika";
			} elseif($key['pengering']=="1"){
				$status="Pengering";
			} elseif($key['cuci']=="1"){
				$status="Cuci";
			} else{
				$status="Checkin ".$key['workshop'];
			}
			echo '
			<tr>
			<td>'.date('Y-m-d', strtotime($key['tgl_spk'])).'</td>
			<td>'.$key['no_nota'].'</td>
			<td>'.$key['nama_outlet'].'</td>
			<td>'.$key['jenis'].'</td>
			<td>'.$key['total_bayar'].'</td>
			<td>'.$key['jumlah'].'</td>
			<td>'.$key['berat'].'</td>
			<td>'.$key['rcp_spk'].'</td>
			<td>'.$status.'</td>
			</tr>
			';
		}

		?>
	</tbody>
</table>


<script type="text/javascript">
	function toggleTag (i){
		var x = document.getElementById("op"+i);
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
</script>