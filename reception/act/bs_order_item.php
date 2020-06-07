<?php
include '../../config.php';

$reqData = file_get_contents('php://input');
$array = json_decode($reqData, true);

// var_dump($dataObj);

date_default_timezone_set('Asia/Makassar');
$date = date("Y-m-d H:i:s");

// create_number_order
$query = $con->query("SELECT no_order FROM detail_order_item ORDER BY id DESC");
if(mysqli_num_rows($query) > 0) {
    $row = $query->fetch_array();
    $itemCode = $row[0];
    $newnumber = 'OI'.sprintf('%04s', substr($itemCode,2,4) + 1);
}
else {
    $newnumber = 'OI0001';
}

$in = '';

foreach($array as $row => $data)
{
    $item = mysqli_real_escape_string($con, $data['item']);
    $price = mysqli_real_escape_string($con, $data['price']);
    $qty = mysqli_real_escape_string($con, $data['qty']);
    $amount = mysqli_real_escape_string($con, $data['amount']);
    $idcs = mysqli_real_escape_string($con, $data['id_customer']);

    $sql = "INSERT INTO detail_order_item (order_date, no_order, item, price, qty, amount, id_customer)
        VALUES ('$date', '$newnumber', '$item', '$price', '$qty', '$amount', '$idcs')";
    $in .= $con->query($sql);   
}

if($in) {
    header('Location : index.php?id='.$_GET['id']);
}
else {
    echo "Gagal";
}

?>