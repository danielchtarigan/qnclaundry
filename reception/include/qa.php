<body onload="print()">
<?php
include '../../config.php';
$id = $_GET['id'];
$sql = mysqli_query($con,"SELECT * From customer where id = '$id'");
$data = mysqli_fetch_array($sql); 
?>
<p align='canter'><strong>FORM QUALITY AUDIT</strong></p>
<table width="100%">
 <tr>
  <td>ID Customer</td><td>: <?php echo $id; ?></td>
 </tr>
 <tr>
  <td>Nama Customer</td><td>: <?php echo $data['nama_customer']; ?></td>
 </tr>
 <tr>
  <td>Kebersihan</td><td>&nbsp;</td>
 </tr>
 <tr>
  <td colspan="2"><input type="radio" /> 1 <input type="radio" /> 2 <input type="radio" /> 3 <input type="radio" /> 4 <input type="radio" /> 5 </td>
 </tr>
 <tr>
  <td>Keharuman</td><td>&nbsp;</td>
 </tr>
 <tr>
  <td colspan="2"><input type="radio" /> 1 <input type="radio" /> 2 <input type="radio" /> 3 <input type="radio" /> 4 <input type="radio" /> 5 </td>
 </tr>
 <tr>
  <td>Kerapian</td><td>&nbsp;</td>
 </tr>
 <tr>
  <td colspan="2"><input type="radio" /> 1 <input type="radio" /> 2 <input type="radio" /> 3 <input type="radio" /> 4 <input type="radio" /> 5 </td>
 </tr>
 <tr>
  <td>Ketepatan Waktu</td><td>&nbsp;</td>
 </tr>
 <tr>
  <td colspan="2"><input type="radio" /> Ya <input type="radio" /> Tidak </td>
 </tr>
 <tr>
  <td>Ketepatan Jumlah</td><td>&nbsp;</td>
 </tr>
 <tr>
  <td colspan="2"><input type="radio" /> Ya <input type="radio" /> Tidak </td>
 </tr>
 <tr>
  <td>Kritik dan Saran</td><td>&nbsp;</td>
 </tr>
 <tr>
  <td colspan="2">
  <textarea cols="50" rows="10"></textarea>
  </td>
 </tr>
</table>
</body>