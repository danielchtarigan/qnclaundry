<?php 
include '../config.php';

$dateYes = date('Y-m-d H:i:s', strtotime('-1 days', strtotime($nowDate)));

?>
<style type="text/css">
    @import "dataTables/media/css/demo_table_jui.css";
    @import "dataTables/media/themes/smoothness/jquery-ui-1.8.4.custom.css";
</style>

<div class="col-md-5 col-xs-12">
	<div class="panel panel-default">		
		<div class="panel-body">
			<h4><i class="ace-icon glyphicon glyphicon-tag"></i> Form Workshop</h4>
			<div class="form-horizontal">
			    <input class="form-control" placeholder="Scan Nomor Nota..." autocomplete="off" id="cari">
			    <br>
			    <div class="row">    	
			    	<div class="col-md-6 hidden" id="satu">
			    		<?php 
			    		$query = mysqli_query($con, "SELECT * FROM reception WHERE spk=true AND lunas=true AND packing=true AND tgl_so='0000-00-00 00:00:00' AND kembali=false AND ambil=false AND nama_outlet='$outlet'");
			    		$ncek = mysqli_num_rows($query);
						while($result = mysqli_fetch_assoc($query)){
							$no = $result['no_nota']; ?>
							 <input type="checkbox" name="<?=$no?>" value="<?=$no?>" class="cb-element" id="<?=$no?>" onchange="add_sub(this);"> <?=$no?><br>
							 <?php
						}

			    		?>  		
			    	</div> 
			    	<div class="col-md-4 col-xs-6">
			    		<input type="text" name="" id="jumlah" class="pull-left" readonly="">	
			    		<input type="submit" class="btn btn-wo btn-sm btn-success pull-left" name="" value="Simpan" style="margin-top: 10px">		    		
			    	</div> 
			    	<div class="col-md-6 col-md-offset-2 col-xs-4 col-xs-offset-2">
			    		<button class="btn btn-sm btn-default daftar-wo pull-right">Tampilkan</button>	
			    		<button class="btn btn-sm btn-default daftar-wo pull-right hidden" id="sembunyikan">Sembunyikan</button>		    		
			    	</div> 
			    	<div class="col-md-12 col-xs-4">
			    		<textarea class="hidden pull-right" id="textarea" name="type" rows="<?=$ncek?>" style="width=100%;" onclick="this.focus();this.select();" readonly required></textarea>
			    	</div> 
			    	  
			    	  	
			    </div>   
		   
		  	</div>
		</div>
	</div>
</div>
  
<div class="col-md-7 col-xs-12" id="belum_kembali">
	<?php 
	$sql = mysqli_query($con, "SELECT * FROM reception WHERE spk=true AND lunas=true AND kembali=false AND ambil=false AND tgl_so='0000-00-00 00:00:00' AND nama_outlet='$outlet'");
	$resCount = mysqli_num_rows($sql);
	echo '<div class="alert alert-warning" role="alert">'.$resCount.' Nota belum kembali<button class="btn btn-white btn-sm btn-danger pull-right btn-tampil">Tampilkan Data</button></div>';

	?>
</div>		  



<script type="text/javascript">
	$(document).ready(function(e){
		$("#cari").keypress(function(e){
			var nota = $(this).val();
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
			   	textareaValue += cbs[i].value + ' ';
			   	jumlah++;
			   }
			  $("#textarea").val(textareaValue);
			  $("#jumlah").val(jumlah);
			}
		};

		$(".btn-wo").click(function(){
			var nota = $("#textarea").val();
			$.ajax({
				url 	: 'action/simpan_workshop.php',
				data 	: 'nota='+nota,
				type 	: 'POST',
				success : function(data){
					window.location="";
				}
			})
		});


		$('.btn-tampil').on('click', function(e){
			e.preventDefault();
			$.ajax({
				url 	: 'include/data_belum_kembali.php',
				beforeSend : function(){
					$('#belum_kembali').html('<div class="alert alert-warning" role="alert">Sedang memuat...!</div>');
				},
				success : function(data){
					$('#belum_kembali').html(data);
				}
			})
		})

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