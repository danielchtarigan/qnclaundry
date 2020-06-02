<?php 

date_default_timezone_set('Asia/Makassar');

$cst = "select *from customer";

$datetop1 = date('Y-m-d', strtotime('- 7 day', strtotime(date('Y-m-d'))));
$datetop2 = date('Y-m-d', strtotime('- 1 day', strtotime(date('Y-m-d'))));
$tanggaltop = strtotime(date('Y-m-d'));

?>

<style type="text/css">	
	.urut{
		text-align: center;
	}
</style>

<div class="table-responsive">
	<table style="font-size: 12px; font-family: cambria; background-color: #cfd2c8;" class="table table-bordered table-hover">
		<thead>
			<tr">
				<th class="urut">No</th>
				<th style="text-align: center">Nama Customer</th>
				<th style="text-align: center">Level</th>
				<th style="text-align: center">Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php			
				$no = 1;
				$total = mysqli_query($con, "select SUM(b.total) as total, b.id_customer as id, a.nama_customer as nama, a.jenis_member as jm, a.tgl_akhir as akhirm, a.lgn as lgn, a.sisa_kuota as kuota from (".$cst.") as a INNER JOIN faktur_penjualan as b ON a.id=b.id_customer where (DATE_FORMAT(b.tgl_transaksi, '%Y-%m-%d') between '$datetop1' and '$datetop2') and cara_bayar<>'kuota' group by b.id_customer order by SUM(b.total) DESC LIMIT 10");
				while($qt = mysqli_fetch_array($total)){
					$membera = strtotime($qt['akhirm']);		

					if(($qt['jm']<>'' && $membera>$tanggaltop) && ($qt['lgn']==1 && $qt['kuota']>10000)){
						$c = "Langganan dan Membership";
					}
					else if($qt['jm']<>'' && $membera>$tanggaltop){
						$c = "Membership";
					}
					else if($qt['lgn']==1 && $qt['kuota']>10000){
						$c = "Langganan";
					}					
					else{
						$c = "Normal";
					}
					?>
				<td class="urut"><?php echo $no++ ?></td>
				<td><?php echo $qt['nama'] ?></td>
				<td><?php echo $c ?></td>
				<td style="text-align: right"><?php echo rupiah ($qt['total']) ?></td>		
			</tr>
			<?php
				}
				?>
		</tbody>
	</table>
</div>

<p style="font-size:9px; font-style: oblique; font-weight: bold">Data ini berdasarkan total pembayaran customer (bayar order bukan kuota, Membership, Deposit langganan)</p>