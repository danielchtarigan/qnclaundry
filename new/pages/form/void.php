<div class="panel panel-default">
	
	<div class="panel-body">
<!-- 		<marquee behavior=alternate onmouseover="this.stop()" onmouseout="this.start()" style="color:#ff0000; font-size:18px">Info: Nomor Nota yang sudah divoid, jangan dipakai lagi!</marquee> -->
		<form class="form-horizontal" style="margin-top: 25px">						
			<div class="form-group">
				<label for="nota" class="control-label col-md-3">Nota Order</label>
				<div class="col-md-6 col-xs-9">
					<input type="text" class="form-control" id="nota" name="nota" maxlength="11" required placeholder="Isi hanya untuk satu nota">								
				</div>
				<div class="col-md-3 col-xs-12">
					<button class="btn btn-sm btn-active btn-default" type="submit" name="btn_cek" id="btn_cek" value="Search">Search</button>
				</div>
					
			</div>	
			<div id="nota_void" align="center">
				
			</div>

		</form>
	</div>

</div>					


<script type="text/javascript">
	$('#btn_cek').on('click', function(e){
		e.preventDefault();
		var order = $('#nota').val();
		$.ajax({
			url 	: 'form/cek_order_void.php',
			data 	: 'order='+order,
			success : function(data){
				$('#nota_void').html(data);
			}
		})
	})
</script>		
			
