<?php 
include '../config.php';
session_start();

date_default_timezone_set('Asia/Makassar');
$jam = date('Y-m-d');
$date = date('Y-m-d H:i:s');
$tgl = date('l, d F Y H:i');

$username = $_SESSION['user_id'];
$workshop = $_SESSION['workshop'];

$query = "SELECT kode FROM workshop WHERE workshop='$workshop'";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);

if($_POST['keterangan']=="kotor") {

	$kode = "MTK".$data['kode'];

	$sql = $con->query("SELECT kd_terima FROM manifest WHERE kd_terima LIKE '%$kode%' ORDER BY kd_terima DESC LIMIT 0,1");
	if(mysqli_num_rows($sql)>0) {
		$rsql = $sql->fetch_array();

		$last = (int)substr($rsql['kd_terima'], 6,6) ;
		
	}
	else {
		$last = 0;
	}

	$next =  $last+1;
	$kode_terima = $kode.sprintf('%06s', $next);

	$driver = $_POST['driver'];
	$jumlah = $_POST['jumlah'];
	$dariJumlah = $_POST['dariJumlah'];

	$no_nota = explode(" ",$_POST["nota"]);
	  foreach($no_nota as $key => $value){
	  	if($value!='') {
	  		$q = mysqli_query($con," INSERT INTO man_terima (kode_terima,tgl,penerima,driver,jumlah,tempat,tipe) VALUES ('$kode_terima','$date','$username','$driver','$jumlah','$workshop','1') ");

	  		$q .= mysqli_query($con, "UPDATE manifest SET kd_terima='$kode_terima' WHERE no_nota='$value'");
	  		$q .= mysqli_query($con, "UPDATE reception SET workshop='$workshop',tgl_workshop='$date',op_workshop='$username' WHERE no_nota='$value'");

	  		$qitem = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE item LIKE 'Setrika%' AND no_nota='$value'");
	  		$countI = mysqli_num_rows($qitem);
	  		if($countI>0) {
	  			$q .= mysqli_query($con, "UPDATE reception SET cuci='1', pengering='1' WHERE no_nota='$value'");
	  		}

	  	}   	
	  }

	  echo '
    	<table>
    		<tr>
    			<td style="text-align: left">Nama</td>
    			<td style="text-align: left"> &nbsp; : &nbsp; </td>
    			<td style="text-align: left">'.$driver.'</td>
    		</tr>
    		<tr>
    			<td style="text-align: left">Checkin</td>
    			<td style="text-align: left"> &nbsp; : &nbsp; </td>
    			<td style="text-align: left">'.$workshop.'</td>
    		</tr>
    		<tr>
    			<td style="vertical-align: top; text-align: left">Tanggal</td>
    			<td style="vertical-align: top; text-align: left"> &nbsp; : &nbsp; </td>
    			<td style="vertical-align: top; text-align: left">'.$tgl.'</td>
    		</tr>
    	</table>
    	
    	</table>
    	<br>
    	<table align="center">
    		<tr>
    			<th>Nota belum tercheckin</th>
    		</tr>
    ';
    
    $sql = $con->query("SELECT no_nota FROM manifest a, man_serah b WHERE a.kd_serah=b.kode_serah AND a.kd_terima='' AND b.driver='$driver' AND DATE(b.tgl)>='2019-03-01'");
    while($data = $sql->fetch_array()){
    	echo '
    	
    		<tr>
    			<td style="text-align: center">XXXXXXX'.substr($data[0], 7, 10).'</td>			
    		</tr>
    	';
    }
    echo'
    	</table>';

    // 	if($jumlah=0){
    // 		echo '
    // 			<br>
		  //  	<a href="index.php" class="btn btn-primary btn-block">Reload</a>
    // 		';
    // 	}

	if($q) {
	    
		mysqli_query($con, "UPDATE user_driver SET status='0',lokasiform='',lokasi='',keterangan='' WHERE name='$driver'");
		
		$to  = 'amma.akki1708@gmail.com' . ', '; // note the comma
	    $to .= 'aruldyan14@gmail.com';
	    
	    $subject = 'Checkin Workshop by Driver';
	    $message = '<html><body>
	    <p>Cucian tercheckin di '.$workshop.' adalah '.$jumlah.' dari '.$dariJumlah.'</p>';

	$sql = $con->query("SELECT a.no_nota, b.driver AS kurir FROM manifest a, man_serah b WHERE a.kd_serah=b.kode_serah AND a.kd_serah<>'' AND a.kd_terima='' AND DATE_FORMAT(b.tgl, '%Y-%m-%d') >= '2019-03-01' AND b.driver='$driver' ");
	if(mysqli_num_rows($sql)>0){
	    $message .= '<p style="font-size:12px; font-weight: bold">Berikut nota-nota yang tidak tercheckin</p>
        <table width="80%" align="center">
        	<tr>
        		<th colspan="3">No Nota</th>
        	</tr>
	    ';
	    
	    while($row = $sql->fetch_array()) {
    		$nota = $row['no_nota'];
    		$kurir = $row['kurir'];
    		
    		$message .= '<tr>
    			<td style="text-align: left">'.$nota.'</td>
    			<td style="text-align: center">-</td>
    			<td style="text-align: right">'.$kurir.'</td>
    		</tr>';
    
    	}
	    
	}
	else {
	    $message .= '<p style="font-size: 12px; font-weight: bold">Status Lengkap</p>';
	}
    	
$message .= '</table>
</body>
</html>';
	    
	    // To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
	$headers .= 'to :'.$to. "\r\n";
	$headers .= 'From: Checkin Workshop Driver <admin@qnclaundry.com>' . "\r\n";
	$headers .= 'Cc: quicknclean.indonesia@gmail.com' . "\r\n";	
	    
	    mail($to,$subject,$message,$headers);
	    
	}


}