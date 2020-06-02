<body onLoad="print();">
<?php
session_start();
include '../config.php';
include '../auth.php';
include"../bar128.php";

date_default_timezone_set('Asia/Makassar');
$jam1 = date("Y-m-d H:i:s");     
if (isset($_GET['kode'])) {
$kode=$_GET['kode'];
$tipe=substr($kode,0,3);
    $judul='MANIFEST SERAH OUTLET';
    $query = mysqli_query($con, "select * from man_serah where kode_serah='$kode'");
    $l = mysqli_fetch_array($query);
    $obj=$l['pemberi'];
$outlet=$l['tempat'];
$tgl=$l['tgl'];
$driver=$l['driver'];
$jumlah=$l['jumlah'];
?>

<!-- 
<a id="cccc" href="javascript:Clickheretoprint()">Print</a>
-->
<div class="content" id="content">
<div style="max-width:80mm;margin:5mm;">
<div align="center"><img src="../logo.bmp" /></div>   
<div style="font-size: 9pt; font-family: Tahoma" >
  <div align="center"><?=$judul;?></div>
  <br>
  <table>
  <tr><td>Outlet</td><td>&nbsp;:&nbsp;</td><td><b><?=$outlet;?></b></td></tr>
  <tr><td>Tanggal</td><td>&nbsp;:&nbsp;</td><td><b><?=$tgl;?></b></td></tr>
  <tr><td>Packer</td><td>&nbsp;:&nbsp;</td><td><b><?=$obj;?></b></td></tr>
  <tr><td>Driver</td><td>&nbsp;:&nbsp;</td><td><b><?=$driver;?></b></td></tr>
  <tr><td>Kode</td><td>&nbsp;:&nbsp;</td><td><b><?=$kode;?></b></td></tr>
  <tr><td>Jumlah Nota</td><td>&nbsp;:&nbsp;</td><td><b><?=$jumlah;?></b></td></tr>
  <tr><td valign="top">No Nota</td><td valign="top">&nbsp;:&nbsp;</td><td>
<?php
  $qman = mysqli_query($con, "select * from manifest where kd_serah3='$kode'");
    while ($rman = mysqli_fetch_array($qman)){
    echo '<input type=checkbox> '.$rman['no_nota'].'<br>';

}}
?>
  </td></tr>
  </table>
  <br><br>
<div align="center"><?php echo bar128(stripslashes($kode)); ?></div>     
</div>
</div>
</div>
</body>