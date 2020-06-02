<?php
include "../config.php";
if (isset($_POST['id'])) {
	
	
	mysqli_query($con,"delete from setrika_hotel where id= '".$_POST['id']."'");

}
?>