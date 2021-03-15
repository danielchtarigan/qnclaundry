<?php
include '../../config.php';
session_start();

$code = $_GET['d'];

function checkin_outlet($code) {
    global $con; $data = [];
    $query = mysqli_query($con, "SELECT a.sales_id FROM bs_check_outlet_delivery_details a RIGHT JOIN bs_check_outlet_deliveries b ON a.bs_check_outlet_delivery_id = b.id WHERE b.check_outlet_delivery_code='$code' AND type = 'in'");
    while($rows = mysqli_fetch_row($query)) {
        $data = $rows;
    }

    return $data;
}

function checkin_workshop($code) {
    global $con; $data = [];
    $query = mysqli_query($con, "SELECT a.sales_id FROM bs_check_workshop_delivery_details a RIGHT JOIN bs_check_workshop_deliveries b ON a.bs_check_workshop_delivery_id = b.id WHERE b.check_workshop_delivery_code='$code' AND type = 'in'");
    while($rows = mysqli_fetch_row($query)) {
        $data = $rows;
    }

    return $data;
}

function nota($salesId) {
    global $con;
    $query = mysqli_query($con, "SELECT no_nota FROM reception WHERE id='$salesId'");
    $rows = mysqli_fetch_row($query);
    return $rows[0];
}

if (isset($_GET['wk'])) {
    foreach (checkin_workshop($code) as $key => $value) {
        echo '<h2>Daftar Nota</h2>';
        echo nota($value).'<br>';
    }    
} else if(isset($_GET['ot'])) {
    foreach (checkin_outlet($code) as $key => $value) {
        echo '<h2>Daftar Nota</h2>';
        echo nota($value).'<br>';
    }
}

