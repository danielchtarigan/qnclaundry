<?php
include 'config.php';
$cari=$_GET['no'];
$query = "SELECT * From reception where no_nota ='$cari'";
$result = mysqli_query($con,$query) or die(mysql_error());

$arr = array();
while ($row = mysqli_fetch_assoc($result)) {
    $temp = array(
	"no" => $row["no_nota"],
    "nama" => $row["nama_customer"],
    "masuk" => $row["tgl_input"], 
    "cuci" => $row["cuci"], 
    "tglcuci" => $row["tgl_cuci"],
    "setrika" => $row["setrika"], 
    "tglsetrika" => $row["tgl_setrika"],
    "pack" => $row["packing"], 
    "tglpack" => $row["tgl_packing"],
    "kembali" => $row["kembali"], 
    "tglkembali" => $row["tgl_kembali"]);
	
    array_push($arr, $temp);
}

$data = json_encode($arr);

echo "{\"app\":" . $data . "}";
?>