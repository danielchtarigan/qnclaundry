<?php 
include '../../../config.php';
session_start();
$today = date("m");
$query = "SELECT max(no_komplain) AS last FROM komplain WHERE no_komplain like '$today%'";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['last'];
// baca nomor urut transaksi dari id transaksi terakhir
$lastNoUrut = substr($lastNoTransaksi, 2, 4);
 
// nomor urut ditambah 1
$nextNoUrut = $lastNoUrut + 1;
 
// membuat format nomor transaksi berikutnya
$nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);
date_default_timezone_set('Asia/Jakarta');
$us=$_SESSION['name'];
$jam=date("Y-m-d H:i:s");
$no_nota=$_POST['no_nota'];
$jenis_komplain=$_POST['jenis_komplain'];
$ket=$_POST['ket'];

$nama_customer=$_POST['nama_customer'];
	$q="insert into komplain (tgl_komplain,rcp_komplain,no_nota,jenis_komplain,ket,no_komplain,nama_customer) VALUES('$jam','$us','$no_nota','$jenis_komplain','$ket','$nextNoTransaksi','$nama_customer')";
	$hasil2 = mysqli_query($con,$q);
	
	 if($hasil2){
	 	 $edit = mysqli_query($con,"SELECT * FROM komplain WHERE no_komplain='$nextNoTransaksi'");
$r   = mysqli_fetch_array($edit);
	?><div align="center"><img src="../logo.bmp" /></div>
<div align="center" class="style1 style4">Komplain</div>
<?php
	 echo "
          <form method=POST >
          <input type=hidden name=id value=$r[id]>
          <table width=100%>
          <tr>
          <td style='width:50px'>
          Nama Customer
          </td>        
          <td> : $r[nama_customer]</td>
          </tr>
          <tr><td>
          Tgl Komplain</td>        
          <td> : $r[tgl_komplain]</td>
          </tr>
           <tr><td>
          <tr><td>
          No Komplain</td>        
          <td> : $r[no_komplain]</td>
          </tr>
           <tr><td>
          No Nota</td>        
          <td> : $r[no_nota]</td>
          </tr>
          <tr>
          <td>Jenis</td> 
          <td> :  $r[jenis_komplain]</td>
          </tr>
          <tr>
          <td>Ket</td> 
          <td> :  $r[ket]</td>
          </tr>
          </table></form>";
	
	 	}
	else {
	 echo '<font color="red">Error, Data Sudah Ada</font>';
	 }


?>
