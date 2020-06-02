<?php
session_start();
include 'auth.php';
include '../config.php';
include 'wassenger_send.php';

date_default_timezone_set('Asia/Makassar');
$user_delivery = $_SESSION['user_id'];
$jam = date("Y-m-d H:i:s");
if(isset($_POST['id_delivery'])){
	$id_delivery = validate_input($_POST['id_delivery']);
	$jenis = $_POST['jenis'];
	$query = "";
	$message_error = [];
	$error_json['id'] = $id_delivery;
	$from_page = "";
	switch($jenis){
		case "upload-ttd":
			$filename = 'tanda-tangan/'.$id_delivery.'.png';
			$img = $_POST['ttd'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$img = base64_decode($img);
			if(file_put_contents($filename, $img) === false){
				$json['status'] = "no";
			} else {
				$json['status'] = "yes";
			}
			$retjson = json_encode($json);
			echo $retjson;
			break;
		case "antar":
			$from_page = "sukses";
			$nama = validate_input($_POST['namapelangganantar']);
			$alamat = validate_input($_POST['alamatantar']);
			$no_telp = validate_input($_POST['noteleponantar']);
			$no_faktur = validate_input($_POST['nofakturantar']);
			$penerima = validate_input($_POST['namapenerima']);
			$latitude = validate_input($_POST['latitude']);
			$longitude = validate_input($_POST['longitude']);
			if($nama == ""){
				array_push($message_error, "Nama pelanggan harus diisi!");
			}
			if($alamat == ""){
				array_push($message_error, "Alamat harus diisi!");
			}
			if($no_telp == ""){
				array_push($message_error, "Nama telepon pelanggan harus diisi!");
			}
			if($no_faktur == ""){
				array_push($message_error, "Nomor faktur pelanggan harus diisi!");
			}
			if($penerima == ""){
				array_push($message_error, "Nama penerima harus diisi!");
			}
			// if($latitude == "" || $longitude == ""){
			// 	array_push($message_error, "Share Location harus diaktifkan!");
			// }
			$query = "UPDATE delivery SET alamat = ?, no_telp = ?, nama_penerima = ?, latitude = ?, longitude = ?, status = 'Sukses' , tgl_ok = ? WHERE id=?";
			$stmt = $con->prepare($query);
			$stmt->bind_param("sssssss",$alamat,$no_telp,$penerima,$latitude,$longitude,$jam,$id_delivery);
			
			mysqli_query($con, "UPDATE reception SET ambil='1', tgl_ambil='$jam', reception_ambil='$user_delivery' WHERE no_faktur='$no_faktur'");
			break;
		case "jemput":
			$from_page = "sukses";
			$nama = validate_input($_POST['namapelangganjemput']);
			$alamat = validate_input($_POST['alamatjemput']);
			$no_telp = validate_input($_POST['noteleponjemput']);
			$no_faktur = validate_input($_POST['nofakturjemput']);
			$kode_promo = validate_input($_POST['kodepromo']);
			$latitude = validate_input($_POST['latitude']);
			$longitude = validate_input($_POST['longitude']);
			if($nama == ""){
				array_push($message_error, "Nama pelanggan harus diisi!");
			}
			if($alamat == ""){
				array_push($message_error, "Alamat harus diisi!");
			}
			if($no_telp == ""){
				array_push($message_error, "Nama telepon pelanggan harus diisi!");
			}
			if($no_faktur == ""){
				array_push($message_error, "Nomor faktur pelanggan harus diisi!");
			}
			// if($latitude == "" || $longitude == ""){
			// 	array_push($message_error, "Share Location harus diaktifkan!");
			// }
			$query = "UPDATE delivery SET alamat = ?, no_telp = ?, no_faktur = ?, kode_promo = ?, latitude = ?, longitude = ?, status = 'Sukses', tgl_ok = ? WHERE id=?";
			$stmt = $con->prepare($query);
			$stmt->bind_param("ssssssss",$alamat,$no_telp,$no_faktur,$kode_promo,$latitude,$longitude,$jam,$id_delivery);
			break;
		case "gagal":
			$from_page = "gagal";
			$nama = validate_input($_POST['namapelanggan']);
			$alamat = validate_input($_POST['alamat']);
			$no_telp = validate_input($_POST['notelepon']);
			$pilihanalasan = validate_input($_POST['pilihanalasan']);
			$jenis_permintaan = validate_input($_POST['jenis_permintaan']);
			$no_faktur = validate_input($_POST['no_faktur']);
			$alasan = "";
			switch($pilihanalasan){
				case "alasan1":
					$alasan = "Alamat tidak ditemukan walau customer sudah dihubungi";
					break;
				case "alasan2":
					$alasan = "Pelanggan tidak dapat dihubungi";
					break;
				case "alasan3":
					$alasan = "Pelanggan tidak ada di rumah";
					break;
				default:
					$alasan = validate_input($_POST['alasan']);
					break;
			}
			$latitude = validate_input($_POST['latitude']);
			$longitude = validate_input($_POST['longitude']);
			if($nama == ""){
				array_push($message_error, "Nama pelanggan harus diisi!");
			}
			if($alamat == ""){
				array_push($message_error, "Alamat harus diisi!");
			}
			if($no_telp == ""){
				array_push($message_error, "Nama telepon pelanggan harus diisi!");
			}
			if($alasan == ""){
				array_push($message_error, "Alasan harus diisi!");
			}
			// if($latitude == "" || $longitude == ""){
			// 	array_push($message_error, "Share Location harus diaktifkan!");
			// }
			$query = "UPDATE delivery SET alamat = ?, no_telp = ?, latitude = ?, longitude = ?, alasan = ?, nama_pengantar = NULL, status = 'Open' WHERE id=?";
			$stmt = $con->prepare($query);
			$stmt->bind_param("ssssss",$alamat,$no_telp,$latitude,$longitude,$alasan,$id_delivery);
			break;
	}
	if($jenis != 'upload-ttd'){
		if(count($message_error) != 0){
			$error_json['message'] = $message_error;
			error_response($from_page, $error_json);
		} else {
			if($stmt->execute()){
				$stmt->close();
				if ($jenis=="antar") {
					$messagequery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_antar_sukses'");			
					$message = mysqli_fetch_array($messagequery)[0];
					$message = str_replace("[NO_FAKTUR]",$no_faktur,$message);
					$message = str_replace("[PENERIMA]",$penerima,$message);

					$query = "SELECT nama_outlet FROM faktur_penjualan WHERE no_faktur = ?";
					$stmt_outlet = $con->prepare($query);
					$stmt_outlet->bind_param("s",$no_faktur);
				} else if ($jenis=="jemput"){
					$messagequery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_jemput_sukses'");
					$message = mysqli_fetch_array($messagequery)[0];

					$query = "SELECT outlet FROM customer WHERE no_telp = ?";
					$stmt_outlet = $con->prepare($query);
					$stmt_outlet->bind_param("s",$no_telp);
				} else {
					$messagequery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_antar_jemput_gagal'");
					$message = mysqli_fetch_array($messagequery)[0];
					$message = str_replace("[JENIS_PERMINTAAN]",$jenis_permintaan,$message);
					$message = str_replace("[ALASAN]",$alasan,$message);

					if($jenis_permintaan == 'antar'){
						$query = "SELECT nama_outlet FROM faktur_penjualan WHERE no_faktur = ?";
						$stmt_outlet = $con->prepare($query);
						$stmt_outlet->bind_param("s",$no_faktur);
					} else {
						$query = "SELECT outlet FROM customer WHERE no_telp = ?";
						$stmt_outlet = $con->prepare($query);
						$stmt_outlet->bind_param("s",$no_telp);
					}
				}
				$stmt_outlet->execute();
				$stmt_outlet->bind_result($nama_outlet);
				$stmt_outlet->fetch();
				$stmt_outlet->close();
				if($nama_outlet){
					$query = "INSERT INTO delivery_harian (id_delivery, nama_pengantar, outlet, latitude, longitude) VALUES (?, ?, ?, ?, ?)";
					$stmt = $con->prepare($query);
					$stmt->bind_param("sssss",$id_delivery,$user_delivery,$nama_outlet,$latitude,$longitude);
					if($stmt->execute()){
						$stmt->close();
						  sendSMS($no_telp,$message); 
						  sendWassenger($no_telp,$message,"normal");
						  ?>
						<script>
							alert('Proses sukses');
							window.location = "charge.php?id=<?= $id_delivery ?>";
						</script>
						<?php 
					} else {
						$stmt->close(); ?>
						<script>alert('Proses gagal\nMohon ulangi pengisian form')</script>
						<?php Redirect('http://qnclaundry.com/delivery/');	
					}
				} else {?>
					<script>alert('Proses gagal\nOutlet pengiriman atau penjemputan tidak ditemukan.')</script>
					<?php Redirect('http://qnclaundry.com/delivery/');	
				}
			} else {
				$stmt->close(); ?>
				<script>alert('Proses gagal\n')</script>
				<?php Redirect('http://qnclaundry.com/delivery/');
			}
		}
	}
}

function error_response($suksesgagal,$data){
	$id_deliv = $data['id'];
	$json_data = json_encode($data);
	echo '<form id="myForm" action="form_'.$suksesgagal.'.php?id='.$id_deliv.'" method="post">';
	echo '<input type="hidden" name="error" value="error">';
	echo '<input type="hidden" name="message" value=\''.$json_data.'\'>';
	echo '</form>';
	echo '<script type="text/javascript">'.
			"document.getElementById('myForm').submit()".
			'</script>';
}

function validate_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function Redirect($url){
    header("refresh:1;url=$url");
    exit();
}

function sendSMS($phone,$message) {
  $userkey="tuut04fxu5a790op59wjqkk6du";
  $passkey="0xy367ndp35qrym8gr8s";
  $url = "http://qnc.zenziva.com/api/sendsms.php";
  $curlHandle = curl_init();
  curl_setopt($curlHandle, CURLOPT_URL, $url);
  curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&tipe=reguler&nohp='.$phone.'&pesan='.urlencode($message));
  curl_setopt($curlHandle, CURLOPT_HEADER, 0);
  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
  curl_setopt($curlHandle, CURLOPT_POST, 1);
  if (!$result = curl_exec($curlHandle)) {
    trigger_error(curl_error($curlHandle));
  }
  curl_close($curlHandle);
}

?>