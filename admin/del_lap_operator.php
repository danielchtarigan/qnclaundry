<?php
include "../config.php";
if (isset($_POST['id'])) {
mysqli_query($con,"delete from setrika where id= '".$_POST['id']."'");
}
?>