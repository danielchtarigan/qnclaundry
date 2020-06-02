<?php 
include 'config.php';
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d H:i:s');
$kemarin = date('Y-m-d H:i:s', strtotime('-1 days', strtotime($date)));

$jam = date('Y-m-d');
$username = "AUTO";
$jumlah = 0;
$dariJumlah = 0;
$kode = "MTKAUTO";
$driver = "AUTO";

$sql = $con->query("SELECT kd_terima FROM manifest WHERE kd_terima LIKE '%$kode%' ORDER BY kd_terima DESC LIMIT 0,1");
if(mysqli_num_rows($sql)>0) {
	$rsql = $sql->fetch_array();

	$last = (int)substr($rsql['kd_terima'], 5,6) ;
}
else {
	$last = 0;
}

$next =  $last+1;
$kode_terima = $kode.sprintf('%05s', $next);

$sql = $con->query("SELECT no_nota FROM manifest a, man_serah b WHERE a.kd_serah=b.kode_serah AND a.kd_serah<>'' AND a.kd_terima='' AND DATE(b.tgl) BETWEEN '2019-02-02' AND '$date' ");

while($data = $sql->fetch_array()) {
	$nota = $data['no_nota'];

	$qrecp = $con->query("SELECT * FROM reception WHERE no_nota='$nota' AND kembali=false ");
	while($recp = $qrecp->fetch_array()){
		$outlet = $recp['nama_outlet'];
		$jenis = $recp['jenis'];
		$value = $nota;

		if(($outlet=="DAYA" || $outlet=="BTP" || $outlet=="Baruga" || $outlet=="Batua") && $jenis=="k") {
			$workshop = "Daya";

		}

		else {
			$workshop = "Toddopuli";
		}

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

// Workshop Toddopuli
// (LDK,SSD,BLV,RYL)

// Workshop DAYA
// (DYA,BTP,BRG,BTA)


?>

