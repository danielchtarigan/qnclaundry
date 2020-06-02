<?php 
include '../../config.php';

foreach($_POST['id'] as $key=>$val){
	$id = (int) $_POST['id'][$key];
	mysqli_query($con, "UPDATE customer SET lgn='0' WHERE id='$id'");
	mysqli_query($con, "UPDATE langganan SET all_kuota='0', kilo_cks='0', potongan='0' WHERE id_customer='$id'");
}

?>

<script type="text/javascript">
	location.href="../laporan.php?menu=langganan";
</script>

