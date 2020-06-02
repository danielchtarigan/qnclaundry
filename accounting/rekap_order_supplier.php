<div class=" panel panel-default">
	<div class="panel-heading data-cetak">
		<h3 class="panel-title" align="center" style="font-weight: bolder; color: #FFD700">Rekap Order Supplier</h3>
	</div>
	<div class="panel-body">
		<button type="button" class="btn btn-default" id="form-buka" title="Pilih Supplier">Pilih Supplier</button>	
		<div class="form-inline hidden" id="form-cari">
			<table>
				<tr>
					<td style="padding-right: 25px">	
						<select class="form-control" id="supplier">
							<option value="">--Pilih Nama Supplier--</option>
							<?php 
							$query = mysqli_query($con, "SELECT DISTINCT vendor FROM purchase_order_data WHERE submit<>'0' ORDER BY vendor ASC");
							while($row = mysqli_fetch_row($query)){ 
							echo '<option value="'.$row[0].'">'.$row[0].'</option>';
							}
							?>
						</select>				
					</td>
					<td style="padding-right: 15px">	
						<input class="form-control" type="text" id="start" name="" value="" placeholder="Start Date">						
					</td>
					<td style="padding-right: 10px">	
						<input class="form-control" type="text" id="end" name="" value="" placeholder="End Date">						
					</td>
					<td>
						<input class="btn btn-md btn-success" type="submit" name="" id="cari-data" value="Cari">					
					</td>
				</tr>
			</table>
			
		</div>		
		<div class="pesan-data"></div>
		<div class="data-cetak" style="font-family: arial;">
			<br>			
			<div id="req-data"></div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$('#form-buka').click(function(e){
		$('#form-cari').toggleClass('hidden');
		$(this).toggleClass('hidden');
	});

	$('#cari-data').click(function(e){
		$('#form-cari').toggleClass('hidden');
		$('#form-buka').toggleClass('hidden');
	});

	function fetch_data()
	{
		var supplier = $('#supplier').val();
		var startDate = $('#start').val();
		var endDate = $('#end').val();
		$.ajax({
			url 	: "laporan/rekap_order_supplier.php",
			method	: 'GET',
			data 	: {supplier:supplier, startDate:startDate, endDate:endDate},
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
    
</script>

