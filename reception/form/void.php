<div class="panel panel-default">
	
	<div class="panel-body">
<!-- 		<marquee behavior=alternate onmouseover="this.stop()" onmouseout="this.start()" style="color:#ff0000; font-size:18px">Info: Nomor Nota yang sudah divoid, jangan dipakai lagi!</marquee> -->
		<div class="form-horizontal" style="margin-top: 25px">						
			<div class="form-group">
				<label for="nota" class="control-label col-sm-3">Nota Order</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nota" name="nota" maxlength="16" required placeholder="Isi hanya untuk satu nota">								
				</div>
				<button class="btn btn-md btn-active btn-default" type="submit" name="btn_cek" id="btn_cek" value="Search">Search</button>
			</div>	
			<div id="nota_void" align="center">
				
			</div>

		</div>
		<!--<center>Menu ini tidak bisa lagi digunakan!!</center>-->
	</div>

</div>					


<script type="text/javascript">
	$('#btn_cek').click(function(){
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
			
