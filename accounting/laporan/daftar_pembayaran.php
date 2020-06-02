<?php 
include '../config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$user = $_SESSION['user_id'];

$hasil = '';


if($_GET['status']<>"") {
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
	$status = $_GET['status'];

	$sql = $con->query("SELECT * FROM daftar_pembayaran WHERE lunas='$status' AND tanggal_po BETWEEN '$startDate' AND '$endDate' ORDER BY id DESC ");	
	
	if($status=="0") 
	{		
		$stts = "Not Yet";
	}
	else 
	{
		$stts = "Already";
	}

	
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
				</div>
				<div class="col-md-6 col-xs-6" align="right">
					<table style="font-size:9pt">
						<tr>
							<td>Paid</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>'.$stts.'</td>
						</tr>
						<tr>
							<td>Start Date</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>'.date('d/m/Y', strtotime($startDate)).'</td>
						</tr>
						<tr>
							<td style="padding-bottom: 15px">End Date</td>
							<td style="padding-bottom: 15px">&nbsp; :&nbsp; &nbsp; </td>
							<td style="padding-bottom: 15px">'.date('d/m/Y', strtotime($endDate)).'</td>
						</tr>
						
					</table>
					<a class="btn btn-xs btn-info paid hidden">Verifikasi</a>
				</div>	
			</div>
			<br>
			<div class="table-responsive">
				<table id="rekap" class="table table-striped table-bordered" style="font-size: 12px">
					<thead>
						<tr>
							<th width="" style="vertical-align: middle">No</th>
							<th width="20%" style="vertical-align: middle">Supplier Name</th>
							<th style="vertical-align: middle">PO Number</th>
							<th width="" style="vertical-align: middle">Amount of Debt</th>
							<th width="" style="vertical-align: middle">Type Of Pay</th>
							<th width="" style="vertical-align: middle">Account Number</th>
							<th width="" style="vertical-align: middle">Account Name</th>
							<th width="" style="vertical-align: middle"><input align="center" type="checkbox" value="All" class="chekboxes" name=""> <label class="control-label"> Check all </label></th>
						</tr>
					</thead>
					<tbody>

			';					
						$no = 1;
						$total = 0;
						while($data = $sql->fetch_array()){

							$suppliers = $con->query("SELECT * FROM supplier WHERE nama_supplier='$data[nama_supplier]'");
							$result = $suppliers->fetch_assoc();

							if($status=="0") {
								$act = '<input class="act" type="checkbox" name="id[]" value="'.$data['id'].'">';
							}
							else {
								$act = '';
							}
							
							$total += $data['jumlah'];
							$hasil .= '
								<tr>
									<td style="text-align: center">'.$no.'</td>
									<td style="text-align: left">'.$data['nama_supplier'].'</td>
									<td class="" style="text-align: center">'.$data['nomor_po'].'</td>
									<td class="" style="text-align: right">'.number_format($data['jumlah']).'</td>	
									<td class="cara_bayar" data-id="'.$data['id'].'" contenteditable="false" style="text-align: center">'.$result['cara_bayar'].'</td>
									<td class="nomor_rek" data-id2="'.$data['id'].'" style="text-align: center">'.$result['nomor_rek'].'</td>	
									<td class="nama_rek" data-id3="'.$data['id'].'" style="text-align: center">'.$result['nama_rek'].'</td>		
									<td class="" style="text-align: center">'.$act.'</td>	
								</tr>								
							';
							$no++;
						}						
						$hasil .= 
							'	
								<tfoot>
									<tr>
										<td style="text-align: right; font-weight:bolder; background-color: #8deeeb" colspan="3">Total</td>
										<td class="total" style="text-align: right; font-weight:bolder; background-color: #8deeeb">'.number_format($total).'</td>	
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

<!-- <div class="modal fade edit_rekening" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content">    	
        	<div class=" panel panel-success">
				<div class="panel-heading">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="panel-title" align="center">Verifikasi Pembayaran</h3>
				</div>
				<div class="panel-body list-data">
					<div class="form-grek">
						<form action="#">
							<label class="control-label">Tranfer Bank</label>
							<select class="form-rek" id="bank">
								<option value="">Transfer Bank ke...</option>
								<option value="BCA">&nbsp; BCA</option>
								<option value="BNI">&nbsp; BNI</option>
								<option value="BRI">&nbsp; BRI</option>
								<option value="Permata">&nbsp; Permata</option>
							</select>
							<label class="control-label">Nomor Rekening</label>
					    	<input class="form-rek" type="text" id="nomor_rek" name="" placeholder="Nomor rekening..">
					    	<label class="control-label">Nama Rekening</label>
					    	<input class="form-rek" type="text" id="nama_rek" name="" placeholder="Nama rekening..">
					  
					    	<input class="btn btn-block btn-md btn-success" type="submit" value="Simpan" style="margin-top: 10px">
					  </form>
					</div>	
				</div>
			</div>
    	</div>
  	</div>
</div> -->	


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

	/*.form-grek {
		margin-top: -15px;
	    border-radius: 5px;
	    padding: 8px;
	}

	.form-rek {
	    width: 100%;
	    padding: 4px 20px;
	    margin: 8px 0;
	    display: inline-block;
	    border: 1px solid #ccc;
	    border-radius: 4px;
	    box-sizing: border-box;
	    outline: none;
	  	border: none;
	    background: transparent;
	    border-bottom: 1px solid #a9a9a9;
	}

	.control-label {
		padding-top : 20px;
	}*/

 </style>


<script type="text/javascript">
	$(document).ready( function () {
	    $('#rekap').DataTable({
	    	"aaSorting":[[0, "asc"]],
	    	"sPaginationType":"full_numbers",
          	"bJQueryUI":true,
          	"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
	    });

	    $('.chekboxes').change(function(){
	    	$('.act').prop('checked', $(this).prop('checked'));
	    })

	    $('.act, .chekboxes').change(function(){
	    	$('.paid').removeClass('hidden');
	    })

	    $('.paid').on('click', function(e){
	    	var ids = [];
	    	$('.act').each(function(){
	    		if($(this).is(':checked')){
	    			ids.push($(this).val());
	    		}
	    	});
	    	ids = ids.toString();
	    	if(confirm("Apakah Anda sudah mencek mutasi Bank?"))
	    	{
	    		$.ajax({
		        	url 	: 'action/verifikasi_pembayaran.php',
		        	data 	: 'id='+ids,
		        	method 	: 'POST',
		        	success : function(data){
		        		$("#pesan-data").html(data);
		        		window.location="";
		        	}
		        })
	    	}	            
	    })


	    $(document).on('click', '.cara_bayar, .nomor_rek, .nama_rek', function(e){
	    	var a = $('.cara_bayar').attr('contenteditable');
	    	var b = $('.nomor_rek').attr('contenteditable');
	    	var c = $('.nama_rek').attr('contenteditable');
	    	if(a=="false" || b=="false" || c=="false"){
	    		alert("Klik tombol Edit untuk mengedit!");
	    	}

	    });

	    $(document).on('click', '.edit', function(e){
	    	$('.cara_bayar').attr('contenteditable','true');
	    	$('.nomor_rek').attr('contenteditable','true');
	    	$('.nama_rek').attr('contenteditable','true');
	    	$(this).toggleClass('hidden');
	    	$('.selesai').toggleClass('hidden');
	    });

	    $(document).on('click', '.selesai', function(e){
	    	$('.cara_bayar').attr('contenteditable','false');
	    	$('.nomor_rek').attr('contenteditable','false');
	    	$('.nama_rek').attr('contenteditable','false');
	    	$(this).toggleClass('hidden');
	    	$('.edit').toggleClass('hidden');
	    });

	    $(".nomor_rek").keypress(function(e){       
	        var qty_rcv = $(this).val();    
	        if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
	           alert("isi hanya dengan angka");
	             return false;
	        }      

	    });

	 	var bank = [
	      "BCA",
	      "BNI",
	      "BRI",
	      "Mandiri",
	      "Permata",
	      "BTN",
	      "Mega",
	    ];

	    $( ".uom" ).autocomplete({
	      source: 'uom.php'
	    });

	    $( ".cara_bayar" ).autocomplete({
	      source: bank
	    });

		function edit_data(id,text,nama_colom)
		{
			$.ajax({
				url 	: 'action/simpan_rekening_bayar.php',
				method 	: 'POST',
				data 	: {id:id, text:text, nama_colom:nama_colom},
				dataType: "text",
				success : function(data){
					$('.pesan-data').html(data).css({"background-color": "#b5f694", "text-align": "center"});
				}
			});
		}

		$('.cara_bayar').on('blur', function(){
			var id = $(this).data('id');
			var cara_bayar = $(this).text();	
	        edit_data(id,cara_bayar,"cara_bayar");		
		});

		$('.nomor_rek').on('blur', function(){
			var id = $(this).data('id2');
			var nomor_rek = $(this).text();
			edit_data(id,nomor_rek,"nomor_rek");
		});

		$('.nama_rek').on('blur', function(){
			var id = $(this).data('id3');
			var nama_rek = $(this).text();
			edit_data(id,nama_rek,"nama_rek");
		});
	    
	});
</script>
 
