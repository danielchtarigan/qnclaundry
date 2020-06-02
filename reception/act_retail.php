<?php
include '../config.php';
session_start();

include 'code.php';

date_default_timezone_set('Asia/Makassar');
$jam = date("Y-m-d h:i:s");	 

$ot = $_SESSION['nama_outlet'];
$id_cust = $_GET['id_cust'];

$item1 = substr($_GET['itemretail1'],0,4);
$item2 = substr($_GET['itemretail2'],0,4);
$item3 = substr($_GET['itemretail3'],0,4);


if ($item1<>""){

$harga1 = $_GET['harga1'];
$jumlah1 = $_GET['jumlah1'];
$dasar1 = $harga1/$jumlah1;
	
	$qrincian1 = mysqli_query($con, "insert into detail_retail values ('', '$jam', '$item1', '$dasar1', '$jumlah1', '$harga1', '$nofaktur', '$id_cust', '0')");
}

if ($item2<>""){

$harga2 = $_GET['harga2'];
$jumlah2 = $_GET['jumlah2'];
$dasar2 = $harga2/$jumlah2;

	$qrincian2 = mysqli_query($con, "insert into detail_retail values ('', '$jam', '$item2', '$dasar2', '$jumlah2', '$harga2', '$no_faktur', '$id_cust', '0')");
}

if ($item3<>""){

$harga3 = $_GET['harga3'];
$jumlah3 = $_GET['jumlah3'];
$dasar3 = $harga3/$jumlah3;

	$qrincian3 = mysqli_query($con, "insert into detail_retail values ('', '$jam', '$item3', '$dasar3', '$jumlah3', '$harga3', '$no_faktur', '$id_cust', '0')");
}

	if (isset($_GET['status'])){
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="index.php?id=<?php echo $id_cust; ?>&status=<?php echo $_GET['status']; ?>&selesai=ya&faktur=<?php echo $nofaktur;?>";
</script>
<?php
		}
	 else{
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="index.php?id=<?php echo $id_cust; ?>&selesai=ya&faktur=<?php echo $nofaktur;?>";
</script>
<?php
	 }
	 ?>	