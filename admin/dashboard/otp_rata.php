<?php 



function rata_packing($jenis,$workshop,$startDate,$endDate){
	global $con;
	$sql = $con->query("SELECT AVG(jum_date) AS packing FROM (SELECT HOUR(TIMEDIFF(a.tgl_packing, a.tgl_input)) AS jum_date FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND a.workshop='$workshop' AND a.jenis='$jenis' AND a.packing=true AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AS inner_query ");
	$data = $sql->fetch_array()[0];
	return round($data) ;
}

function rata_kembali($jenis,$outlet,$startDate,$endDate){
	global $con;
	$sql = $con->query("SELECT AVG(jum_date) AS packing FROM (SELECT HOUR(TIMEDIFF(a.tgl_kembali, a.tgl_input)) AS jum_date FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND a.nama_outlet='$outlet' AND a.jenis='$jenis' AND a.kembali=true AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AS inner_query ");
	$data = $sql->fetch_array()[0];
	return round($data);
}

function rata_kembali2($jenis,$outlet,$startDate,$endDate){
	global $con;
	$sql = $con->query("SELECT AVG(jum_date) AS packing FROM (SELECT HOUR(TIMEDIFF(a.tgl_packing, a.tgl_input)) AS jum_date FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND a.nama_outlet='$outlet' AND a.jenis='$jenis' AND a.packing=true AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AS inner_query ");
	$data = $sql->fetch_array()[0];
	return round($data);
}

echo '
	<div class="table-responsive">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>Workshop</th>
					<th>Kiloan</th>
					<th>Potongan</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Toddopuli</td>
					<td style="text-align: center">'.rata_packing('k','Toddopuli',$startDate,$endDate).' Jam</td>
					<td style="text-align: center">'.rata_packing('p','Toddopuli',$startDate,$endDate).' Jam</td>
				</tr>
				<tr>
					<td>Antang</td>
					<td style="text-align: center">'.rata_packing('k','Daya',$startDate,$endDate).' Jam</td>
					<td style="text-align: center">'.rata_packing('p','Daya',$startDate,$endDate).' Jam</td>
				</tr>
			</tbody>
		</table>
	</div>


	<div class="table-responsive">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>Outlet</th>
					<th>Kiloan</th>
					<th>Potongan</th>
				</tr>
			</thead>
			<tbody>
				';

				$sql = $con->query("SELECT nama_outlet FROM outlet WHERE Kota='Makassar' AND id_outlet<>'4' AND id_outlet<>'12' AND id_outlet<>'20' ORDER BY id_outlet ASC ");
				while($data = $sql->fetch_array()) {
				if($data[0]!="Antang" AND $data[0]!="Toddopuli" AND $data[0]!="support" ){
					$outlet = $data[0];
					$data = rata_kembali('k',$outlet,$startDate,$endDate);
					$data2 = rata_kembali('p',$outlet,$startDate,$endDate);
				} else {
					$outlet = $data[0];
					$data = rata_kembali2('k',$outlet,$startDate,$endDate);
					$data2 = rata_kembali2('p',$outlet,$startDate,$endDate);
				}
				    
					echo '
				<tr>
					<td>'.$outlet.'</td>
					<td style="text-align: center">'.$data.' Jam</td>
					<td style="text-align: center">'.$data2.' Jam</td>
				</tr>
					';				 
				}

				echo '
			</tbody>
		</table>
	</div>

				

				
';

?>


