<?php 
include '../config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$user = $_SESSION['user_id'];

$hasil = '';


if($_GET['supplier']<>"") {
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
	$vendor = $_GET['supplier'];

	// $sql2 = $con->query("SELECT a.nomor_po AS nomor_po,a.tanggal_po AS tanggal_po,a.created_po AS created_po,a.vendor AS vendor,a.qty AS qty,a.item As item FROM purchase_order_data a, supplier b WHERE a.vendor=b.nama_supplier AND vendor='$_GET[supplier]' AND DATE_FORMAT(tanggal_po, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");	
	// $data = $sql2->fetch_array();
	

	
	$hasil .= 
		'<img src="../logo.png" width="8%">		 	 
		 <div class="row">
				<div class="col-md-6 col-xs-6" align="left">					
					<table style="font-size:9pt">
						<tr>
							<td style="font-size: 14px; font-weight: bolder">Quick & Clean Laundry</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Jl. Toddopuli Raya No. 8, Makassar</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td style="padding-bottom: 15px">Makassar</td>
							<td style="padding-bottom: 15px">&nbsp;</td>
							<td style="padding-bottom: 15px">&nbsp;</td>
						</tr>											
					</table>

					<table style="font-size:9pt">
						<tr>
							<td>Supplier</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>'.strtoupper($vendor).'</td>
						</tr>	
					</table>
				</div>
			</div>
			<br>
			<div class="table-responsive">
				<table id="rekap" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th width="" style="vertical-align: middle">No</th>
							<th style="vertical-align: middle">Purchase Date</th>
							<th style="vertical-align: middle">PO Number</th>
							<th width="" style="vertical-align: middle">PO Created By</th>
							<th width="" style="vertical-align: middle">Total Price</th>
							<th width="" style="vertical-align: middle">Action</th>
						</tr>
					</thead>
					<tbody>

			';					
						$no = 1;
						$ppn = $con->query("SELECT ppn FROM supplier WHERE nama_supplier='$vendor'");
						$rppn = $ppn->fetch_row();
						$ppn = $rppn[0]/100;
						$tppn = 0;
						$total = 0;
						$sql = $con->query("SELECT DISTINCT a.nomor_po AS nomor_po FROM purchase_order_data a, supplier b WHERE a.vendor=b.nama_supplier AND vendor='$_GET[supplier]' AND DATE_FORMAT(tanggal_po, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");	
						while($rdata = $sql->fetch_array()){

							$sql2 = $con->query("SELECT nomor_po, tanggal_po, created_po, vendor, qty, item FROM purchase_order_data WHERE nomor_po='$rdata[nomor_po]'") ;	
							$data = $sql2->fetch_array();

							$qsTotal = mysqli_query($con, "SELECT SUM(unit_price*qty) AS total FROM purchase_order_data WHERE nomor_po='$rdata[nomor_po]'");

							$subTotal = mysqli_fetch_row($qsTotal)[0];
							$tppn += $subTotal*$ppn;
							$tPrice = $subTotal+$subTotal*$ppn;
							$total += $tPrice;

							$hasil .= '
								<tr>
									<td style="text-align: center">'.$no.'</td>
									<td style="text-align: center">'.$data['tanggal_po'].'</td>
									<td class="po-number" style="text-align: center">'.$rdata['nomor_po'].'</td>
									<td class="created-po" style="text-align: center">'.$data['created_po'].'</td>	
									<td class="total-price" style="text-align: center">'.number_format($tPrice).'</td>	
									<td class="act-detail" id="'.$rdata['nomor_po'].'" style="text-align: center"><a href="#">Detail</a></td>	
								</tr>								
							';
							$no++;
						}						
						$hasil .= 
							'	
								<tfoot>
									<tr>
										<td style="text-align: right; font-weight:bolder; background-color: #8deeeb" colspan="4">Total</td>
										<td class="total" style="text-align: center; font-weight:bolder; background-color: #8deeeb">'.number_format($total).'</td>	
										<td class="" style="text-align: center; font-weight: bolder; background-color: #8deeeb"></td>
									</tr>
								</tfoot>
					</tbody>
				</table>
			</div>
			


						';


}
else {
	$hasil .= '
			<div align="center">Data tidak ditemukan!</div>
		';
}

	

echo $hasil;



?>



 <script type="text/javascript">
 	$('.act-detail').on('click', function(e){
 		var nomor = $(this).attr('id');
 		window.open('document/doc_po.php?id='+nomor+'','_blank').focus();
 	})

	
 </script>

 <style type="text/css">
 	.tab {
	  width: 100%;
	  max-width: 100%;
	  margin-bottom: 1rem;
	  margin-top: 5rem;
	  background-color: transparent;
	  font-size: 11px;
	}

	.tab th,
	.tab td {
	  padding: 0.05rem;
	  vertical-align: top;
	  text-align: center;
	}

 </style>



<script type="text/javascript">
	$(document).ready( function () {
	    $('#rekap').DataTable({
	    	"aaSorting":[[2, "asc"]],
	    	"sPaginationType":"full_numbers",
          	"bJQueryUI":true,
          	"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
	    });
	    
	});
</script>
 
