<?php
include "../../config.php";
if (isset($_POST['id'])) {
	
	
$sql=$con->query("select id,packing_number from corp_packing_list WHERE id= '".$_POST['id']."' limit 1 ");
$r = $sql->fetch_assoc();
$nomor=$r['order_number'];
$idlist=$r['id'];
	mysqli_query($con,"delete from corp_packing_list where id= '".$_POST['id']."'");
	mysqli_query($con,"delete from corp_packing_item where id_order_list= '$idlist'");
	

}
?>