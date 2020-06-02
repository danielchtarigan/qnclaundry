<?php 

$startDate = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));
$endDate = date('Y-m-d', strtotime('-1 days', strtotime(date('Y-m-d'))));


function jumlah($outlet,$jenis,$startDate,$endDate) 
{
	global $con;
	$sql = $con->query("SELECT SUM(total_bayar) FROM reception WHERE nama_outlet='$outlet' AND jenis='$jenis' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
	$data2 = $sql->fetch_array()[0];
	return $data2;
}

function membership($outlet,$startDate,$endDate) {
	global $con;
	$sql = $con->query("SELECT SUM(total) FROM faktur_penjualan WHERE jenis_transaksi='membership' AND nama_outlet='$outlet' AND DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
	$data2 = $sql->fetch_array()[0];
	return $data2;
}


?>


<div class="disp-omset panel-body btn-default table-responsive" style="display: none;">
<table class="table table-condensed">
	<thead>
		<tr>
			<th>Nama Outlet</th>
			<th>Kiloan</th>
			<th>Potongan</th>
			<th>Membership</th>
			<th>Jumlah</th>
			<th>Rata Harian</th>
		</tr>
	</thead>
	
	<tbody>
		<?php 
		$tKiloan = 0;
		$tPotongan = 0;
		$tMember = 0 ;

		$sql = $con->query("SELECT nama_outlet FROM outlet WHERE Kota='$cabang' ORDER BY nama_outlet ASC");
		while($data = $sql->fetch_array()){
			$kiloan = jumlah($data['nama_outlet'],'k',$startDate,$endDate);
			$potongan = jumlah($data['nama_outlet'],'p',$startDate,$endDate);
			$membership = membership($data['nama_outlet'],$startDate,$endDate);
			$jumlah = $kiloan+$potongan+$membership;
			$rataHarian = $jumlah/7;

			$tKiloan += $kiloan;
			$tPotongan += $potongan;
			$tMember += $membership ;
			$tTotal = $tKiloan+$tPotongan+$tMember;
			$tRataHarian = $tTotal/7;

			echo '
			<tr>
				<td>'.$data['nama_outlet'].'</td>
				<td style="text-align: right">'.number_format($kiloan).'</td>
				<td style="text-align: right">'.number_format($potongan).'</td>
				<td style="text-align: right">'.number_format($membership).'</td>
				<td style="text-align: right">'.number_format($jumlah).'</td>
				<td style="text-align: right">'.number_format(round($rataHarian)).'</td>
			</tr>
			';
		}
		?>
	</tbody>



	<tfoot>
		<tr>
			<th style="text-align: right">Total</th>
			<th><?= number_format($tKiloan) ?></th>
			<th><?= number_format($tPotongan) ?></th>
			<th><?= number_format($tMember) ?></th>
			<th><?= number_format($tTotal) ?></th>
			<th><?= number_format(round($tRataHarian)) ?></th>
		</tr>
	</tfoot>
</table>
</div>

<div class="disp-omset2 table-responsive">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th>Kiloan</th>
				<th>Potongan</th>
				<th>Membership</th>
				<th>Jumlah</th>
				<th>Rata Harian</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th><?= number_format($tKiloan) ?></th>
				<th><?= number_format($tPotongan) ?></th>
				<th><?= number_format($tMember) ?></th>
				<th><?= number_format($tTotal) ?></th>
				<th><?= number_format(round($tRataHarian)) ?></th>
			</tr>
	</tfoot>
	</table>
</div>



<a href="" class="btn btn-info btn-block btn-oms">Tabel Omset</a>
