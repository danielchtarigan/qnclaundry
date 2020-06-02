<?php
include "../config.php";
if (isset($_POST['id'])) {
	
	
$sql=$con->query("select id,no_nota,no_faktur from reception WHERE id= '".$_POST['id']."' limit 1 ");
$r = $sql->fetch_assoc();
$no_nota=$r['no_nota'];
$no_faktur=$r['no_faktur'];
	mysqli_query($con,"delete from reception where id= '".$_POST['id']."'");
	mysqli_query($con,"delete from detail_penjualan where no_nota= '$no_nota'");
	mysqli_query($con,"delete from detail_spk where no_nota= '$no_nota'");

	

}
?>