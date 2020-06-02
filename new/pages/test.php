<?php 
include '../config.php';

$outlets = mysqli_query($con, "SELECT * FROM outlet ");
$rows = array();
while($outlet = mysqli_fetch_assoc($outlets)) {
    $rows[] = $outlet;
}
print json_encode($rows);

?>