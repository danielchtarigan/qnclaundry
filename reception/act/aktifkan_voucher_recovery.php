<?php
include '../../config.php';
session_start();
if (isset($_GET['d15'])){
date_default_timezone_set('Asia/Makassar');
$jam1 = date("Y-m-d");
$jam2 = date("Y-m-d", strtotime("+1 Months"));
$kode=$_GET['kode'];
$nilai=$_GET['nilai'];
if ($nilai>'50000'){
  ?>
  <script type="text/javascript">
   alert("Maaf! Nilai Voucher Maksimal Rp. 50.000. Silahkan masukkan nominal yang lebih kecil.");
   history.back();
  </script>
  <?php
}
else{
$rcp = $_SESSION['user_id'];
$cek = mysqli_query($con, "select * from voucher_recovery where kode='$kode' and status='Tidak Aktif'");
$ncek = mysqli_num_rows($cek);
if ($ncek>0){
 $query = mysqli_query($con,"update voucher_recovery set status='Aktif', nilai='$nilai', rcp='$rcp', tgl_awal='$jam1', tgl_akhir='$jam2' where kode='$kode'");
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
}