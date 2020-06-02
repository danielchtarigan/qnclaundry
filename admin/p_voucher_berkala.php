<?php
include '../config.php';
session_start();
if (isset($_POST['d15'])){
$kategori=$_POST['kategori'];
$periode_awal=$_POST['periode_awal'];
$periode_akhir=$_POST['periode_akhir'];
$minimum_transaksi=$_POST['minimum_transaksi'];
$maksimum_transaksi=$_POST['maksimum_transaksi'];
$awal=$_POST['awal'];
$akhir=$_POST['akhir'];
$outlet=$_POST['outlet'];
$diskon=$_POST['diskon'];
$hariini=date('Y-m-d');
$pad       = 5;
for($i=$awal; $i<=$akhir; $i++)
{
$i = str_pad($i, $pad, "0", STR_PAD_LEFT);	
//echo "d50$i<br>";
mysqli_query($con,"insert into voucher_berkala values ('','BC$i','$outlet','$diskon','$periode_awal','$periode_akhir', '$minimum_transaksi', '$maksimum_transaksi', 'aktif', '$_SESSION[user_id]','$hariini','$kategori')");

}


//exit;
}
?>
<script type="text/javascript">
 alert("Voucher Telah Diinput");
 location.href="index.php?menu=VoucherPromoSMS";
</script>