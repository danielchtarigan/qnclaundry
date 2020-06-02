<?php
include '../../config.php';
session_start();
if (isset($_POST['d15'])){
$kode=$_POST['kode'];
$awal=$_POST['awal'];
$akhir=$_POST['akhir'];
$pad       = 8;
for($i=$awal; $i<=$akhir; $i++)
{
$i = str_pad($i, $pad, "0", STR_PAD_LEFT);	
mysqli_query($con,"insert into voucher_recovery (id, kode, status, user_aktif) values ('', '$kode$i', 'Tidak Aktif', '$_SESSION[user_id]')");

}
//exit;
}
?>
<script type="text/javascript">
 alert("Voucher Telah Diinput");
 location.href="../index.php?menu=add_recovery";
</script>