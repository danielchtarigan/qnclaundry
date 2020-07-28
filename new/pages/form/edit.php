<div class="panel panel-default">
	<div class="panel-body">
<!-- 		<marquee behavior=alternate onmouseover="this.stop()" onmouseout="this.start()" style="color:#ff0000; font-size:18px"" >
		Info:  Jika Lebih dari satu nota, tetap diinput satu satu yah!!!
		</marquee> -->
		<form class="form-horizontal" style="margin-top: 25px">					
			<div class="form-group">
				<label for="faktur" class="control-label col-md-3" >Nota Faktur</label>
				<div class="col-md-6">
					<input type="text" class="form-control" id="faktur" name="faktur" maxlength="13" required placeholder="Nomor Nota Pembayaran">	
				</div>
				<div class="col-md-3 col-xs-12">
					<button class="btn btn-md btn-active btn-default" type="submit" name="btn_cek2" id="btn_cek2" value="Search">Search</button>
				</div>				
			</div>
			<div id="rincian_f" align="center"></div>
			
					
		</form>
	</div>
</div>
					
					
		
<script type="text/javascript">
	$('#btn_cek2').on('click', function(e){
		e.preventDefault();
		var faktur = $('#faktur').val();
		$.ajax({
			url 	: 'form/cek_faktur.php',
			data 	: 'faktur='+faktur,
			success : function(data){
				$('#rincian_f').html(data);
			}
		})
	})
</script>		
			