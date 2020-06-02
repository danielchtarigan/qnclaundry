<?php
include '../config.php';


$query = mysqli_query($con, "SELECT * FROM faktur_penjualan WHERE no_faktur='$_GET[faktur]'");
$row = mysqli_fetch_array($query);

if(mysqli_num_rows($query)==1){		
	$customer = mysqli_fetch_array(mysqli_query($con, "SELECT nama_customer FROM customer WHERE id='$row[id_customer]'"));

	$data = array(
	            'hargafaktur'	=> 	$row['total'], 
	            'namac'			=>  $customer['nama_customer'],                   
	            );
	 echo json_encode($data);
} else{
	$data = array(	            
	            'hargafaktur'	=> 	'Nomor Faktur ini tidak ADA!!!',   
	            'namac'			=>  'Nomor Faktur ini Tidak ADA!!!',  	                    
	            );
	 echo json_encode($data);
}

?>