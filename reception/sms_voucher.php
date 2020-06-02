<?php
include '../config.php';

$brg=mysqli_query($con, "SELECT distinct  customer.no_telp as no_telp FROM voucher_lucky INNER JOIN customer WHERE customer.id=voucher_lucky.id_customer and voucher_lucky.aktif=false");
	
   	while($r=mysqli_fetch_array($brg))
   	{
    	 $data[]=$r['no_telp'];
	}
	 $implode = implode(",",$data);
	 echo "$implode";

?>


