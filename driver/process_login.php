<?php 

include '../config.php';

function getOutlet($branch) {
	global $con;
	$data = [];
	$query = mysqli_query($con, "SELECT id_outlet AS outlet_id, nama_outlet AS outlet FROM outlet WHERE Kota = '$branch' AND active = true ORDER BY nama_outlet ASC");
	while($row = mysqli_fetch_row($query)) {
		$data[$row[0]] = [
			"outlet_id" => $row[0],
			"outlet" => $row[1]
		];
	}

	return $data;
}

function getWorkshop($branchId) {
	global $con;
	$query = mysqli_query($con, "SELECT id_workshop AS workshop_id, workshop AS workshop FROM workshop WHERE id_cabang = '$branchId' AND active = true ORDER BY workshop ASC");
	while($row = mysqli_fetch_row($query)) {
		$data[$row[0]] = [
			"workshop_id" => $row[0],
			"workshop" => $row[1]
		];
	}

	return $data;
}

$post = (isset($_POST['login'])) ? "Login" : "Drop";

switch ($post) {
	case 'Login':

		$name = $_POST['nama'];
		$password = md5($_POST['password']);

		$query = mysqli_query($con, "SELECT a.name AS courier, a.branch_id, b.cabang AS branch FROM user_driver AS a RIGHT JOIN cabang AS b ON a.branch_id = b.id WHERE a.name='$name' AND a.password='$password'");
		$cek = mysqli_num_rows($query);

		if($cek>0){
			while($row = mysqli_fetch_array($query)) {
				$data = [
					"courier" => $row['courier'],
					"branch_id" => $row['branch_id'],
					"branch" => $row['branch'],
					"workshop" => getWorkshop($row['branch_id']),
					"outlet" => getOutlet($row['branch'])
				];
			}

			$response = [
				"success" => true,
				"message" => "Login sukses",
				"data" => $data
			];
		} else {
			$response = [
				"success" => false,
				"message" => "Username dan Password salah !"
			];
		}
		
		echo json_encode($response);

		break;
	
	case 'Drop':
		
		$name = $_POST['nama'];
		$lokasiform = $_POST['lokasiform'];
		$lokasi = $_POST['lokasi'];
		$keterangan = $_POST['keterangan'];

		$aktif = $con->query("UPDATE user_driver SET status='1', lokasiform='$lokasiform', lokasi='$lokasi', keterangan='$keterangan', created_at=NOW() WHERE name='$name'");

		break;
}