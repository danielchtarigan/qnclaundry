<style type="text/css">
	.ffr {
		margin-bottom: 5px;
	}
</style>

<div class="row">
	<div class="col-lg-4 col-md-4">
		<form class="form-horizontal" id="rangeDate">
			<div class="ffr">
				<input class="form-control" type="text" name="" id="start" required="" placeholder="dari" autocomplete="off">
			</div>
			<div class="ffr">
				<input class="form-control" type="text" name="" id="end" required="" placeholder="sampai" autocomplete="off">
			</div>

			<div class="ffr">
				<input class="btn btn-default btn-sm btn-block" type="submit" name="" value="Jaringan">
			</div>
			
		</form>
	</div>

	<div class="col-md-8 col-lg-8">
		<form class="jaringan" style="display: none;">
			<div class="ffr">
				<button class="btn btn-block" disabled="">Pilih Jaringan</button>
			</div>
			<div class="ffr">
				<select class="form-control" id="jaringan">
					<?php 
					$sql = $con-> query("SELECT cabang FROM cabang ORDER BY cabang ASC");
					while($res = $sql -> fetch_array()){
						echo '<option value='.$res['cabang'].'>'.$res['cabang'].'</option>';
					}

					?>
				</select>
			</div>

			<div class="ffr">
				<input class="btn btn-success btn-sm btn-block" type="submit" name="" value="Cari Omset">
			</div>
		</form>
	</div>

</div>
<hr>
<h4>Ringkasan Omset Penjualan</h4>
<div class="table-responsive" id="result" style="overflow-x:auto">
	<table class="table table-bordered table-striped table-condensed">
		<thead>
			<tr>
				<th>Nama Outlet</th>
				<th>Kiloan</th>
				<th>Potongan</th>
				<th>Membership</th>
				<th>Laundry</th>
				<th>Barang</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="6" align="center">Data belum tersedia</td>
			</tr>
		</tbody>
	</table>
</div>
	


<script type="text/javascript">
	jQuery(function($){

		$('#start, #end').datepicker({
			dateFormat : 'yy-mm-dd',
		});

		$('#rangeDate').submit(function(e){
			e.preventDefault();
			$('.jaringan').slideToggle("slow");
		});

		$('.jaringan').submit(function(e){
			e.preventDefault();			

			var jar = $('#jaringan').val();
			var start = $('#start').val();
			var end = $('#end').val();

			$.ajax({
				url			: 'include/bs_summary_omset.php',
				data 		: {start : start, end : end, jar : jar},
				beforeSend : function(){
					$('#result').slideDown().html("<p align='center'>Memuat Data...</p>");
				},
				success 	: function(data){
					$('#result').html(data);
				} 
			})

			

		})
	})
</script>