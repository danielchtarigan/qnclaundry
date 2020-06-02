<?php
include 'config.php';
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$newdate = strtotime ( '-30 day' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-d' , $newdate );
$newdate2 = strtotime ( '-40 day' , strtotime ( $date ) ) ;
$newdate2 = date ( 'Y-m-d' , $newdate2 );

$tanggalb = date('d', (strtotime('+7 day', strtotime($date))));
$bulanb = date('m', (strtotime('+7 day', strtotime($date))));
$tahunb = date('y', (strtotime('+7 day', strtotime($date))));

$listbulanb = array(
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	);

?>


<script>
	$(document).ready(function()
		{
			$('#tabelcst').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			});

		});
</script>

<div class="col-lg-12 col-md-offset-0">
	<div class="panel panel-default">
		<div class="panel-body">
<h4><strong>Daftar Customer Masuk Type C (TSM, GPN, SSD, RYL, BTP, LDK, ATG, DYA)</strong></h4>
Klik Tombol <button type="button" class="btn btn-primary btn-xs" style="background-color:#F00; border-color:#F00;" id="test" name="test">ON</button> Untuk Mengaktifkan Harga Rp7600/kg<br>
<div class="table-responsive">
	<table class="table table-condensed table-striped table-hover table-bordered" id="tabelcst" style="font-size: 8pt">
		<thead>
			<tr>
				<th width="3%">No</th>
				<th>Nama Customer</th>
				<th>Telepon</th>
				<th>Frekuensi</th>
				<th>Jumlah Transaksi</th>
				<th>Isi Pesan</th>
				<th>Aktifkan</th>
			</tr>
		</thead>
		<tbody>			
				<?php

$no=1;
$rrecept = mysqli_query($con, "SELECT DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal,id_customer,nama_customer from reception where (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newdate2' and '$newdate') and (nama_outlet<>'Landak' or nama_outlet<>'Baruga' or nama_outlet<>'Toddopuli' or nama_outlet<>'Boulevard') group by id_customer order by DATE_FORMAT(tgl_input, '%Y-%m-%d') DESC LIMIT 100");
if(mysqli_num_rows($rrecept)>0){
while($rc = mysqli_fetch_array($rrecept)){
	$tgl = $rc['tanggal'];	
	$qbayar = mysqli_fetch_array(mysqli_query($con, "select COUNT(DISTINCT DATE_FORMAT(tgl_input, '%Y-%m-%d')) as frek, sum(total_bayar) as bayar from reception where id_customer='$rc[id_customer]' and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newdate2' and '$newdate')"));
	if($qbayar['bayar']<200000 and $qbayar['frek']<4){
		$rcst = mysqli_query ($con, "select *from customer where id='$rc[id_customer]'");
		WHILE($qcst = mysqli_fetch_array($rcst)){
		$cst = $qcst['id'];
		$ncst = $qcst['nama_customer'];	
		$typec = $qcst['type_c'];
		$isipesan = "Anda mendapatkan harga khusus Rp.7600/Kg Laundry kiloan di QNC LAUNDRY. S&K Berlaku";
		$message = "QNCLAUNDRY 
		Bpk/Ibu $ncst, $isipesan. Berlaku s/d $tanggalb $listbulanb[$bulanb] $tahunb";		
 
	?>
			<tr>
				<td><?php echo $no++;?></td>
				<td><?php echo $ncst;?></td>
				<td><?php echo $qcst['no_telp'];?></td>
				<td><?php echo $qbayar['frek'];?></td>
				<td><?php echo $qbayar['bayar'];?></td>
				<td><?php echo $message; ?></td>
				<td><a href="act_customer_c.php?id=<?php echo $cst; ?>&type_c=<?php echo $typec; ?>&pesan=<?php echo $message; ?>" ><?php if($typec==0) echo '<button type="button" class="btn btn-primary btn-sm" style="background-color:#F00; border-color:#F00;" id="test" name="test">ON</button>'; else echo '<button type="button" class="btn btn-info btn-sm;">OFF</button>';?></a></td>
			</tr>
			
			
<?php	
		}
	}
}
}
?>
		</tbody>
	</table>
</div>




	
