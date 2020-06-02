<?php 
include '../../config.php';
include '../zonawaktu.php';


$reception = $_SESSION['user_id'];
$cabang = $_SESSION['cabang'];
$outlet = $_SESSION['outlet'];

$telp = $_POST['telepon'];
$cust = $_POST['nama'];
$alamat = $_POST['alamat'];
$info = $_POST['info'];
$ref = $_POST['referensi'];

$query = mysqli_query($con, "SELECT * FROM customer WHERE no_telp='$telp'");
if(mysqli_num_rows($query)>0) {
	echo "No telp sudah pernah terdaftar!!";
} else {
	$add = mysqli_query($con, "INSERT INTO customer (nama_customer,no_telp,alamat,tgl_input,info_dari,outlet,referensi,user_input,kota) VALUES ('$cust','$telp','$alamat','$nowDate','$info','$outlet','$ref','$reception','$cabang')");

	
	$idcst = mysqli_fetch_array(mysqli_query($con, "SELECT id FROM customer WHERE no_telp='$telp'"))[0];
	if($add) {
		?>
		<script type="text/javascript">
			var id = '<?= $idcst ?>';
			alert("Customer Berhasil didaftarkan!!");
			location.href="?transaksi&id="+id;
		</script>

		<?php
	}
}

	


?>