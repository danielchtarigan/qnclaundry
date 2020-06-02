
<h4 align="center">MASUKKAN ABSENSI OPERASIONAL</h4><hr>
<form class="" action="act/aksi_operasional.php" method="POST">

	<?php 
	if(count($_POST['id'])==0){?>
		<script type="text/javascript">
			location.href="kerja_operasional.php";
		</script>
	<?php 	
	}

	foreach($_POST['id'] as $key=>$val){
	$id = (int) $_POST['id'][$key];

	$extraop = mysqli_query($con, "SELECT *FROM extra_operasional WHERE id='$id'");
	$data = mysqli_fetch_array($extraop);?>

	<div class="row col-md-6 col-md-offset-0">
	
	<table class="">
		<tr class="hidden">
			<td></td>
			<td><input class="hidden" name="id[]" value="<?php echo $id ?>"></td>
		</tr>
		<tr>
			<td>NAMA &nbsp;</td>
				<?php 	
				$user = mysqli_query($con, "SELECT *FROM user WHERE user_id='".$data['id_user']."' ") ;
				$datauser = mysqli_fetch_array($user);
				?>
			<td style="font-weight: bold;"><input class="form-control" type="text" readonly="readonly" name="nama" value="<?php echo $datauser['name'].' - '.$datauser['level'].' '.$datauser['jenis']; ?>"></td>
		</tr>
		<tr>
			<td>Kehadiran &nbsp;</td>
			<td><input class="form-control" type="number" name="hadir[]" value="<?php echo $data['hadir'] ?>"></td>
		</tr>
		<tr>
			<td>Masuk Malam &nbsp;</td>
			<td><input class="form-control" type="number" name="malam[]" value="<?php echo $data['masuk_malam'] ?>"></td>
		</tr>
		<tr>
			<td>Bagi Brosur</td>
			<td><input class="form-control" type="number" name="pbrosur[]" value="<?php echo $data['poin_brosur'] ?>"></td>
		</tr>
		<tr>
			<td>Kasus Cucian</td>
			<td><input class="form-control" type="number" name="kasus[]" value="<?php echo $data['kasus_nota'] ?>"></td>
		</tr>		
	</table><br>
	</div>

	<?php 
	}
	?>
<hr>
	<div class="">
		<button class="btn btn-primary btn-xs">UPDATE DATA</button>
	</div>
		
</form>


