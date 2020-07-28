
<div class="form-horizontal">
	<div class="form-group">
		<label class="col-md-4 control-label">No Nota</label>
		<div class="col-md-6">
			<input type="text" class="form-control" id="nota" name="" maxlength="14" readonly="" value="<?php echo $_GET['nota'] ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-4 control-label">Jumlah</label>
		<div class="col-md-6">
			<input type="number" class="form-control" id="jumlah" name="" min="1" value="<?php echo $_GET['jumlah'] ?>" readonly>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-4 control-label">Keterangan</label>
		<div class="col-md-6">
			<textarea class="form-control" id="ket"></textarea>
		</div>
	</div>	

	<div class="clearfix form-actions widget-toolbox padding-8" style="margin-bottom: -8px">
		<div class="col-md-offset-4 col-md-6">
			<button class="btn btn-danger btn-sm btn-reject">
				Reject <i class="ace-icon fa fa-reply icon-only"></i>
			</button>
		</div>
	</div>
</div>


		
<script type="text/javascript">

	$('.btn-reject').on('click', function(){

		var nota = $('#nota').val();
		var jumlah = $("#jumlah").val();
		var keterangan = $("#ket").val();
		$.ajax({
			url		: 'action/reject_opr.php',
			data 	: {nota:nota, jumlah:jumlah, ket:keterangan},
			success	: function(data){
				alert(data);
				location.href = "";
			}
		})
	})

		
</script>
	