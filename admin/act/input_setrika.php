<?php 
include '../config.php';


// $tanggal = strtotime('-6 day', strtotime($date));
// $tanggal = date('Y-m-d H:i:s', $tanggal);
$nota = $_GET['nota'];
$berat = $_GET['bt'];

$qcuci = mysqli_query($con, "select date_add(tgl_spk, interval 2 day) as tanggal2 from reception where no_nota='$nota' ");
$data = mysqli_fetch_array($qcuci);
$tanggal = $data['tanggal2'];


if(isset($_POST['submit'])){
	
	$opr = $_POST['opr'];
	$tanggala = $_POST['tanggal'];

	$qcuci = mysqli_query($con, "select *from setrika where no_nota='$nota' ");
	if (mysqli_num_rows($qcuci)>0) {?>
		<script type="text/javascript">
			alert("Sudah diInput sebelumnya, Pilih nota lain!");
			location.href = "";
		</script><?php 
	}
	else{
		$query = mysqli_query($con, "update reception set setrika='1', tgl_setrika='$tanggala', user_setrika='$opr' where no_nota='$nota' ");
		$query2 = mysqli_query($con, "insert into setrika_sementara (tgl_setrika,user_setrika,no_nota,status) VALUES ('$tanggala','$opr','$nota','1')");
		$query3 = mysqli_query($con, "insert into setrika (no_nota,tgl_setrika,user_setrika,berat) VALUES ('$nota','$tanggala','$opr','$berat')");

		if ($query && $query2 && $query3) {?>
		<script type="text/javascript">
			alert("Berhasil!!");
			location.href = "";
		</script><?php 
			
		}
		else{?>
		<script type="text/javascript">
			alert("Gagal!!");
			location.href = "";
		</script><?php 
		}
	}


}

?>


<div  class="container-fluid" style="width:400px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4); color:#000000; margin-bottom: 10px; margin-top: 70px;">
   	<fieldset><legend align="center"><strong>Input Setrika</strong></legend>
		
		 	<div class="col-sm-12 col-xs-12">
				<form class="form-horizontal" action="" method="post">
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-4">No Nota</label>
						<div class="col-sm-7 col-xs-7">
							<input type="text" class="form-control" name="nota" value="<?php echo $nota ?>" readonly>
						</div>
					</div>	
								
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-4">Tanggal Setrika</label>
						<div class="col-sm-7 col-xs-7">
							<input type="text" class="form-control" name="tanggal" value="<?php echo $tanggal ?>">
						</div>		
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-4">User Setrika</label>
						<div class="col-sm-7 col-xs-7">
							<select class="form-control" name="opr">
								<option></option>
								<?php 
								$userop = mysqli_query($con, "select *from user where level='setrika' and aktif='Ya' ");
								while($user = mysqli_fetch_array($userop)){
								?>
								<option value="<?php echo $user['name'] ?>"><?php echo $user['name'] ?></option>
								<?php } ?>
							</select>
						</div>		
					</div>
					<div class="form-group">	
						<div class="col-sm-4 col-xs-4 col-sm-offset-4">
							<input class="btn btn-md btn-danger" type="submit" name="submit" value="submit">
						</div>
					</div>
				</form>
			</div>		
	        <br>
	</fieldset>
</div>

