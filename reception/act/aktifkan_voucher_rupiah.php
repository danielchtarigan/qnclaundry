<?php
include '../../config.php';
session_start();
if (isset($_GET['d15'])){
date_default_timezone_set('Asia/Makassar');
$jam1 = date("Y-m-d");
$jam2 = date("Y-m-d", strtotime("+14 days"));
$kode=$_GET['kode'];
$rcp = $_SESSION['user_id'];
$cek = mysqli_query($con, "select * from voucher_rupiah where kode='$kode' and status='Tidak Aktif'");
$ncek = mysqli_num_rows($cek);
if ($ncek>0){
 $query = mysqli_query($con,"update voucher_rupiah set status='Aktif', rcp='$rcp', tgl_awal='$jam1', tgl_akhir='$jam2' where kode='$kode'");
  if ($query){
  ?>
  <script type="text/javascript">
   alert("Voucher Telah Diaktifkan!");
   location.href="../index.php";
  </script>
  <?php
 }
 else{
 ?>
  <script type="text/javascript">
   alert("Gagal Query!");
   history.back();
  </script>
  <?php
 }
}
else{
?>
<script type="text/javascript">
 alert("Kode Voucher tidak ditemukan!");
 history.back();
</script>
<?php
}
}
