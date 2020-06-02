<?php
include "../config.php";
if (isset($_POST['id_cs'])) {
	
	
	mysqli_query($con,"update customer set lgn='1' where id= '".$_POST['id_cs']."'");
	

}
?>