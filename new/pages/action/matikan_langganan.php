<?php 
include '../../config.php';

mysqli_query($con, "UPDATE customer SET lgn='0' WHERE id='$_GET[id]'");

mysqli_query($con, "DELETE FROM langganan WHERE id_customer='$_GET[id]'");



?>