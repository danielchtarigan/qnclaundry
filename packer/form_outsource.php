<?php 
include '../config.php';
include 'header.php';


$nowDate = date('Y-m-d');
$dateYes = date('Y-m-d H:i:s', strtotime('-10 days', strtotime($nowDate)));

?>
<style type="text/css">
    @import "dataTables/media/css/demo_table_jui.css";
    @import "dataTables/media/themes/smoothness/jquery-ui-1.8.4.custom.css";
</style>

<div class="col-md-5 col-xs-12">
	<div class="panel panel-default">		
		<div class="panel-body">
			<h4><i class="ace-icon glyphicon glyphicon-tag"></i> Form Outsource</h4>
			<p id="pesan_e" style="color: red"></p>
			<div class="form-horizontal">
	    		<select class="form-control" id="jenis">
	    			<option value="">--Pilih Jenis Outsource--</option>
	    			<option value="Cuci Kering">&nbsp; &nbsp; Cuci Kering</option>
	    			<option value="Cuci Kering Setrika">&nbsp; &nbsp; Cuci Kering Setrika</option>
	    			<option value="Cuci Kering Setrika Packing">&nbsp; &nbsp; Cuci Kering Setrika Packing</option>
	    			<option value="Setrika">&nbsp; &nbsp; Setrika Saja</option>
	    		</select>
	    		<br>
			    <input class="form-control" placeholder="Scan Nomor Nota..." autocomplete="off" id="cari">
			    <br>
			    <div class="row">  
			    		
			    	<div class="col-md-6 hidden" id="satu">
			    		<?php 
			    		$query = mysqli_query($con, "SELECT * FROM reception WHERE spk=true AND lunas=true AND nama_outlet<>'mojokerto' ");
			    		$ncek = mysqli_num_rows($query);
						while($result = mysqli_fetch_assoc($query)){
							$no = $result['no_nota']; ?>
							 <input type="checkbox" name="<?=$no?>" value="<?=$no?>" class="cb-element" id="<?=$no?>" onchange="add_sub(this);"> <?=$no?><br>
							 <?php
						}

			    		?>  		
			    	</div> 
			    	<div class="col-md-4 col-xs-6">
			    		<input type="text" name="" id="jumlah" class="form-control pull-left" readonly="">	
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
			var jenis = $('#jenis').val();
			$.ajax({
				url 	: 'simpan_outsource.php',
				data 	: 'nota='+nota+'&jenis_out='+jenis,
				type 	: 'POST',
				success : function(data){
					$('#pesan_e').html(data);
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