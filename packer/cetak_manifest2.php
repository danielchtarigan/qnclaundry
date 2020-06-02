<body onLoad="print();">
<?php
session_start();
include '../config.php';
include '../auth.php';
include"../bar128.php";
date_default_timezone_set('Asia/Makassar');
$jam1 = date("Y-m-d H:i:s");   
$judul='MANIFEST TERIMA WORKSHOP';  
$kode=$_GET['kode'];
    $query = mysqli_query($con, "select * from man_terima where kode_terima='$kode'");
    $l = mysqli_fetch_array($query);
    $query2 = mysqli_query($con, "select * from man_serah where kode_terima='$kode'");
    $k = mysqli_num_rows($query2);
    if ($l['tipe']==2) {
      $judul='MANIFEST TRANSFER MASUK';
    }
    $obj=$l['penerima'];
$workshop=$l['tempat'];
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
  <tr><td>Workshop</td><td>&nbsp;:&nbsp;</td><td><b><?=$workshop;?></b></td></tr>
  <tr><td>Tanggal</td><td>&nbsp;:&nbsp;</td><td><b><?=$tgl;?></b></td></tr>
  <tr><td>Operator</td><td>&nbsp;:&nbsp;</td><td><b><?=$obj;?></b></td></tr>
  <tr><td>Driver</td><td>&nbsp;:&nbsp;</td><td><b><?=$driver;?></b></td></tr>
  <tr><td>Kode Terima</td><td>&nbsp;:&nbsp;</td><td><b><?=$kode;?></b></td></tr>
  <tr><td>Jumlah Nota</td><td>&nbsp;:&nbsp;</td><td><b><?=$jumlah;?></b></td></tr>
  <tr><td>Jumlah Kode Serah</td><td>&nbsp;:&nbsp;</td><td><b><?=$k;?></b></td></tr>
  <tr><td valign="top">Kode Serah</td><td valign="top">&nbsp;:&nbsp;</td><td>
<?php
  $qman = mysqli_query($con, "select * from man_serah where kode_terima='$kode'");
    while ($rman = mysqli_fetch_array($qman)){
    echo '<input type=checkbox> '.$rman['kode_serah'].'<br>';

}
?>
  </td></tr>
  </table>
  <br><br>
<div align="center"><?php echo bar128(stripslashes($kode)); ?></div>   
</div>
</div>
</div>
</body>