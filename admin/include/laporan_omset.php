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

<div id="result_omset" style="margin-top: 15px">
	
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
				url			: 'include/hasil_omset.php',
				data 		: {start : start, end : end, jar : jar},
				beforeSend : function(){
					$('#result_omset').slideDown().html("<p align='center'>Sedang mencari ....!</p>");
				},
				success 	: function(data){
					$('#result_omset').html(data);
				} 
			})

			

		})
	})
</script>