<?php 
include '../config.php';

?>

<div id="op"></div>

<div class="" align="center">
	<form class="form-horizontal">
		<div class="form-group">
			<select class="form-control" id="nakun">
				<option>--Pilih Akun--</option>
				<?php 
				$sql = mysqli_query($con, "SELECT * FROM nama_akun");
				while($data = mysqli_fetch_assoc($sql)){
					echo '<option value="'.$data['kode_nama_akun'].'">'.$data['nama_akun'].'</option>';
				}

				?>
			</select>
		</div>

		<div class="form-group">
			<select class="form-control" id="sbakun">
				<option>--Pilih Sub Akun--</option>		
			</select>
		</div>

		<div class="form-group">
			<select class="form-control" id="nitem">
				<option>--Pilih Nama Item--</option>				
			</select>
		</div>
	</form>
</div>



<script type="text/javascript">
	$(document).ready(function(){
		var nakun = $('#nakun').val();
		$('#sbakun').load('pilih_sub_akun.php?id='+nakun);

		if(nakun!='') {
			alert("p");
		}
		
	})
</script>