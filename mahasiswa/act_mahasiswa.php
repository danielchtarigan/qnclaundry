<!-- <link href="media/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="media/ui/jquery-ui.css"> 	

<script src="media/jquery-3.2.0.min.js"></script>		
<script src="media/js/jquery.validate.js"></script> -->
	


<?php
include '../config.php';

date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$date2 = date('Y-m-d H:i:s');
if (isset($_POST['daftar'])) {
	
	$captcha = $_POST['g-recaptcha-response'];
	$secret = '6LdM0BkUAAAAAB1-eFKLq-jdzgMT0dYvEwt3hmqc';
	$remoteip = $_SERVER['REMOTE_ADDR'];
	$url = 'https://www.google.com/recaptcha/api/siteverify';

	$response = file_get_contents($url.'?secret='.urldecode($secret).'&response='.$captcha.'&remoteip='.$remoteip);
	$rdata = json_decode($response);
		
	if ($rdata -> success == true) {
		$nama = $_POST['nama'];
		$idkey = $_POST['idkey'];
		$nohp = $_POST['nohp'];
		$sekolah = $_POST['sekolah'];
		$tlahir = $_POST['tlahir'];
		$kartu = $_POST['nokartu'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];
		$outlet = $_POST['outlet'];

		$folder = 'media/image/';
		$image = $_FILES['gambar']['name'];
		$size_image = $_FILES['gambar']['size'];
		$orig = $_FILES['gambar']['tmp_name'];
		$rename_image = date('Hs').$image;
		$move = move_uploaded_file($orig, $folder.$rename_image);

			// $explode	= explode('.',$file_name);
			// $extensi	= $explode[count($explode)-1];

		$qcst = mysqli_query($con, "select *from customer WHERE id='$idkey'");
		$cekcst = mysqli_num_rows($qcst);
		$cst = mysqli_fetch_array($qcst);

		if(($cst['id'] <> '$idkey') && ($cekcst < 1)){
			$customer = mysqli_query($con, "INSERT INTO customer (id,nama_customer, no_telp, alamat, email, tgl_input) VALUES ('','$nama','$nohp','$alamat','$email','$date')");
			$masuk = mysqli_query($con, "INSERT INTO member_mahasiswa values ('', '$date2', '".$cst['id']."','$nama','$nohp','$tlahir','$sekolah','$kartu','$rename_image','6600','Kiloan','','tidak aktif','$outlet','')");
			if($customer && $masuk){
				?>
				<script type="text/javascript">
					alert("Registrasi Berhasil");
					location.href = "https://web.facebook.com/quicknclean.indonesia/?_rdr";
				</script>
				<?php		
			}
			else{
				?>
				<script type="text/javascript">
					alert("Registrasi Gagal, Silahkan Coba Lagi!");
					location.href = "index.php";
				</script>
				<?php
			}
		
		}
		else{
			$customer2 = mysqli_query($con, "UPDATE customer SET email = '$email' WHERE id='$idkey'");
			$masuk2 = mysqli_query($con, "INSERT INTO member_mahasiswa values ('','$date2','$idkey','$nama','$nohp','$tlahir','$sekolah','$kartu','$rename_image','6600','Kiloan','','tidak aktif','$outlet','')");

			if($customer2 && $masuk2){
				?>
				<script type="text/javascript">
					alert("Registrasi Berhasil!");
					location.href = "https://web.facebook.com/quicknclean.indonesia/?_rdr";
				</script>
				<?php		
			}
			else{
				?>
				<script type="text/javascript">
					alert("Registrasi Gagal, Silahkan Coba Lagi!");
					location.href = "index.php";
				</script>
				<?php
			}
		}
	}else{
		echo 'Box Captcha belum diklik. Silahkan Ulangi!<br>';
		echo '<a href="index.php">Kembali</a>';
	}

} 




	
	
	
	






?>