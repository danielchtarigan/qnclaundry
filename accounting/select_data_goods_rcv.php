<?php 
include 'config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$user = $_SESSION['user_id'];

$hasil = '';


if($_GET['nomor']<>"") {
	$urut = $urut = substr($_GET['nomor'], 7, 3);
	$th = substr(date('Y'), 2) ;
	$bl = date('m');
	$nomor = 'GR'.$th.$bl.'-'.$urut;

	mysqli_query($con, "UPDATE purchase_order_data SET nomor_gr='$nomor', tanggal_gr='$date', created_gr='$user' WHERE nomor_po='$_GET[nomor]' AND submit='1'");

	$sql = $con->query("SELECT * FROM purchase_order_data a, supplier b WHERE a.vendor=b.nama_supplier AND nomor_po='$_GET[nomor]' ");
	$rdata = $sql->fetch_array();
	

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
							<td>'.strtoupper($rdata['vendor']).'</td>
						</tr>	
					</table>
				</div>';
			$hasil .=
				'<div class="col-md-6 col-xs-6" align="right">
					<table style="font-size:9pt">
						<tr>
							<td>GR Number</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>'.$nomor.'</td>
						</tr>
						<tr>
							<td>Received Goods Date</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>'.date('d/m/Y').'</td>
						</tr>
						<tr>
							<td style="padding-bottom: 15px">PO Number</td>
							<td style="padding-bottom: 15px">&nbsp; :&nbsp; &nbsp; </td>
							<td style="padding-bottom: 15px">'.$_GET['nomor'].'</td>
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
							<th width="15%">Condition</th>
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

						$sql = $con->query("SELECT * FROM purchase_order_data WHERE nomor_po='$_GET[nomor]' ");	
						while($data = $sql->fetch_array()){
							if($data['last_stock_balance']=="0") $lsb = "" ; else $lsb = $data['last_stock_balance'].' '.$data['uom_lsb'];
							if($data['date_delivery_required']=="") $date_delivery = "-"; else $date_delivery = date('d-F', strtotime($data['date_delivery_required']));
							$subtotal += $data['qty']*$data['unit_price'];
							$tppn += ($data['qty']*$data['unit_price'])*$ppn;
							$total += ($data['qty']*$data['unit_price'])-($data['qty']*$data['unit_price'])*$ppn;

							$hasil .= '
								<tr>
									<td style="text-align: center">'.$no.'</td>
									<td class="item" data-id1="'.$data['id'].'">'.$data['item'].' '.$data['qty'].' '.$data['uom'].'</td>
									<td class="qty" contenteditable data-id2="'.$data['id'].'" style="text-align: center">'.$data['qty_received'].'</td>
									<td class="uom" contenteditable data-id3="'.$data['id'].'" style="text-align: center">'.strtoupper($data['uom_by_received']).'</td>
									<td class="condition" data-id4="'.$data['id'].'" contenteditable style="text-align: center">'.ucwords($data['condition_rcv']).'</td>									
								</tr>
							';
							$no++;
						}						
						$hasil .= 
							'
					</tbody>
				</table>
			</div>

			<div align="center">
			 	<table class="tab">
				 	<tr>
				 		<th width="30%" style="text-align: center">Prepared by</th>
				 		<th width="30%" style="text-align: center">Approved by</th>
				 	</tr>
				 	<tr>
				 		<td style="padding-top: 65px; text-decoration: underline;">'.$user.'</td>
				 		<td style="padding-top: 65px; text-decoration: underline;">(Laura Fany)</td>
				 	</tr>
				 	<tr>
				 		<td>Warehouse Staff</td>
				 		<td>Accounting Staff</td>
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

 	$(".qty").keypress(function(e){       
        var qty_rcv = $(this).val();    
        if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
           alert("isi hanya dengan angka");
             return false;
        }      

    });
    
    var condition = [
      "Baik",
      "Cacat",
      "Tidak Pesan",
      "Lebih Barang",
      "Kurang Barang",
      "Salah Satuan",
    ];

    $( ".uom" ).autocomplete({
      source: 'uom.php'
    });
    
    $( ".condition" ).autocomplete({
      source: condition
    });

	function edit_data(id,text,nama_colom)
	{
		var nomor = "<?php echo $_GET['nomor'] ?>";
		$.ajax({
			url 	: 'action/simpan_gr.php',
			method 	: 'POST',
			data 	: {id:id, text:text, nama_colom:nama_colom},
			dataType: "text",
			success : function(data){
				$('.pesan-data').html(data).css({"background-color": "#b5f694", "text-align": "center"});
				$('#req-data').load('select_data_goods_rcv.php?nomor='+nomor);
			}
		});
	}

	$('.qty').on('blur', function(){
		var id = $(this).data('id2');
		var qty = $(this).text();	
        edit_data(id,qty,"qty_received");		
	});

	$('.uom').on('blur', function(){
		var id = $(this).data('id3');
		var uom = $(this).text();
		edit_data(id,uom,"uom_by_received");
	});

	$('.condition').on('blur', function(){
		var id = $(this).data('id4');
		var condition = $(this).text();
		edit_data(id,condition,"condition_rcv");
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

 

