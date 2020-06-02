<?php
include 'config.php';
session_start();

function get_userIp(){
	if(isset($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else {
		return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
	}
}

$user_ip = get_userIp();

$userId = $_POST['userid'];
$password = $_POST['passwrd'];

date_default_timezone_set('Asia/Makassar');
$date = date("Y-m-d");

$data = mysqli_fetch_array(mysqli_query($con,"select * from user where name='".$userId."'"));
if($data !== false && $data['password'] == $_POST['passwrd']){
	//login berhasil	
	$workshop = $_POST['workshop'];	
	$outlet = $_POST['outlet'];
	$_SESSION['id'] = $data['user_id'];
	$_SESSION['level'] = $data['level'];
	$_SESSION['user_id'] = $data['name'];
	$_SESSION['workshop'] = $workshop;
	$_SESSION['outlet']=$data['outlet'];		
	$_SESSION['type']=$data['type'];
	$_SESSION['subagen']=$data['subagen'];
	$_SESSION['cabang']=$data['cabang'];
	$_SESSION['nama_outlet']=$outlet;
	$_SESSION['jenis']=$data['jenis'];
	$_SESSION['my_user_agent'] = md5($_SERVER['HTTP_USER_AGENT']);
		

		if ($_POST['level'] == "admin"){			
    		header("location: admin/index.php");
    		$datelog=date('Y-m-d H:i:s');
    		mysqli_query($con,"insert into user_ipLog values ('','$data[user_id]', '$userId','$data[level]','$datelog','$user_ip')");
		}	
		if ($_POST['level'] == "superAdmin"){			
    		header("location: admin/index.php");
    		$datelog=date('Y-m-d H:i:s');
    		mysqli_query($con,"insert into user_ipLog values ('','$data[user_id]', '$userId','$data[level]','$datelog','$user_ip')");
		}	
		else if ($_POST['level'] == "operator"){			
			$ceklog = mysqli_query($con,"select * from log_workshop where tgl_log like '%$date%' and id_user='$userId' and id_outlet='$workshop'");
			$nlog = mysqli_num_rows($ceklog);
			if ($nlog==0){
				$datelog=date('Y-m-d H:i:s');
				mysqli_query($con,"insert into log_workshop values ('$datelog', '".$userId."','".$workshop."')");
			}				
			header("location: operator/index.php");	
		}
		else if ($_POST['level'] == "packer"){	
			$ceklog = mysqli_query($con,"select * from log_workshop where tgl_log like '%$date%' and id_user='$userId' and id_outlet='$workshop'");
			$nlog = mysqli_num_rows($ceklog);
			if ($nlog==0){
				$datelog=date('Y-m-d H:i:s');
				mysqli_query($con,"insert into log_workshop values ('$datelog', '".$userId."','".$workshop."')");
			}		
			header("location: packer/index.php");
		}
		else if ($_POST['level'] == "delivery"){			
			$ceklog = mysqli_query($con,"select * from log_workshop where tgl_log like '%$date%' and id_user='$userId' and id_outlet='$workshop'");
			$nlog = mysqli_num_rows($ceklog);
			if ($nlog==0){
				$datelog=date('Y-m-d H:i:s');
				mysqli_query($con,"insert into log_workshop values ('$datelog', '".$userId."','".$workshop."')");
				mysqli_query($con,"insert into user_ipLog values ('','$data[user_id]', '$userId','$data[level]','$datelog','$user_ip')");
			}				
			header("location: delivery/index.php");
		}
		else if ($_POST['level'] == "spectator"){
			header("location: spectator/index.php");
		}
		else if ($_POST['level'] == "gudang"){
			header("location: accounting/index.php");
		}
		else if ($_POST['level'] == "reception"){	
			$key = $_POST['key'];
			$code = $_POST['code'];
			if ($key==md5("QnC".$code."QnC") or $key=="a".$code."rul"){
				$cektime = mysqli_query($con,"select * from poptime where time like '%$date%'");
				$ntime = mysqli_num_rows($cektime);
				if ($ntime>0){

				}
				else{
					$waktu1 = $date." ".sprintf('%02s', rand(7,7)).":".sprintf('%02s', rand(10,25)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu2 = $date." ".sprintf('%02s', rand(7,7)).":".sprintf('%02s', rand(40,55)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu3 = $date." ".sprintf('%02s', rand(8,8)).":".sprintf('%02s', rand(15,45)).":".sprintf('%02s', rand(0,59))."<br>";

					$waktu4 = $date." ".sprintf('%02s', rand(9,9)).":".sprintf('%02s', rand(0,15)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu5 = $date." ".sprintf('%02s', rand(9,9)).":".sprintf('%02s', rand(30,45)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu6 = $date." ".sprintf('%02s', rand(10,10)).":".sprintf('%02s', rand(0,45)).":".sprintf('%02s', rand(0,59))."<br>";

					$waktu7 = $date." ".sprintf('%02s', rand(11,11)).":".sprintf('%02s', rand(0,15)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu8 = $date." ".sprintf('%02s', rand(11,11)).":".sprintf('%02s', rand(30,59)).":".sprintf('%02s', rand(0,59))."<br>";

					$waktu9 = $date." ".sprintf('%02s', rand(13,13)).":".sprintf('%02s', rand(0,15)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu10 = $date." ".sprintf('%02s', rand(13,13)).":".sprintf('%02s', rand(30,45)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu11 = $date." ".sprintf('%02s', rand(14,14)).":".sprintf('%02s', rand(0,45)).":".sprintf('%02s', rand(0,59))."<br>";

					$waktu12 = $date." ".sprintf('%02s', rand(15,15)).":".sprintf('%02s', rand(0,15)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu13 = $date." ".sprintf('%02s', rand(15,15)).":".sprintf('%02s', rand(30,45)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu14 = $date." ".sprintf('%02s', rand(16,16)).":".sprintf('%02s', rand(0,45)).":".sprintf('%02s', rand(0,59))."<br>";

					$waktu15 = $date." ".sprintf('%02s', rand(17,17)).":".sprintf('%02s', rand(0,15)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu16 = $date." ".sprintf('%02s', rand(17,17)).":".sprintf('%02s', rand(30,59)).":".sprintf('%02s', rand(0,59))."<br>";

					$waktu17 = $date." ".sprintf('%02s', rand(19,19)).":".sprintf('%02s', rand(0,15)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu18 = $date." ".sprintf('%02s', rand(19,19)).":".sprintf('%02s', rand(30,45)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu19 = $date." ".sprintf('%02s', rand(20,20)).":".sprintf('%02s', rand(0,45)).":".sprintf('%02s', rand(0,59))."<br>";

					$waktu20 = $date." ".sprintf('%02s', rand(21,21)).":".sprintf('%02s', rand(0,15)).":".sprintf('%02s', rand(0,59))."<br>";
					$waktu21 = $date." ".sprintf('%02s', rand(21,21)).":".sprintf('%02s', rand(30,59)).":".sprintf('%02s', rand(0,59))."<br>";

				    mysqli_query($con,"insert into poptime values ('', '$waktu1')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu2')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu3')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu4')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu5')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu6')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu7')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu8')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu9')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu10')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu11')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu12')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu13')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu14')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu15')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu16')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu17')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu18')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu19')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu20')");
				    mysqli_query($con,"insert into poptime values ('', '$waktu21')");
				}				
				
				$ceklog = mysqli_query($con,"select * from log_rcp where tgl_log like '%$date%' and id_user='$userId' and id_outlet='$outlet'");
				$nlog = mysqli_num_rows($ceklog);
				if ($nlog==0){
					$datelog=date('Y-m-d H:i:s');
					mysqli_query($con,"insert into log_rcp values ('$datelog', '".$userId."','".$outlet."')");
				}			
				header("location: reception/index.php");
			}
			else {
				?>
			    <script type="text/javascript">
				 alert("Key tidak dapat digunakan!");
				 location.href='login.php';
				</script>
			    <?php
			}
				



		} //End level reception
			
}
?>