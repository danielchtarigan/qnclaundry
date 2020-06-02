<?php 
include '../config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$today = date("Ymd");
$query = "SELECT max(no_nota) AS last FROM setrika_hotel WHERE no_nota like '$today%'";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['last'];
 
// baca nomor urut transaksi dari id transaksi terakhir
$lastNoUrut = substr($lastNoTransaksi, 8, 4);
 
// nomor urut ditambah 1
$nextNoUrut = $lastNoUrut + 1;
 
// membuat format nomor transaksi berikutnya
$nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);


date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");

$berat=$_POST['berat'];
$nama_customer=$_POST['nama_customer'];
$ket=$_POST['ket'];
$setrika=$_POST['setrika'];
$query="insert into setrika_hotel (tgl_setrika,user_setrika,no_nota,berat,nama_hotel,ket) VALUES ('$jam','$setrika','$nextNoTransaksi','$berat','$nama_customer','$ket')";
$hasil=mysqli_query($con,$query);
if($hasil){
$edit = mysqli_query($con,"SELECT * FROM setrika_hotel WHERE no_nota='$nextNoTransaksi'");
$r   = mysqli_fetch_array($edit);
	echo 'Setrika';
	 echo "
          <form method=POST >
          <input type=hidden name=id value=$r[id]>
          <table width=100%>
          <tr>
          <td style='width:50px'>
          Setrika
          </td>        
          <td> : $r[user_setrika]</td>
          </tr>
          
          <tr><td>
          No Nota</td>        
          <td> : $r[no_nota]</td>
          </tr>
           <tr><td>
          Hotel</td>        
          <td> : $r[nama_hotel]</td>
          </tr>
          <tr>
          <td>berat</td> 
          <td> :  $r[berat]</td>
          </tr>
          </table></form>";
	
	}
	
	else {
	 echo '<font color="red" size=5>ERROR DATA GAGAL DI SIMPAN</font>';
	 }
	
?>