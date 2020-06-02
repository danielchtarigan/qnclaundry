 <?php
 include '../config.php';
  $id=$_POST['id'];
 $tambah=mysqli_query($con,"delete from detail_spk WHERE id='$id'");
 	
?>