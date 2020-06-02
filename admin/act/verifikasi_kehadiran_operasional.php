<?php 
include '../../config.php';
session_start();

$query = mysqli_query($con, "SELECT * FROM extra_operasional AS a INNER JOIN user AS b ON a.id_user=b.user_id WHERE b.level<>'admin' AND b.level<>'reception' AND b.level<>'delivery' AND a.hadir<>0 ");
while($data2 = mysqli_fetch_assoc($query)){
    $us_id = $data2['id_user'];


if(isset($_POST['verifikasi'])){
	$user = mysqli_query($con, "SELECT *from user WHERE level='admin' AND (jenis='manager' OR jenis='superAdmin') ");
	$cekuser = mysqli_fetch_assoc($user);
	if($_SESSION['user_id']==$cekuser['name']){
		mysqli_query($con, "UPDATE extra_operasional SET verifikasi=1, user_verify='$_SESSION[user_id]' WHERE id_user='$us_id' ");
		?>
		<script type="text/javascript">
			location.href="../kerja_operasional.php";
		</script>
	<?php
	}
	else{?>
		<script type="text/javascript">
			alert("Anda bukan Level Manager!");
			location.href="../kerja_operasional.php";
		</script>
		<?php
	}
}
}

?>