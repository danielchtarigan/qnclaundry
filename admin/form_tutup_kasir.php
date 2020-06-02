<?php 
include 'header.php';
include '../config.php';

$nowDate = date('Y-m-d');

		

?>

<div class="container-fluid" style="width:60%; margin : 0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; margin-top:36px; color:#000000; padding-top: 20px; padding-bottom: 20px">

	<form class="form-horizontal" action="javascript:" id="f_tk">
		<div class="form-group">
			<label class="col-md-4">Tanggal</label>
			<div class="col-md-8">
				<input class="form-control" type="text" name="" id="tanggal" value="<?= $nowDate ?>" autocomplete="off">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4">Resepsionis Belum Tutup Kasir</label>
			<div class="col-md-8">
				<select class="form-control" id="rcp" required="">
					<option>Nama Resepsionis</option>
					<?php 
					// $nowDate = '2018-10-22';
					$sql = $con->query("SELECT DISTINCT(id_user) FROM log_rcp WHERE tgl_log LIKE '%$nowDate%' ORDER BY tgl_log DESC");
					while($row = $sql->fetch_array()){

						$sql2 = $con->query("SELECT * FROM tutup_shift WHERE tanggal_tutup LIKE '%$nowDate%' AND dibuat_oleh='$row[0]'");
						$csql2 = mysqli_num_rows($sql2);	
						if($csql2==0) {
							$userId = $row[0];
							echo '<option>'.$userId.'</option>';
						}
					}

					?>
				</select>
			</div>
		</div>
		<input type="submit" name="" class="btn btn-success btn-md" value="Submit">

	</form>

</div>
	
<script type="text/javascript">
	$(function(){
		$('#tanggal').datepicker({ dateFormat : 'yy-mm-dd' });

		$('#tanggal').change(function(){
			var tgl = $(this).val();
			$('#rcp').load('pilih_resepsionis.php?tgl='+tgl);
		});

		$('#f_tk').submit(function(){
			var tgl = $('#tanggal').val();
			var rcp = $('#rcp').val();
			$.ajax({
				url 	: '../function_tutup_shift.php',
				data 	: 'tgl='+tgl+'&rcp='+rcp,
				method 	: 'POST',
				success : function(data){
					window.location = "";
				}
			})
		})
	})
</script>

