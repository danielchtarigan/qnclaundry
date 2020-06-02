<?php
include "../config.php";
if (isset($_POST['id'])) {
mysqli_query($con,"delete from detail_spk where id= '".$_POST['id']."'");
}
?>