<?php 
include 'config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$user = $_SESSION['user_id'];

$staff = ($user=="Laura") ? "Accounting Staff" : "Created by";

$hasil = '';


if($_GET['nomor']<>"") {
	$urut = substr($_GET['nomor'], 7, 3);
	$th = substr(date('Y'), 2) ;
	$bl = date('m');
	$nomor = 'PO'.$th.$bl.'-'.$urut;

	mysqli_query($con, "UPDATE purchase_order_data SET nomor_po='$nomor', tanggal_po='$date', created_po='$user' WHERE nomor_rf='$_GET[nomor]' AND submit=false");

	$sql = $con->query("SELECT * FROM purchase_order_data a, supplier b WHERE a.vendor=b.nama_supplier AND nomor_rf='$_GET[nomor]' ");
	$rdata = $sql->fetch_array();

	$qcat = $con->query("SELECT catatan FROM catatan_po WHERE nomor_po='$nomor'");
	$cat = $qcat->fetch_array();

	$hasil .= 
		'<img src="../logo.png" width="8%">
		 <div style="font-size: 14px; font-weight: bolder">Quick & Clean Laundry</div>
		 <div class="row">
				<div class="col-md-6 col-xs-6" align="left">					
					<table style="font-size:9pt">
						<tr>
							<td></td>
							<td>&nbsp; &nbsp; &nbsp; </td>
							<td></td>
						</tr>
						<tr>
							<td style="padding-bottom: 15px"></td>
							<td style="padding-bottom: 15px">&nbsp; &nbsp; &nbsp; </td>
							<td style="padding-bottom: 15px"></td>
						</tr>
						<tr>
							<td>Company</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td class="supplier" id="'.$rdata['vendor'].'">'.strtoupper($rdata['vendor']).'</td>
						</tr>
						<tr>
							<td>Address</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>'.$rdata['alamat'].'</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>'.$rdata['phone'].'</td>
						</tr>
						<tr>
							<td>Contact</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>'.$rdata['contact'].'</td>
						</tr>
					</table>
				</div>';
			$hasil .=
				'<div class="col-md-6 col-xs-6" align="right">
					<table style="font-size:9pt">
						<tr>
							<td>No</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>'.$nomor.'</td>
						</tr>
						<tr>
							<td style="padding-bottom: 15px">Date</td>
							<td style="padding-bottom: 15px">&nbsp; :&nbsp; &nbsp; </td>
							<td style="padding-bottom: 15px">'.date('d F Y').'</td>
						</tr>
						<tr>
							<td>Bill to</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>Quck & Clean Laundry</td>
						</tr>
						<tr>
							<td>Address</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>Jl. Toddopuli Raya No. 8, Makassar</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>082291389153</td>
						</tr>
						<tr>
							<td>Contact</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>Laura Fany</td>
						</tr>
					</table>
				</div>	
			</div>
			<br>
			<div>
				<table class="table table-bordered" style="font-size: 9pt">
					<thead>
						<tr>
							<th width="7%" style="vertical-align: middle">No</th>
							<th style="vertical-align: middle">Item Description</th>
							<th width="" style="vertical-align: middle">Qty</th>
							<th style="vertical-align: middle">UOM</th>
							<th width="15%">Unit Price</th>
							<th width="15%" style="vertical-align: middle">Line Total</th>
						</tr>
					</thead>
					<tbody>

			';
						$ppn = $con->query("SELECT ppn FROM supplier WHERE nama_supplier='$rdata[nama_supplier]'");
						$rppn = $ppn->fetch_row();
						$no = 1;
						$subtotal = 0;
						$ppn = $rppn[0]/100;
						$tppn = 0;
						$total = 0;

						$sql = $con->query("SELECT * FROM purchase_order_data WHERE nomor_rf='$_GET[nomor]' ");	
						while($data = $sql->fetch_array()){
							if($data['last_stock_balance']=="0") $lsb = "" ; else $lsb = $data['last_stock_balance'].' '.$data['uom_lsb'];
							if($data['date_delivery_required']=="") $date_delivery = "-"; else $date_delivery = date('d-F', strtotime($data['date_delivery_required']));
							$subtotal += $data['qty']*$data['unit_price'];
							$tppn += ($data['qty']*$data['unit_price'])*$ppn;
							$total += ($data['qty']*$data['unit_price'])+($data['qty']*$data['unit_price'])*$ppn;

							$hasil .= '
								<tr>
									<td style="text-align: center">'.$no.'</td>
									<td class="item" data-id1="'.$data['id'].'">'.$data['item'].'</td>
									<td class="qty" data-id2="'.$data['id'].'" style="text-align: center">'.$data['qty'].'</td>
									<td class="uom" data-id3="'.$data['id'].'" style="text-align: center">'.$data['uom'].'</td>
									<td class="unit_price" data-id4="'.$data['id'].'" style="text-align: right" contenteditable type="number">'.number_format($data['unit_price']).'</td>
									<td class="total_price" data-id5="'.$data['id'].'" style="text-align: right" type="number">'.number_format($data['qty']*$data['unit_price']).'</td>	
								</tr>
							';
							$no++;
						}
						$hasil .= 
							'<tr>
								<td rowspan="3" style="border-right: 1px hidden ">Catatan:</td>
								<td colspan="3" rowspan="3" contenteditable class="catatan-po">'.$cat[0].'</td>
								<td>Sub Total</td>
								<td class="subtotal" style="text-align: right">'.number_format($subtotal).'</td>
							</tr>
						';
						$hasil .= 
							'<tr>
								<td>PPN '.$rppn[0].'%</td>
								<td style="text-align: right">'.number_format($tppn).'</td>
							</tr>
						';
						$hasil .= 
							'<tr>
								<td>Total</td>
								<td class="total" style="text-align: right" data-id7="'.$total.'">'.number_format($total).'</td>
							</tr>
					</tbody>
				</table>
			</div>

			<div align="center">
			 	<table class="tab">
				 	<tr>
				 		<th width="30%" style="text-align: center">Prepared by</th>
				 		<th width="30%" style="text-align: center">Approved by</th>
				 		<th width="30%" style="text-align: center">Confirmed by</th>
				 	</tr>
				 	<tr>
				 		<td style="padding-top: 65px; text-decoration: underline;">'.ucwords($user).'</td>
				 		<td style="padding-top: 65px; text-decoration: underline;">Kasmawati</td>
				 		<td style="padding-top: 65px; text-decoration: underline;">.............................</td>
				 	</tr>
				 	<tr>
				 		<td>'.$staff.'</td>
				 		<td>Operational Manager</td>
				 		<td>Supplier</td>
				 	</tr>
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

 	$(".unit_price").keypress(function(e){       
        var unit_price = $(this).val();         
        if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
           alert("isi hanya dengan angka");
             return false;
        }       
    });


	function edit_data(id,text,nama_colom)
	{
		var nomor = "<?php echo $_GET['nomor'] ?>";
		$.ajax({
			url 	: 'simpan_po.php',
			method 	: 'POST',
			data 	: {id:id, text:text, nama_colom:nama_colom},
			dataType: "text",
			success : function(data){
				$('.pesan-data').html(data).css({"background-color": "#b5f694", "text-align": "center"});
				$('#req-data').load('select_data_requisition.php?nomor='+nomor);
			}
		});
	}

	$('.unit_price').on('blur', function(){
		var id = $(this).data('id4');
		var unit_price = $(this).text();
		edit_data(id,unit_price,"unit_price");
	});

	$('.catatan-po').on('focusout', function(){
		var nomor = "<?php echo $_GET['nomor'] ?>";
		var nomor_po = "<?= $nomor ?>";
		var total = $('.total').data('id7');
		var catatan = $(this).text();
		$.ajax({
			url 	: 'simpan_po.php',
			method 	: 'POST',
			data 	: {nomor:nomor_po, catatan:catatan, total:total},
			success : function(data){
				$('.pesan-data').html(data).css({"background-color": "#b5f694", "text-align": "center"});
				$('#req-data').load('select_data_requisition.php?nomor='+nomor);
			}
		})
	});

	$(document).on("click", "#kirim", function(event) {
    	var nomor = "<?= $nomor ?>";
    	var total = $('.total').data('id7');
    	var supplier = $('.supplier').attr('id');

		$.ajax({
			url 	: 'action/kirim_po.php',
			method 	: 'POST',
			data 	: {nomor:nomor, supplier:supplier, total:total},
			success : function(data){
				$('.pesan-data').html(data).css({"background-color": "#b5f694", "text-align": "center"});
			}
		})
    });

	


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

 

