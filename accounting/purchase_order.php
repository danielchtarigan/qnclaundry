<?php 
include 'akses.php';
?>

<div class=" panel panel-default">
	<div class="panel-heading data-cetak">
		<h3 class="panel-title" align="center" style="font-weight: bolder; color: #FFD700">Purchase Order</h3>
	</div>
	<div class="panel-body">
		<a type="button" class="btn" id="form-buka" title="Lihat RF baru"><img src="icon/tulis4.ico"></a>		
		<a id="cetak" class="btn pull-right" title="Cetak"><img src="icon/cetak.ico"></a>
		<a id="kirim" class="btn pull-right hidden" title="Kirim"><img src="icon/mail.ico"></a>
		<div class="form-inline hidden" id="form-cari">
			<select class="form-control" id="nomor">
				<option value="">Nomor Requisition</option>
				<?php 
				$sql = $con->query("SELECT DISTINCT nomor_rf FROM purchase_order_data WHERE submit='0' ORDER BY id ASC ");
				while($row = $sql->fetch_array()){
					echo '<option value="'.$row['nomor_rf'].'">&nbsp; '.$row['nomor_rf'].'</option>';
				}
				?>
			</select>

			<button class="btn btn-md btn-primary" id="cari-data">Tampilkan Data</button>
		</div>		
		<div class="pesan-data"></div>
		<div class="data-cetak" style="font-family: arial;">
			<br>			
			<div id="req-data"></div>
		</div>
	</div>
</div>



<script type="text/javascript">
	$(document).ready(function(){
		$('#form-buka').on('click',function(){
			$(this).addClass('hidden');
			$('#form-cari').removeClass('hidden');
			$('#kirim').addClass('hidden');
		});

		function fetch_data()
		{
			var nomor = $('#nomor').val();
			$.ajax({
				url 	: "select_data_requisition.php",
				method	: 'GET',
				data 	: 'nomor='+nomor,
				success : function(data){
					$('#req-data').html(data);
					$('#kirim').val(nomor);
				},
			})
		};

		$('#cari-data').on('click', function(){
			fetch_data();
			$('#form-cari').addClass('hidden');
			$('#form-buka').removeClass('hidden');
		});

		$("#cetak").bind("click", function(event) {
    		$('.data-cetak').printArea();
    		$('#kirim').removeClass('hidden');
        });

        


	})
</script>

