<?php 
include '../../bar128.php';




?>

<div class="widget-box">
	<div class="widget-header">
		<h4>Checkout Control</h4>
	</div>

	<div class="widget-body">
		<div class="widget-main">
			<input type="" class="form-control scan" name="" value="" placeholder="Scan Nota di sini ..">
		</div>
	</div>
</div>

<div id="ceknota" class="hide">
	<?php 
	$sql = $con-> query("SELECT no_nota FROM nota_checkout");
	$ncek = mysqli_num_rows($sql);
	while($result = mysqli_fetch_assoc($sql)){
		$no = $result['no_nota']; ?>
		 <input type="checkbox" name="<?=$no?>" value="<?=$no?>" class="cb-element" id="<?=$no?>"> <?=$no?><br>
		 <?php
	}
	?>
</div>
<hr>
<div id="cekpacking" class="hide">
	<?php 
	$sql = $con-> query("SELECT * FROM reception WHERE spk=true AND lunas=true AND kembali=false AND ambil=false AND nama_outlet='$outlet'");
	$ncek = mysqli_num_rows($sql);
	while($result = mysqli_fetch_assoc($sql)){
		$no = $result['no_nota']; ?>
		 <input type="checkbox" name="<?=$no?>" value="<?=$no?>" class="cb-element" id="<?=$no?>"> <?=$no?><br>
		 <?php
	}
	?>
</div>
	


<script type="text/javascript">
	jQuery(function($){

		$('.scan').on('keypress', function(e){

			var nota = $(this).val().toUpperCase();
			var cnota = document.getElementById('ceknota').getElementsByTagName('input');
			var cpack = document.getElementById('cekpacking').getElementsByTagName('input');
			cek = 0;
			cekp = 0;
			if(e.which === 13) {
				for(var i = 0; i<cnota.length; i++) {
					if(cnota[i].value == nota) {
						cek = 1;						
					}
				}	

				for(var i = 0; i<cpack.length; i++) {
					if(cpack[i].value == nota) {
						cekp = 1;						
					}
				}	

				if (cek==0 && cekp==1){
				    window.open("document/cetak_quality_control.php?nota="+nota+"","", "width=800,height=500");	
					location.href = "";				
				} 
				else if(cek==1 && cekp==1){
					alert('No nota '+nota+' sudah dichekout');
				}		
				else if(cek==0 && cekp==0){	
					alert('No nota '+nota+' belum dipacking atau belum lunas');
				}
				
			}
		});
	})
</script>