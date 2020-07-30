<?php
include '../../config.php';

$data = $_POST['data'];

foreach ($data as $nota) {
    $orders = "UPDATE reception SET ambil=1 WHERE no_nota='$nota'";
    $query = mysqli_query($con, $orders);
}

if ($query) {
    echo count($data)." nota cucian baru saja diambil";
}

?>