<?php 
include '../admin/fungsi/saldo_delivery.php';


?>


<div class="form">
	<legend align="left">Form Setoran Kas Delivery</legend>
	<form class="form-horizontal" method="POST" action="act/setoran_delivery.php">
		<!-- <div class="form-group">
			<label class="control-label col-md-3">Tanggal Setor</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="tanggal1" id="tanggal1">
			</div>
		</div> -->
		<div class="form-group">
			<label class="control-label col-md-3">Nama Delivery</label>
			<div class="col-md-6">
				<select class="form-control" name="delivery" required="true">
					<option value=""></option>
					<?php 
					$sql = mysqli_query($con, "SELECT name FROM user WHERE level='delivery' AND subagen='' AND aktif='Ya' ORDER BY name ASC");
					while($r = mysqli_fetch_row($sql)) {
						$data = saldo_delivery($r[0]);

						if($data['saldo']>0){
							echo '<option value='.$r[0].'>'.$r[0].'</option>';
						}
							
					}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Jumlah Setor</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="jumlah" id="jumlah" required="true">
				<div id="pesan-jumlah" style="color: red"></div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6 col-md-offset-3">
				<input class="btn btn-md btn-success" type="submit" name="submit" id="submit" value="Submit">
			</div>
		</div>
			
	</form>
</div>


<script type="text/javascript">
	$("#jumlah").keypress(function(e){       
        var jumlah = $(this).val();          
        if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
            $("#pesan-jumlah").html("Isikan Angka").removeClass('hidden');
             return false;
        } else {
        	$("#pesan-jumlah").addClass('hidden');
        }
    });


</script>



