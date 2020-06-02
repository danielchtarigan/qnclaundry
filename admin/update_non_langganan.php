<?php
include "../config.php";
if (isset($_POST['id'])) {
	
	
$sql=$con->query("select id from customer WHERE id= '".$_POST['id']."' limit 1 ");

	mysqli_query($con,"update customer set lgn='0' where id= '".$_POST['id']."'");
	

}
?>