
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Buku Besar</h3>
	</div>
	<div class="panel-body">
			<button class="btn btn-md btn-default btn-range">Pilih Range</button>
			<form class="form-horizontal hidden" id="fcari">
				<div class="form-group">
					<div class="col-md-3">
						<input class="form-control" type="text" name="" id="start" placeholder="tanggal awal">
					</div>
					<div class="col-md-3">
						<input class="form-control" type="text" name="" id="end" placeholder="tanggal akhir">
					</div>
					<div class="col-md-3">
						<input class="btn btn-md btn-default" type="submit" name="" id="cari" value="Cari">
					</div>
				</div>
			</form>

			<div style="margin-top: 20px" id="data">					
			</div>
			
	</div>
</div>


<script type="text/javascript">	
	$('.btn-range').click(function(){
		$('#fcari').removeClass('hidden');
		$('.btn-range').addClass('hidden');
	});

	$('#cari').on('click', function(e){
		e.preventDefault();
		var start = $('#start').val();
		var end = $('#end').val();
		$.ajax({
			url 	: 'laporan/data_buku_besar.php',
			data 	: 'cari=cari&start='+start+'&end='+end,
			success : function(data) {
				$('#data').html(data);
				$('#fcari').addClass('hidden');
				$('.btn-range').removeClass('hidden');
			}
		})

	})
</script>