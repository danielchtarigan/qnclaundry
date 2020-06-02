<?php
include '../config.php';
	   $tgl=$_POST['tgl'];
	   $date = new DateTime($tgl);
	   $newDate = $date->format('Y-m-d');


$brg=mysqli_query($con, "SELECT distinct DATE_FORMAT(reception.tgl_kembali, '%Y-%m-%d') as tgl_kembali, customer.no_telp as no_telp FROM reception INNER JOIN customer WHERE customer.id=reception.id_customer and DATE_FORMAT(reception.tgl_kembali, '%Y-%m-%d')='$newDate' and reception.ambil=false");
	
   	while($r=mysqli_fetch_array($brg))
   	{
    	 $data[]=$r['no_telp'];
	}
	 $implode = implode(",",$data);
	 echo $implode;

?>


