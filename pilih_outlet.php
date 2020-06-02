<?php 
include 'config.php';
?>

<select class="form-control" name="outlet" id="outlet">
	<?php 
	echo '<option value="">Choose Your Outlet</option>';

	$outlets = mysqli_query($con, "SELECT nama_outlet FROM outlet WHERE Kota='$_GET[jrg]' ORDER BY nama_outlet ASC");
	while($ot = mysqli_fetch_array($outlets)){
		$outlet = $ot[0];
		echo '<option value="'.$outlet.'">&nbsp; '.ucwords($ot[0]).'</option>';
	}
	?>
</select>


<script type="text/javascript">
	$("#outlet").change(function(){
		var outlet = $(this).val().split(' ');
		var ot = outlet[0];
		$('#respon_key').load('respon_key.php?ot='+ot);

	});
</script>