<?php
include 'config.php';
session_start();
	$old0 = md5($_POST['old0']);
	$new1 = md5($_POST['new1']);
	$uname = $_SESSION['user_id'];
	$data = mysqli_num_rows(mysqli_query($con,"select * from user where name='".$uname."' and password='".$old0."'"));
	if($data > 0 ){
		$qubah = mysqli_query($con,"update user set password = '$new1' where name='".$uname."'");
		if ($qubah){
			?>
			<script type="text/javascript">
			 alert('password telah diubah!');
			 history.back();
			</script>
			<?php
			}
			}else{
			?>
			<script type="text/javascript">
			 alert('Gagal mengubah password!');
			 history.back();
			</script>
			<?php
	}
?>