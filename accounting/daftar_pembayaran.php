<div class=" panel panel-default">
	<div class="panel-heading data-cetak">
		<h3 class="panel-title" align="center" style="font-weight: bolder; color: #FFD700">Daftar Pembayaran</h3>
	</div>
	<div class="panel-body">
		<button type="button" class="btn btn-default" id="form-buka" title="Pilih Supplier">Pilih Range</button>
		<a href="#" class="btn btn-warning edit pull-right hidden">&nbsp; Edit &nbsp; </a><a href="#" class="btn btn-success selesai hidden pull-right">Selesai</a>	
		<div class="form-inline hidden" id="form-cari">
			<table>
				<tr>
					<td style="padding-right: 25px">	
						<select class="form-control" id="status_bayar">
							<option value="">--Status Bayar--</option>
							<option value="1">&nbsp; Sudah Dibayar</option>
							<option value="0">&nbsp; Belum Dibayar</option>
							
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
		$('.edit').removeClass('hidden');
		$('.selesai').addClass('hidden');
	});

	function fetch_data()
	{
		var status = $('#status_bayar').val();
		var startDate = $('#start').val();
		var endDate = $('#end').val();
		$.ajax({
			url 	: "laporan/daftar_pembayaran.php",
			method	: 'GET',
			data 	: {status:status, startDate:startDate, endDate:endDate},
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

