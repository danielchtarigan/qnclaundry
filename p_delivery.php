<?php
	include 'config.php';

    date_default_timezone_set('Asia/Makassar');	
	$jam = date("Y-m-d H:i:s");
	$jenis = $_POST['jenis'];

	switch($jenis){
		case "ceknofaktur":
			$data = null;
			$nofaktur = validate_input($_POST['nofaktur']);
			$stmt = $con->prepare("SELECT nama_customer, no_telp, alamat FROM rincian_faktur INNER JOIN customer ON rincian_faktur.id_customer=customer.id WHERE rincian_faktur.no_faktur=?");
			$stmt->bind_param("s",$nofaktur);
			$stmt->execute();
			$stmt->bind_result($data['nama_customer'],$data['no_telp'],$data['alamat']);
			if($stmt->fetch()){
				$json['status'] = "yes";
				$json['nama'] = $data['nama_customer'];
				$json['nohp'] = $data['no_telp'];
				$json['alamat'] = $data['alamat'];
			} else {
				$json['status'] = "no";
			}
			$stmt->close();
			$retjson = json_encode($json);
			echo $retjson;
			break;
		case "ceknohp":
			$data = null;
			$nohp = validate_input($_POST['nohpjemput']);
			$stmt = $con->prepare("SELECT nama_customer,alamat,outlet FROM customer WHERE no_telp=?");
			$stmt->bind_param("s",$nohp);
			$stmt->execute();
			$stmt->bind_result($data['nama_customer'],$data['alamat'],$data['outlet']);
			if($stmt->fetch()){
				$json['status'] = "yes";
				$json['nama'] = $data['nama_customer'];
				$json['alamat'] = $data['alamat'];
				$json['outlet'] = $data['outlet'];
			} else {
				$json['status'] = "no";
			}
			$stmt->close();
			$retjson = json_encode($json);
			echo $retjson;
			break;
		case "formantar":
			if(!empty($_POST['g-recaptcha-response'])){
				$secret = '6Ld4xBMUAAAAADAe6m0Cd1wpbtpuFtzBo8UymXMW';
				$response = $_POST['g-recaptcha-response'];
				$url = 'https://www.google.com/recaptcha/api/siteverify';
				$request_data['secret'] = $secret;
				$request_data['response'] = $response;
				$options = array(
					'http' => array(
						'header' => "Content-type: application/x-www-form-urlencoded\r\n",
						'method' => 'POST',
						'content' => http_build_query($request_data)
					)
				);
				$context = stream_context_create($options);
				$verify_response = file_get_contents($url, false, $context);
				$response_json = json_decode($verify_response);
				if($response_json->success){
					$no_faktur = validate_input($_POST['nofaktur']);
					$stmt = $con->prepare("SELECT id_customer FROM rincian_faktur WHERE no_faktur = ?");
					$stmt->bind_param("s",$no_faktur);
					$stmt->execute();
					$stmt->bind_result($data['id_customer']);
					if($stmt->fetch()){
						$stmt->close();
						$nama = validate_input($_POST['namaantar']);
						$tgl_permintaan = validate_input($_POST['tglantar']);
						$waktu_permintaan = validate_input($_POST['waktuantar']);
						$alamat = validate_input($_POST['alamatantar']);
						$no_telp = validate_input($_POST['nohpantar']);
						$id_customer = $data['id_customer'];
						$jenis_permintaan = "Antar";
						$catatan = validate_input($_POST['catatanantar']);
						$gateway = "Form";
						$status = "Open";

						$stmt = $con->prepare("INSERT INTO delivery (tgl_input, tgl_permintaan, waktu_permintaan, alamat, no_telp, nama_customer, id_customer, jenis_permintaan, no_faktur, catatan, gateway, status) VALUES (?, STR_TO_DATE(?,'%d/%m/%Y'), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
						$stmt->bind_param("ssssssssssss",$jam,$tgl_permintaan,$waktu_permintaan,$alamat,$no_telp,$nama,$id_customer,$jenis_permintaan,$no_faktur,$catatan,$gateway,$status);
						if($stmt->execute()){
							echo 'Process successfully';
							Redirect('http://qnclaundry.com/delivery.php');
						} else {
							echo "Error: " . $query . "<br>" . mysqli_error($con);
						}
						$stmt->close();
					} else {
						$stmt->close();
					}
				}else{
					
				}
			}else{

				$message = 'Please click on the reCaptcha box';
				$error_json['message'] = $message;
				$error_json['jenis'] = "delivery";
				error_response("delivery",$error_json);
			}
			break;
		case "formjemput":
			if(!empty($_POST['g-recaptcha-response'])){
				$secret = '6Ld4xBMUAAAAADAe6m0Cd1wpbtpuFtzBo8UymXMW';
				$response = $_POST['g-recaptcha-response'];
				$url = 'https://www.google.com/recaptcha/api/siteverify';
				$request_data['secret'] = $secret;
				$request_data['response'] = $response;
				$options = array(
					'http' => array(
						'header' => "Content-type: application/x-www-form-urlencoded\r\n",
						'method' => 'POST',
						'content' => http_build_query($request_data)
					)
				);
				$context = stream_context_create($options);
				$verify_response = file_get_contents($url, false, $context);
				$response_json = json_decode($verify_response);
				if($response_json->success){
					$no_telp = validate_input($_POST['nohpjemput']);
					$nama = validate_input($_POST['namajemput']);
					$stmt = $con->prepare("SELECT id FROM customer WHERE no_telp = ?");
					$stmt->bind_param("s",$no_telp);
					$stmt->execute();
					$stmt->bind_result($data['id']);

					$outlet = validate_input($_POST['outlet']);
					$alamat = validate_input($_POST['alamatjemput']);
					$tgl_permintaan = validate_input($_POST['tgljemput']);
					$waktu_permintaan = validate_input($_POST['waktujemput']);
					$kode_promo = validate_input($_POST['kodepromo']);
					$jenis_permintaan = "Jemput";
					$catatan = validate_input($_POST['catatanjemput']);
					$gateway = "Form";
					$status = "Open";

					if($stmt->fetch()){
						$stmt->close();
						$id_customer = $data['id'];
						$stmt_customer = $con->prepare("UPDATE customer SET outlet = ?, alamat = ? WHERE id = ?");
						$stmt_customer->bind_param("sss",$outlet,$alamat,$id_customer);
						if($stmt_customer->execute()) {
						} else {
							echo "Error: " . $query . "<br>" . mysqli_error($con);
						}
						$stmt_customer->close();
					} else {
						$stmt->close();
						$info = validate_input($_POST['info']);
						$referensi = validate_input($_POST['referensi']);
						$stmt_customer = $con->prepare("INSERT INTO customer (nama_customer, alamat, outlet, no_telp, tgl_input, info_dari, referensi, user_input) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
						$stmt_customer->bind_param("ssssssss",$nama,$alamat,$outlet,$no_telp,$jam,$info,$referensi,$gateway);
						if($stmt_customer->execute()){
						} else {
							echo "Error: " . $query . "<br>" . mysqli_error($con);
						}
						$stmt_customer->close();
						$id_customer = mysqli_insert_id($con);
					}

					$stmt = $con->prepare("INSERT INTO delivery (tgl_input, tgl_permintaan, waktu_permintaan, alamat, no_telp, nama_customer, id_customer, jenis_permintaan, catatan, gateway, status, kode_promo) VALUES (?, STR_TO_DATE(?,'%d/%m/%Y'), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("ssssssssssss",$jam,$tgl_permintaan,$waktu_permintaan,$alamat,$no_telp,$nama,$id_customer,$jenis_permintaan,$catatan,$gateway,$status,$kode_promo);
					if($stmt->execute()){
						echo 'Process successfully';
						Redirect('http://qnclaundry.com/delivery.php');
					} else {
						echo "Error: " . $query_jemput . "<br>" . mysqli_error($con);
					}
					$stmt->close();
				} else {
				}
			} else {
				$message = 'Please click on the reCaptcha box';
				$error_json['message'] = $message;
				$error_json['jenis'] = "pick";
				error_response("pick",$error_json);
			}
			break;
		default:
			break;
	}

	function error_response($antarjemput,$data){
		$json_data = json_encode($data);
		echo '<form id="myForm" action="delivery.php#'.$antarjemput.'" method="post">';
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

	function Redirect($url)
	{
	    header("refresh:1;url=$url");

	    exit();
	}
?>