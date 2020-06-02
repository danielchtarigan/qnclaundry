<?php
include '../../../config.php';
$no_telp=$_GET['no_telp'];
    $sql=mysqli_query($con,"select * from customer where no_telp='$no_telp'");
    $cek=mysqli_num_rows($sql);
    echo $cek;
    
?>