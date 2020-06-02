
	<div class="panel-body">
		<button type="button" class="btn btn-default" id="form-buka" title="Pilih Supplier">Pilih Subagen</button>	
		<div class="form-inline hidden table-responsive" id="form-cari">
			<table>
				<tr>
					<td style="padding-right: 25px">	
						<select class="form-control" id="subagen">
							<option value="">--Pilih Nama Subagen--</option>
							<?php 
							$query = mysqli_query($con, "SELECT DISTINCT subagen FROM user WHERE type='subagen' AND aktif='Ya' AND subagen<>'' ");
							while($row = mysqli_fetch_row($query)){ 
							echo '<option value="'.$row[0].'">&nbsp; '.$row[0].'</option>';
							}
							?>
						</select>				
					</td>
					<td style="padding-right: 15px">	
						<input class="form-control" type="text" id="tanggal" name="" value="" placeholder="Start Date">						
					</td>
					<td style="padding-right: 10px">	
						<input class="form-control" type="text" id="tanggal2" name="" value="" placeholder="End Date">						
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


<script type="text/javascript">
	$('#form-buka').click(function(e){
		$('#form-cari').toggleClass('hidden');
		$(this).toggleClass('hidden');
	});

	function fetch_data()
	{
		var subagen = $('#subagen').val();
		var startDate = $('#tanggal').val();
		var endDate = $('#tanggal2').val();
		$.ajax({
			url 	: "include/rekap_omset_subagen.php",
			method	: 'GET',
			data 	: {subagen:subagen, startDate:startDate, endDate:endDate},
			beforeSend : function(data){
				$('#req-data').html("Sedang Memuat ...");
			},
			success : function(data){
				$('#req-data').html(data);
			},
		})
	};

	$('#cari-data').on('click', function(){
		fetch_data();
		$('#form-cari, #form-buka').toggleClass('hidden');
	});
    
</script>

