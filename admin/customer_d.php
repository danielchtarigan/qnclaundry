<?php
include '../config.php';
include 'head.php';
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$newdate = strtotime ( '-60 day' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-d' , $newdate );
$newdate2 = strtotime ( '-120 day' , strtotime ( $date ) ) ;
$newdate2 = date ( 'Y-m-d' , $newdate2 );


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
<h4><strong>Daftar Customer Masuk Type D (Outlet BTP dan DAYA)</strong></h4>
Klik Tombol <button type="button" class="btn btn-primary btn-xs" style="background-color:#F00; border-color:#F00;" id="test" name="test">ON</button> Untuk Mengaktifkan Harga Rp6600/kg<br>
<div class="table-responsive">
	<table class="table table-condensed table-striped table-hover table-bordered" id="tabelcst">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Customer</th>
				<th>Telepon</th>
				<th>Frekuensi</th>
				<th>Jumlah Transaksi</th>
				<th>Aktifkan</th>
			</tr>
		</thead>
		<tbody>			
				<?php

$no=1;
$rrecept = mysqli_query($con, "select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal,id_customer,nama_customer from reception where (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newdate2' and '$newdate') and (nama_outlet='BTP' or nama_outlet='DAYA') group by id_customer order by DATE_FORMAT(tgl_input, '%Y-%m-%d') DESC");
if(mysqli_num_rows($rrecept)>0){
while($rc = mysqli_fetch_array($rrecept)){
	$tgl = $rc['tanggal'];	
	$qbayar = mysqli_fetch_array(mysqli_query($con, "select COUNT(DISTINCT DATE_FORMAT(tgl_input, '%Y-%m-%d')) as frek, sum(total_bayar) as bayar from reception where id_customer='$rc[id_customer]' and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newdate2' and '$newdate')"));
	if($qbayar['bayar']<100000 and $qbayar['frek']<4){
		$rcst = mysqli_query ($con, "select *from customer where id='$rc[id_customer]'");
		WHILE($qcst = mysqli_fetch_array($rcst)){
		$cst = $qcst['id'];
		$ncst = $qcst['nama_customer'];	
		$typed = $qcst['type_d'];		
 
	?>
			<tr>
				<td><?php echo $no++;?></td>
				<td><?php echo $ncst;?></td>
				<td><?php echo $qcst['no_telp'];?></td>
				<td><?php echo $qbayar['frek'];?></td>
				<td><?php echo $qbayar['bayar'];?></td>
				<td><a href="act/customerd.php?id=<?php echo $cst; ?>&type_d=<?php echo $typed; ?>" ><?php if($typed==0) echo '<button type="button" class="btn btn-primary btn-sm" style="background-color:#F00; border-color:#F00;" id="test" name="test">ON</button>'; else echo '<button type="button" class="btn btn-info btn-sm;">OFF</button>';?></a></td>
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
	
