<?php 
include '../config.php';

$startDate = $_GET['start'];
$endDate = $_GET['end'];

function all_debet($startDate){
	global $con;
	$sql = mysqli_query($con, "SELECT SUM(nominal) AS jumlah FROM jurnal_u WHERE balance='d' AND status='0' AND DATE_FORMAT(tgl_input, '%Y/%m/%d')<'$startDate'");
	$data = mysqli_fetch_row($sql);
	return $data[0];
}

function all_kredit($startDate){
	global $con;
	$sql = mysqli_query($con, "SELECT SUM(nominal) AS jumlah FROM jurnal_u WHERE balance='k' AND status='0' AND DATE_FORMAT(tgl_input, '%Y/%m/%d')<'$startDate'");
	$data = mysqli_fetch_row($sql);
	return $data[0];
}


		
function rup($angka){
	$rp = 'Rp '.number_format($angka,0);
	return $rp;
}

$saldoAwal = all_debet($startDate)-all_kredit($startDate);
$sql = mysqli_query($con, "SELECT * FROM nama_akun ");

while($data=mysqli_fetch_assoc($sql)){
	$sqlj = mysqli_query($con, "SELECT * FROM jurnal_u WHERE kode_item LIKE '$data[kode_nama_akun]%' AND status='0' AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate' ");
	if(mysqli_num_rows($sqlj)>0) {
		?>

		<table class="table table-bordered">
			<thead>
				<tr class="trx">
					<td colspan="5" style="font-weight: bolder;">Nama Akun : &nbsp; <?= $data['nama_akun'] ?> </td>
					<td colspan="2" style="text-align: right; font-weight: bolder;">Kode Akun : &nbsp; <?= $data['kode_nama_akun'] ?> </td>
				</tr>
				<tr>
					<th rowspan="2" style="vertical-align: middle;">Tanggal</th>
					<th rowspan="2" style="vertical-align: middle;">Keterangan</th>
					<th class="" rowspan="2" style="vertical-align: middle;">Ref</th>
					<th rowspan="2" style="vertical-align: middle;">Debet</th>
					<th rowspan="2" style="vertical-align: middle;">Kredit</th>
					<th colspan="2" style="vertical-align: middle;">Saldo</th>
				</tr>
				<tr>
					<th>Debet</th>
					<th>Kredit</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				while($dbs = mysqli_fetch_array($sqlj)){
					$poinDate = date('Y-m-d', strtotime($dbs['tgl_input']));
					$ka = substr($dbs['kode_item'],0,7);
					?>
					<tr>
						<td class="hidden"><?php echo $no; ?></td>
						<td width="15%"><?php echo date('Y M d', strtotime($dbs['tgl_input'])) ?></td>
						<td width="30%"><?php echo $dbs['nama_item'] ?></td>
						<td class="" align="center"><?php echo date('m', strtotime($poinDate)).sprintf('%03s',$dbs['id']) ;  ?></td>
						<td align="right"><?php if($dbs['balance']=="d") echo rup($dbs['nominal']); else echo "-" ?></td>
						<td align="right"><?php if($dbs['balance']=="k") echo rup($dbs['nominal']); else echo "-" ?></td>
						<?php 
							if($dbs['balance']=="d") {
								$debet = $dbs['nominal'];
								$kredit = 0;
							} else if($dbs['balance']=="k") {
								$debet = 0;
								$kredit =  $dbs['nominal'];
							}

            				if($no==1){
            					$saldo = $debet-$kredit+$saldoAwal;
            				}else{
            					$saldo = $saldo+$debet-$kredit;
            				}
						?>
						<td align="right"><?php if($saldo>0) echo rup($saldo); else echo "-" ?></td>
						<td align="right"><?php if($saldo<0) echo rup($saldo); else echo "-" ?></td>
					</tr>

					<?php
					$no++;
				}

				?>
			</tbody>
		</table>

		<?php
	}
}

?>

<style type="text/css">
    .table {
        border : 1px solid #ddd;
        border-radius: 10px;
        width : 860px;
        height : 60px;
        padding: 25px;
    }
	tr {
	  	font: normal 12px Arial, Calibri, sans-serif;
	  	background: #fff;
	}

	th, td{
		padding: 5px 10px;
	  	border: 2px solid #D2F975;
	}

	.trx {
		background: #e7e7e7;
	}


</style>


<script type="text/javascript">
	$('.btn-range').click(function(){
		$('.form-horizontal').removeClass('hidden');
		$('.btn-range').addClass('hidden');
	});
	
</script>