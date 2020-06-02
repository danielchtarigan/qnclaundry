<?php 
if(isset($_POST['submit'])){
	$kota = $_POST['kota'];
	
} else {
	$kota = "makassar";
}

date_default_timezone_set('Asia/Makassar');
$jam = date('Y-m-d H:i:d');

?>

<style>
.tooltips .tooltiptext {
    visibility: hidden;
    width: 160px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
}
</style>

<script type="text/javascript">
	$(document).ready(function(e){
		$('#select_kota, #submit').on('click', function(){
			$('#select_kota, #form1').toggle();
			$('#form1').removeClass('hide');

		});
		
	})
</script>

<legend class="">DATA TERLAMBAT</legend>

<div class="form-group">
	<button class="btn btn-primary" value="Pilih Kota" name="select_kota" id="select_kota">
		Pilih Kota Lain
	</button>
</div>
	
<form class="form-horizontal hide" action="" method="POST" id="form1">
  <div class="form-group">
  	<div class="col-md-4 col-xs-12">
  		<select class="form-control" name="kota">
	  		<option value="makassar">Makassar</option>
	  		<option value="mojokerto">Mojokerto</option>
	  	</select>
  	</div>
	  	
  	<div class="col-md-4 col-xs-4">
  		<button class="btn btn-success btn-md" type="submit" name="submit" id="submit">Submit</button>
  	</div>
  </div>

</form>


<?php 
if($kota=="makassar"){
	?>
	<ul class="nav nav-tabs nav-justified">
	  <li class="nav-item active" role="presentation"><a class="nav-link active" role="tab" data-toggle="tab" href="#all" style="font-weight: bold; border: 2px solid #dce5e7;">Semua Antrian</a></li>
	  <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-toggle="tab" href="#tdp" style="font-weight: bold; border: 2px solid #dce5e7;">Toddopuli</a></li>
	  <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-toggle="tab" href="#atg" style="font-weight: bold; border: 2px solid #dce5e7;">Antang</a></li>
	  <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-toggle="tab" href="#belumWorkshop" style="font-weight: bold; border: 2px solid #dce5e7;">Belum Workshop</a></li>
	  <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-toggle="tab" href="#spam" style="font-weight: bold; border: 2px solid #dce5e7;">Bermasalah</a></li>

	</ul>

	<div class="tab-content">
	    
	    <div id="all" role="tabpanel" class="tab-pane active">
			<?php include 'data_terlambat_makassar_semua.php'; ?>
		</div>
			
		<div id="tdp" role="tabpanel" class="tab-pane">
			<?php include 'data_terlambat_makassar_toddopuli.php'; ?>
		</div>
			
		<div id="atg" role="tabpanel" class="tab-pane">	
			<?php include 'data_terlambat_makassar_antang.php'; ?>
		</div>	

		<div id="belumWorkshop" role="tabpanel" class="tab-pane">	
			<?php include 'data_terlambat_makassar_belumWrk.php'; ?>
		</div>
		<div id="spam" role="tabpanel" class="tab-pane">	
			<?php include 'bermasalah.php'; ?>
		</div>		
		
	</div>

	<?php
} else {
	include 'data_terlambat_mojokerto_empunala.php';
}

?>


	
<div class="modal fade" id="rincian_order" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="rincian">
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.data-order').click(function(){
		var order = $(this).attr('id');
		$.ajax({
			url 	: 'rincian_order.php',
			data 	: 'order='+order,
			beforeSend : function(){
				$('.rincian').html('<div align="center">sedang mencari...</div>');
			},
			success : function(data){
				$('.rincian').html(data);
			}
		});
	});

	$('#dataall, #dataallpotongan, #datatdp, #datatdppotongan, #dataatg, #dataatgpotongan').dataTable({
		"order": [[ 1,"asc" ]],
		"bJQueryUI" : true,
		"iDisplayLength": 10,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			if (aData[3] == "0" && aData[10] >= 5)
            {
                $('td', nRow).css('background-color', '#beaed2').css('color', 'black').css('font-weight', 'bold');

            }
            else if(aData[3] == "1" && aData[10] >= 24 && aData[10] < 48)
            {
            	$('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');
            }
            else if(aData[3] == "1" && aData[10] >= 48)
            {
            	$('td', nRow).css('background-color', 'red').css('color', 'black').css('font-weight', 'bold');
            }
        }
	});
	
	$('#databwk, #databwkpotongan, #dspam, #dspamp').dataTable({
		"order": [[ 1,"asc" ]],
		"bJQueryUI" : true,
		"iDisplayLength": 10,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			if (aData[3] == "0" && aData[9] >= 5)
            {
                $('td', nRow).css('background-color', '#beaed2').css('color', 'black').css('font-weight', 'bold');
            }
            else if(aData[3] == "1" && aData[9] >= 24 && aData[10] < 48)
            {
            	$('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');
            }
            else if(aData[3] == "1" && aData[9] >= 48)
            {
            	$('td', nRow).css('background-color', 'red').css('color', 'black').css('font-weight', 'bold');
            }
        }
	});

</script>