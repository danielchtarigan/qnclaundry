<?php 

$outlet = mysqli_query($con, "SELECT kode FROM outlet WHERE nama_outlet='$_SESSION[outlet]' AND Kota='$_SESSION[cabang]'");
$char = mysqli_fetch_row($outlet)[0];

$kode_order = 'SD'.$char;

$kode_faktur = 'F'.$char;


?>