<div class="panel panel-default">
	<div class="panel-body">
<!-- 		<marquee behavior=alternate onmouseover="this.stop()" onmouseout="this.start()" style="color:#ff0000; font-size:18px"" >
		Info:  Jika Lebih dari satu nota, tetap diinput satu satu yah!!!
		</marquee> -->
		<!--<div class="form-horizontal" style="margin-top: 25px">					-->
		<!--	<div class="form-group">-->
		<!--		<label for="faktur" class="control-label col-sm-3" >Nota Faktur</label>-->
		<!--		<div class="col-sm-6">-->
		<!--			<input type="text" class="form-control" id="faktur" name="faktur" maxlength="10" required placeholder="Nomor Nota Pembayaran">	-->
		<!--		</div>-->
		<!--		<button class="btn btn-md btn-active btn-default" type="submit" name="btn_cek2" id="btn_cek2" value="Search">Search</button>-->
		<!--	</div>-->
		<!--	<div id="rincian_f" align="center"></div>-->
			
					
		<!--</div>-->
		
		<center>Menu ini tidak bisa lagi digunakan!!</center>
	</div>
</div>
					
					
		
<script type="text/javascript">
	$('#btn_cek2').click(function(){
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
			