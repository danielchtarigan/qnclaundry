<?php
include "../config.php";
if (isset($_POST['id'])) {
	
	
	mysqli_query($con,"delete from cuci_hotel where id= '".$_POST['id']."'");

}
?>