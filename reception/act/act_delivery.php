<?php
include '../../config.php';
session_start();

date_default_timezone_set('Asia/Makassar');
$jam = date('Y-m-d H:i:s');

$qsearch = mysqli_query($con,"SELECT id FROM delivery WHERE id_customer='$_GET[id_customer]' AND no_faktur IS NULL AND jenis_permintaan='Antar' ORDER BY tgl_input DESC LIMIT 1");
if (mysqli_num_rows($qsearch)>0) {
  $qdelivery = mysqli_query($con,"UPDATE delivery SET no_telp='$_GET[no_telp_antar]', alamat='$_GET[alamat_antar]', tgl_permintaan=STR_TO_DATE('$_GET[tanggal_antar]','%d/%m/%Y'), waktu_permintaan='$_GET[waktu_antar]', catatan='$_GET[catatan]' WHERE id_customer='$_GET[id_customer]' AND no_faktur IS NULL AND jenis_permintaan='Antar' ORDER BY tgl_input DESC LIMIT 1");
} else {
  $qdelivery = mysqli_query($con,"INSERT INTO delivery (tgl_input, tgl_permintaan, waktu_permintaan, alamat, no_telp, id_customer, nama_customer, jenis_permintaan, status, gateway, catatan) VALUES ('$jam',STR_TO_DATE('$_GET[tanggal_antar]', '%d/%m/%Y'),'$_GET[waktu_antar]','$_GET[alamat_antar]','$_GET[no_telp_antar]','$_GET[id_customer]','$_GET[nama_customer]','Antar','Open','Order','$_GET[catatan]')");
}
if ($qdelivery) {?>
<script type="text/javascript">
 location.href="../index.php?id=<?php echo $_GET['id_customer']; ?>&selesai=ya";
</script>
<?php } else { ?>
  <script type="text/javascript">
   alert("Data delivery gagal terinput!");
   location.href="../index.php?id=<?php echo $_GET['id_customer'] ?>";
  </script>
<?php } ?>
