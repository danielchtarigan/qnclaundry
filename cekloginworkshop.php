<?php
include 'config.php';
session_start();
$userId = $_POST['uname'];
$workshop = $_POST['workshop'];
if ($workshop==""){
	?>
    <script type="text/ecmascript">
	 alert("Silahkan Pilih Lokasi Workshop Anda Terlebih Dahulu!");
	 location.href='login.php?status=workshop';
	</script>
    <?php
}
else{
$key = $_POST['key'];
$date = date("Y-m-d h");	 
date_default_timezone_set('Asia/Makassar');
	$data = mysqli_fetch_array(mysqli_query($con,"select * from user where name='".$userId."'"));
	if($data !== false && $data['password'] == md5($_POST['passwd'])){
		//login berhasil		
		$_SESSION['id'] = $data['user_id'];
		$_SESSION['level'] = $data['level'];
		$_SESSION['user_id'] = $data['name'];
		$_SESSION['workshop']=$workshop;
		$_SESSION['outlet']=$data['outlet'];		
		$_SESSION['type']=$data['type'];
		$_SESSION['subagen']=$data['subagen'];
		$_SESSION['cabang']=$data['cabang'];
		$_SESSION['my_user_agent'] = md5($_SERVER['HTTP_USER_AGENT']);
		if ($_SESSION['level'] == "admin"){			
		header("location: admin/index.php");
		}			
		else if ($_SESSION['level'] == "operator"){	
		$ceklog = mysqli_query($con,"select * from log_workshop where tgl_log like '%$tgl%' and id_user='$userId' and id_outlet='$workshop'");
			$nlog = mysqli_num_rows($ceklog);
			if ($nlog==0){
				$datelog=date('Y-m-d H:i:s');
				mysqli_query($con,"insert into log_workshop values ('$datelog', '".$userId."','".$workshop."')");
			}				
		header("location: operator/index.php");	
		}
		else if ($_SESSION['level'] == "packer"){
		$ceklog = mysqli_query($con,"select * from log_workshop where tgl_log like '%$tgl%' and id_user='$userId' and id_outlet='$workshop'");
			$nlog = mysqli_num_rows($ceklog);
			if ($nlog==0){
				$datelog=date('Y-m-d H:i:s');
				mysqli_query($con,"insert into log_workshop values ('$datelog', '".$userId."','".$workshop."')");
			}				
		header("location: packer/index.php");	
		}
		else if ($_SESSION['level'] == "delivery"){
		$ceklog = mysqli_query($con,"select * from log_workshop where tgl_log like '%$tgl%' and id_user='$userId' and id_outlet='$workshop'");
			$nlog = mysqli_num_rows($ceklog);
			if ($nlog==0){
				$datelog=date('Y-m-d H:i:s');
				mysqli_query($con,"insert into log_workshop values ('$datelog', '".$userId."','".$workshop."')");
			}				
		header("location: delivery/index.php");
		}
		else if ($_SESSION['level'] == "spectator"){
		$ceklog = mysqli_query($con,"select * from log_workshop where tgl_log like '%$tgl%' and id_user='$userId' and id_outlet='$workshop'");
			$nlog = mysqli_num_rows($ceklog);
			if ($nlog==0){
				$datelog=date('Y-m-d H:i:s');
				mysqli_query($con,"insert into log_workshop values ('$datelog', '".$userId."','".$workshop."')");
			}				
		header("location: spectator/index.php");
		} 		
		else if ($_SESSION['level'] == "gudang"){
		$ceklog = mysqli_query($con,"select * from log_workshop where tgl_log like '%$tgl%' and id_user='$userId' and id_outlet='$workshop'");
			$nlog = mysqli_num_rows($ceklog);
			if ($nlog==0){
				$datelog=date('Y-m-d H:i:s');
				mysqli_query($con,"insert into log_workshop values ('$datelog', '".$userId."','".$workshop."')");
			}				
		header("location: accounting/index.php");
		}
	}
	else{
	?>
    <script type="text/ecmascript">
	 alert("Username dan Password Salah!");
	 location.href='login.php';
	</script>
    <?php
	}		
}
?>