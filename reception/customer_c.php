<?php
include '../config.php';

session_start();



date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$newdate = strtotime ( '-60 day' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-d' , $newdate );
$newdate2 = strtotime ( '-120 day' , strtotime ( $date ) ) ;
$newdate2 = date ( 'Y-m-d' , $newdate2 );
echo $newdate;
echo '<br>';
echo $newdate2;

?>

<div class="col-sm-6 col-sm-offset-3">
	<table class="table-responsive" id="tabel">
		<thead>
			<tr>
				<th>Nama Customer</th>
				<th>Frekuensi</th>
				<th>Jumlah Transaksi</th>
			</tr>
		</thead>
		<tbody>			
				<?php


$rrecept = mysqli_query($con, "select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal,id_customer,nama_customer from reception where (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newdate2' and '$newdate') and (nama_outlet='DAYA' or nama_outlet='BTP') group by id_customer ASC");
if(mysqli_num_rows($rrecept)>0){
while($rc = mysqli_fetch_array($rrecept)){
	$tgl = $rc['tanggal'];	
	$qbayar = mysqli_fetch_array(mysqli_query($con, "select COUNT(id_customer) as frek, sum(total_bayar) as bayar from reception where id_customer='$rc[id_customer]' and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newdate2' and '$newdate')"));
	if($qbayar['bayar']<200000 and $qbayar['frek']<4){
		$rcst = mysqli_query ($con, "select *from customer where id='$rc[id_customer]'");
		WHILE($qcst = mysqli_fetch_array($rcst)){
		$cst = $qcst['id'];
		$ncst = $qcst['nama_customer'];
	?>
			<tr>
				<td><?php echo $ncst;?></td>
				<td><?php echo $qbayar['frek'];?></td>
				<td><?php echo $qbayar['bayar'];?></td>
			</tr>
<?php	
		
		}
}
}
}
?>
		</tbody>
	</table>

		
				
