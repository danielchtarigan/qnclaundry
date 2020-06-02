<?php 
include 'config.php';


$sql = mysqli_query($con, "SELECT DISTINCT a.no_nota, b.kategory FROM detail_penjualan a, item_spk b WHERE a.item=b.nama_item AND b.kategory<>'' AND b.kategory<>'1' AND (DATE_FORMAT(a.tgl_transaksi, '%Y-%m-%d') BETWEEN '2018-10-01' AND '2018-11-06') ORDER BY a.id DESC ");
while($data = mysqli_fetch_array($sql)){

	$nota = $data[0];

	if($data[1]=='1' OR $data[1]=='2' OR $data[1]=='3') {
		$kategory = "K";
	}
	else if($data[1]=='4' OR $data[1]=='5' OR $data[1]=='6'){
		$kategory = "P1";
	}
	else if($data[1]=='7'){
		$kategory = "P2";
	}
	else if($data[1]=='8' OR $data[1]=='9'){
		$kategory = "P3";
	}

	echo $nota.' '.$kategory .'<br>';

	mysqli_query($con, "UPDATE reception SET kategori_item='$kategory' WHERE no_nota='$nota'");
}

?>