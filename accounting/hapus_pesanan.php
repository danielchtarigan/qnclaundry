<?php 
if(isset($_POST['id'])){ ?>
	<div class="pesanx" align="center"></div>
	<div>			
		<p align="center">Hapus?</p>
		<input class="hidden" type="text" name="kodex" id="kodex" value="<?php echo $_POST['id'] ?>">
		<div align="center">				
			<button class="btn btn-default btn-xs hapus">Ya</button>	
		</div>
	</div> <?php
}

?>	

		

<script type="text/javascript">
	$(".hapus").click(function(){			
		var kode = $("#kodex").val();
		$.ajax({
			type : 'post',
			url : 'action/hapus_pesanan.php',
			data :  'kodex='+ kode,
			success : function(data){
			$('.pesanx').html(data);//menampilkan data ke dalam modal
			}
		})
	})
</script>