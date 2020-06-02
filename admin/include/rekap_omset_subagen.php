<?php 
include '../../config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$user = $_SESSION['user_id'];

$hasil = '';


if($_GET['subagen']<>"") {
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
	$subagen = $_GET['subagen'];

	$subagens = mysqli_query($con, "SELECT * FROM saldo_subagen WHERE subagen='$subagen'");
	$data = mysqli_fetch_array($subagens);

	
	$hasil .= ' 	 
		 <div class="row">
				<div class="col-md-6 col-xs-6" align="left">	
					<table style="font-size:9pt">
						<tr>
							<td>SUBAGEN</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>'.strtoupper($subagen).'</td>
						</tr>	
						<tr>
							<td>Saldo Utama</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>Rp '.number_format($data['saldo']).'</td>
						</tr>	
						<tr>
							<td>Saldo Bonus</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>Rp '.number_format($data['bonus']).'</td>
						</tr>	
					</table>
				</div>
			</div>
			<br>
			<div>
				<table id="rekap" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th width="" style="vertical-align: middle">Order Date</th>
							<th style="vertical-align: middle">User Created</th>
							<th style="vertical-align: middle">Order Number</th>
							<th width="" style="vertical-align: middle">Outlet</th>
							<th width="" style="vertical-align: middle">Total Price</th>
							<th width="" style="vertical-align: middle">Action</th>
						</tr>
					</thead>
					<tbody>

			';					
						
						$total = 0;
						$sql = $con->query("SELECT DISTINCT DATE_FORMAT(a.tgl_input, '%Y/%m/%d') AS order_date, a.nama_reception AS user_created, a.no_nota AS order_number, a.nama_outlet AS outlet, a.total_bayar AS total_price FROM reception a, user b WHERE a.nama_reception=b.name AND b.subagen='$_GET[subagen]' AND (a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject') AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");	
						while($rdata = $sql->fetch_array()){							
							$total += $rdata['total_price'];
							

							$hasil .= '
								<tr>
									<td style="text-align: center">'.$rdata['order_date'].'</td>
									<td style="text-align: center">'.$rdata['user_created'].'</td>
									<td class="po-number" style="text-align: center">'.$rdata['order_number'].'</td>
									<td class="created-po" style="text-align: center">'.$rdata['outlet'].'</td>	
									<td class="total-price" style="text-align: center">'.number_format($rdata['total_price']).'</td>
									<td class="act-detail" data-toggle="modal" data-target="#rincian_order" id="'.$rdata['order_number'].'" style="text-align: center"><a href="#">Detail</a></td>	
								</tr>								
							';
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
	$('.act-detail').on('click', function(){
		var order = $(this).attr('id');
		$.ajax({
			url 	: 'rincian_order.php',
			data 	: 'order='+order,
			beforeSend : function(data){
				$('.rincian').html("Sedang memuat ...");
			},
			success : function(data){
				$('.rincian').html(data);
			}
		})
	})
</script>

<script type="text/javascript">
	$(document).ready( function () {
	    $('#rekap').DataTable({
	    	"aaSorting":[[2, "asc"]],
	    	"sPaginationType":"full_numbers",
          	"bJQueryUI":true,
          	"lengthMenu": [ [10 , 25, 50, -1], [10, 25, 50, "All"] ],
          	dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
	    });
	    
	});
</script>
 
<div class="modal fade" id="rincian_order" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="rincian" align="center">
				
			</div>
		</div>
	</div>
</div>



