
<?php 
include '../../config.php';

$sql = $con->query("SELECT DISTINCT kasir, tgl_transaksi FROM penjualan_kasir WHERE DATE(tgl_transaksi) BETWEEN '$_GET[tgl]' AND '$_GET[tgl2]' ");


include '../fungsi/penjualan_laundry.php';

function rupiah($angka)
{
  $jadi = number_format($angka,0,',','.');
  return $jadi;
}
?>

<div class="dropdown">
    <a class="dropdown-toggle btn btn-primary" data-toggle="dropdown" href="#">
        <i class="fa fa-download"></i> Excel
    </a>
    <ul class="dropdown-menu">
        <li><a href="exp_penjualan_laundry.php?tgl=<?= $_GET['tgl'] ?>&tgl2=<?= $_GET['tgl2'] ?>">Bawaan</a></li>
	<li><a href="exp_penjualan_laundry2.php?tgl=<?= $_GET['tgl'] ?>&tgl2=<?= $_GET['tgl2'] ?>">Per Produk</a></li>
    </ul>
</div>
<br>
<br>

<div class="table-responsive">
	<table class="table table-condensed table-striped table-bordered table-hover" id="table1" style="font-size: 11px">
		<thead>
			<tr>
				<th rowspan="2" style="vertical-align: middle;">Daily Sales Date</th>
				<th rowspan="2" style="vertical-align: middle;">Reception</th>
				<th colspan="3">Product</th>
				<th rowspan="2" style="vertical-align: middle;">Sum Sales Product</th>
				<th colspan="9">Payment Method</th>
			</tr>
			<tr>
				<th>Laundry</th>
				<th>Deposit</th>
				<th>Membership</th>
				<th>Cash</th>
				<th>BNI</th>
				<th>BRI</th>
				<th>BCA</th>
				<th>MANDIRI</th>
				<th>OVO</th>
				<th>Kuota</th>
				<th>Cashback</th>
				<th>Piutang</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			while($dataa = $sql->fetch_array())
			{
				$userId = $dataa['kasir'];
				$tgl = date('Y-m-d', strtotime($dataa['tgl_transaksi']));
				$laundry = jumlah($userId,$tgl,'laundry');
				$deposit = jumlah($userId,$tgl,'deposit');
				$membership = jumlah($userId,$tgl,'membership');
				$total = $laundry+$membership+$deposit;

				$cash = jumlah_bayar($userId,$tgl,'cash');
				$bni = jumlah_bayar($userId,$tgl,'bni');
				$bri = jumlah_bayar($userId,$tgl,'bri');
				$bca = jumlah_bayar($userId,$tgl,'bca');
				$mandiri = jumlah_bayar($userId,$tgl,'mandiri');
				$ovo = jumlah_bayar($userId,$tgl,'ovo');
				$kuota = jumlah_bayar($userId,$tgl,'kuota');
				$cashback = jumlah_bayar($userId,$tgl,'cashback');
				$piutang = jumlah_bayar($userId,$tgl,'piutang');

			
				echo '
				<tr>
					<td>'.$tgl.'</td>
					<td>'.ucwords($userId).'</td>
					<td>'.rupiah($laundry).'</td>
					<td>'.rupiah($deposit).'</td>
					<td>'.rupiah($membership).'</td>
					<td>'.rupiah($total).'</td>
					<td>'.rupiah($cash).'</td>
					<td>'.rupiah($bni).'</td>
					<td>'.rupiah($bri).'</td>
					<td>'.rupiah($bca).'</td>
					<td>'.rupiah($mandiri).'</td>
					<td>'.rupiah($ovo).'</td>
					<td>'.rupiah($kuota).'</td>
					<td>'.rupiah($cashback).'</td>
					<td>'.rupiah($piutang).'</td>
				</tr>

				';
			}
			?>
				
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$('#table1').dataTable();
</script>