<?php
include "../config.php";
if (isset($_POST['no_nota'])) {
	$no_nota=$_POST['no_nota'];
			
	mysqli_query($con,"update reception set setrika='1' WHERE no_nota = '$no_nota'");
	

}
?>