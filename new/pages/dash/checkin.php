



<?php 
include '../config.php';

$dateYes = date('Y-m-d H:i:s', strtotime('-1 days', strtotime($nowDate)));

?>
<style type="text/css">
    @import "dataTables/media/css/demo_table_jui.css";
    @import "dataTables/media/themes/smoothness/jquery-ui-1.8.4.custom.css";
</style>

			
			<div class="panel-header">
				<h4 style="margin-top: -25px; margin-bottom: 25px; padding-top: 20px"><i class="ace-icon glyphicon glyphicon-tag"></i> Form Checkin Nota</h4>
			</div>
			
			<div class="form-horizontal">
			    <input class="form-control" placeholder="Scan Nomor Nota..." autocomplete="off" id="cari">
			    <br>
			    <div class="row">    	
			    	<div class="col-md-6 hidden" id="satu">
			    		<?php 
			    		$query = mysqli_query($con, "SELECT * FROM reception WHERE spk=true AND packing=false AND tgl_so='0000-00-00 00:00:00' AND kembali=false AND ambil=false");
			    		$ncek = mysqli_num_rows($query);
						while($result = mysqli_fetch_assoc($query)){
							$no = $result['no_nota']; ?>
							 <input type="checkbox" name="<?=$no?>" value="<?=$no?>" class="cb-element" id="<?=$no?>" onchange="add_sub(this);"> <?=$no?><br>
							 <?php
						}

			    		?>  		
			    	</div> 

			    	<div class="col-md-4 col-xs-6">
			    		<div class="input-group">
							<span class="input-group-addon">
								<i class="ace-icon fa fa-check"></i>
							</span>
							<input type="text" name="" id="jumlah" class="form-control search-query" readonly="">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-success btn-sm btn-wo" value="Simpan">
									Simpan
									<span class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></span>
								</button>
							</span>
						</div>
			    	</div>	
			    	
			    	<div class="col-md-6 col-md-offset-2 col-xs-4 col-xs-offset-2">
			    		<button class="btn btn-sm btn-default daftar-wo pull-right">Tampilkan</button>	
			    		<button class="btn btn-sm btn-default daftar-wo pull-right hidden" id="sembunyikan">Sembunyikan</button>		    		
			    	</div> 
			    	<div class="col-md-12 col-xs-12">
			    		<textarea class="hidden pull-right" id="textarea" name="type" style="width=100%;" onclick="this.focus();this.select();" readonly required></textarea>
			    	</div> 
			    	  
			    	  	
			    </div>   
		   
		  	</div>
   



<script type="text/javascript">
	$(document).ready(function(e){
		$("#cari").keypress(function(e){
			var nota = $(this).val().toUpperCase();
			var cbs = document.getElementById('satu').getElementsByTagName('input');
			var cek = 0; 			
			if(e.which === 13) {
				for(var i = 0; i<cbs.length; i++) {
					if(cbs[i].value == nota) {
						cbs[i].checked=true;
						add_sub(this);	
						cek = 1;						
					}
				}	
				if (cek==0) alert('No nota '+nota+' tidak ditemukan');
				$("#cari").val("");
			}
			
		});

		function add_sub(el){
			var cbs = document.getElementById('satu').getElementsByTagName('input');
			var textareaValue = '';	
			var jumlah = 0;
         	for (var i = 0; i<cbs.length; i++) {
			   if(cbs[i].type === 'checkbox' && cbs[i].checked){
			   	textareaValue += cbs[i].value+' ';
			   	jumlah++;
			   }
			  $("#textarea").val(textareaValue);
			  $("#jumlah").val(jumlah);
			}
		};

		$(".btn-wo").click(function(){
			var nota = $("#textarea").val();
			$.ajax({
				url 	: 'action/simpan_checkin.php',
				data 	: 'nota='+nota,
				type 	: 'POST',
				success : function(data){
					window.location="";
				}
			})
		});


		$('.daftar-wo').on('click', function(){
			$('.daftar-wo').addClass('hidden');
			$('#textarea').removeClass('hidden');
			$('#sembunyikan').removeClass('hidden');

		})

		$('#sembunyikan').on('click', function(){
			$('.daftar-wo').removeClass('hidden');
			$('#sembunyikan').addClass('hidden');
			$('#textarea').addClass('hidden');

		})
		
	});
</script>