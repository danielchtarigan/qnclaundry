<?php
include '../config.php';
	   $tgl=$_POST['tgl'];
	   $date = new DateTime($tgl);
	   $newDate = $date->format('Y-m-d');
	   
$tgl2=$_POST['tgl2'];
	   $date2= new DateTime($tgl2);
	   $newDate2 = $date2->format('Y-m-d');

$brg=mysqli_query($con, "SELECT distinct DATE_FORMAT(reception.tgl_input, '%Y-%m-%d') as tgl_input, customer.no_telp as no_telp FROM reception INNER JOIN customer WHERE customer.id=reception.id_customer and (DATE_FORMAT(reception.tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') and reception.kembali=false and packing=false");
	
   	while($r=mysqli_fetch_array($brg))
   	{
    	 $data[]=$r['no_telp'];
	}
	 $implode = implode(",",$data);
	 echo $implode;

?>


