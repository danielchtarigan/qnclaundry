<?php 
include '../../config.php';

if($_GET['menu']=='hapus'){
	mysqli_query($con, "UPDATE customer SET lgn=0 WHERE id='$_GET[id]'");
}
?>

<script type="text/javascript">
	location.href="../laporan.php?menu=langganan";
</script>