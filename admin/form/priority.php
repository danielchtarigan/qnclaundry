<?php 
if(isset($_POST['submit'])){
	$prior = mysqli_query($con, "update control_priority set omset_maks='$_POST[omsetmaks]' ");
	if($prior){?>
		<script type="text/javascript">
			alert('<?php echo 'Syarat Label Priority, Omset Kemarin harus '.rupiah($_POST['omsetmaks'])  ?>');
			location.href="index.php?menu=prioritycontrol";
		</script><?php
	}
}


?>

	<h3>Control Label Priority</h3><br>
	<div class="col-md-6 col-md-offset-0">
	<form class="form-horizontal" method="post" action="">
		<div class="from-group">
			<label class="control-label col-sm-6 col-md-6">Syarat Omset Kemarin =</label>
			<div class="col-sm-6 col-md-4">
			<?php 
			$priorm = mysqli_query($con, "select *from control_priority");
			$rslt  = mysqli_fetch_array($priorm);			
			?>
				<input class="form-control" type="number" value="<?php echo $rslt['omset_maks'] ?>" name="omsetmaks">
			</div>
		</div>		
			<div class="col-sm-6 col-md-6 col-md-offset-6">
				<input class="btn btn-md btn-primary" type="submit" name="submit" value="Ubah">
			</div>		
	</form>
	</div>
