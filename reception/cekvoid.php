<?php
include '../config.php';

$nota = $_GET['nota'];

$query = mysqli_query($con, "select * from reception where no_nota='$nota'");
$row = mysqli_fetch_array($query);

if(mysqli_num_rows($query)==1){
    $ceknota = mysqli_query($con, "SELECT * FROM nota_void WHERE no_nota='$nota'");
    if(mysqli_num_rows($ceknota)<1){
        $qfaktur = mysqli_fetch_array(mysqli_query($con, "SELECT * from faktur_penjualan WHERE no_faktur='$row[no_faktur]'"));	
	    $data = array(
	                'harganota'     =>  $row['total_bayar'],	            
	                'faktur'    	=>  $row['no_faktur'],
	                'hargafaktur'	=> 	$qfaktur['total'], 	                    
	                );
	    echo json_encode($data);
    } else{
        $data = array(
	                'harganota'     =>  'Nomor Nota sudah pernah dikirim!',
	                'faktur'        =>  'Nomor Nota sudah pernah dikirim!',
	                'hargafaktur'	=> 	'Nomor Nota sudah pernah dikirim!',
	                );
	   echo json_encode($data);
    }
       
	
} else{
	$data = array(	            
	            'harganota'     =>  'Nomor Nota Salah..!',	            
	            'faktur'    	=>  'Nomor Nota Salah..!',
	            'hargafaktur'	=> 	'Nomor Nota Salah..!',  	                    
	            );
	 echo json_encode($data);
}

?>