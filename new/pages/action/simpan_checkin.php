<?php 
include '../../config.php';
include '../zonawaktu.php';


$jam = date('Y-m-d');
$reception = $_SESSION['user_id'];
$outlet = $_SESSION['outlet'];

function checkInWorkshop($nota) {
	global $con;
	$query = "SELECT id FROM reception WHERE no_nota = '$nota'";
	$data = mysqli_query($con, $query);
	$row = mysqli_fetch_array($data);
	$id = $row[0];

	mysqli_query($con, "INSERT INTO bs_laundry_trackers (sales_order_id, checkout_outlet, checkin_workshop) VALUES ('$id', '1', '1') ON DUPLICATE KEY UPDATE checkout_outlet = '1', checkin_workshop = '1'");
}

$nomer=$jam . ','.$reception;
$no_nota = explode(" ",$_POST["nota"]);
  foreach($no_nota as $key => $value){
  	if($value!='') {
		$query = "UPDATE reception set workshop='$outlet',tgl_workshop='$nowDate',op_workshop='$reception' WHERE no_nota = '$value'";
  		mysqli_query($con, $query);

		checkInWorkshop($value);
  	}   	
  }


?>