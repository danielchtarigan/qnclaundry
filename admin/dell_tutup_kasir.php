<?php
include "../config.php";
if (isset($_POST['id'])) {
mysqli_query($con,"delete from tutup_kasir where id= '".$_POST['id']."'");
}
?>