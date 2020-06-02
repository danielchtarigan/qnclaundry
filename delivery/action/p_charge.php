<?php 
include '../../config.php';

echo $_POST['biaya_delivery'];
mysqli_query($con, "UPDATE delivery SET charge='$_POST[biaya_delivery]' WHERE id='$_POST[id]'");

?>


<script type="text/javascript">
	window.location = "../index.php";
</script>