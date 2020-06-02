<?php
include "../config.php";
if (isset($_POST['id'])) {
	
mysqli_query($con,"delete from reception where no_nota= '".$_POST['id']."'");
mysqli_query($con,"delete from detail_penjualan where no_nota= '".$_POST['id']."'");

}
?>