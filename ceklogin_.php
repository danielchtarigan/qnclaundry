<?php
include 'config.php';
session_start();
$userId = $_POST['uname'];
$outlet = $_POST['nama_outlet'];
	 
if (isset($outlet)){
	 $qlo = mysqli_query($con, "select * from outlet where nama_outlet='$outlet'"); 
	 $rcek = mysqli_fetch_array($qlo);
	
	  $a = $rcek['latitude'] - $_POST['lat'];
	  $b = $rcek['longitude'] - $_POST['long'];
/*	  if (($a >= 0.0002) or ($a <= -0.0165)){
	  ?>
	   <script type="text/javascript">
	    alert("Peringatan! Lokasi anda terlalu jauh dari Outlet Quick & Clean");
	    location.href="http://qnclaundry.com/";
	   </script>
	  <?php
	  }
        else{
*/	
	$data = mysqli_fetch_array(mysqli_query($con,"select * from user where name='".$userId."'"));
	if($data !== false && $data['password'] == md5($_POST['passwd'])){
		//login berhasil
		$_SESSION['id'] = $data['user_id'];
		$_SESSION['level'] = $data['level'];
		$_SESSION['user_id'] = $data['name'];
		$_SESSION['nama_outlet']=$outlet;
		$_SESSION['my_user_agent'] = md5($_SERVER['HTTP_USER_AGENT']);
		if ($_SESSION['level'] == "admin"){
		header("location: admin/index.php");
		}
		else if ($_SESSION['level'] == "reception"){			
		header("location: reception/index.php");	
		}
		else if ($_SESSION['level'] == "operator"){
		header("location: operator/index.php");	
		}
		else if ($_SESSION['level'] == "packer"){
		header("location: packer/index.php");	
		}
	}
	else{
		echo "ID User atau password salah!";
		header("location: index.php");
	}
//	}
}
else{
	
	$data = mysqli_fetch_array(mysqli_query($con,"select * from user where name='".$userId."'"));
	if($data !== false && $data['password'] == md5($_POST['passwd'])){
		//login berhasil
		$_SESSION['id'] = $data['user_id'];
		$_SESSION['level'] = $data['level'];
		$_SESSION['user_id'] = $data['name'];
		$_SESSION['nama_outlet']=$outlet;
		$_SESSION['my_user_agent'] = md5($_SERVER['HTTP_USER_AGENT']);
		if ($_SESSION['level'] == "admin"){
		header("location: admin/index.php");
		}
		else if ($_SESSION['level'] == "reception"){			
		header("location: reception/index.php");	
		}
		else if ($_SESSION['level'] == "operator"){
		header("location: operator/index.php");	
		}
		else if ($_SESSION['level'] == "packer"){
		header("location: packer/index.php");	
		}
	}
	else{
		echo "ID User atau password salah!";
		header("location: index.php");
	}
	}
	
?>