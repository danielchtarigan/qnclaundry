<?php 
include '../config.php';
date_default_timezone_set('Asia/Makassar');
session_start();

$tahun = substr(date('Y'), 2, 2);
$bulan = date("m");
$query = "SELECT max(no_komplain) AS last FROM komplain ORDER BY id DESC LIMIT 1";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['last'];
// baca nomor urut transaksi dari id transaksi terakhir
$lastNoUrut = substr($lastNoTransaksi, 6, 4);
 
// nomor urut ditambah 1
$nextNoUrut = $lastNoUrut + 1;
 
// membuat format nomor transaksi berikutnya
$nomor = 'CS'.$tahun.$bulan.sprintf('%04s', $nextNoUrut);
$us=$_SESSION['user_id'];
$jam=date("Y-m-d H:i:s");
$no_nota=$_POST['no_nota'];
$jenis_komplain=$_POST['jenis_komplain'];
$ket=$_POST['ket'];

$nama_customer=$_POST['nama_customer'];
     $q="insert into komplain (tgl_komplain,rcp_komplain,no_nota,jenis_komplain,ket,no_komplain,nama_customer) VALUES('$jam','$us','$no_nota','$jenis_komplain','$ket','$nomor','$nama_customer')";
     $hasil2 = mysqli_query($con,$q);
     
      if($hasil2){
           $edit = mysqli_query($con,"SELECT * FROM komplain WHERE no_komplain='$nomor'");
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


$masalah = strtoupper($jenis_komplain);
$keterangan = ucwords($ket);

$sql = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$no_nota'");
$data = mysqli_fetch_array($sql);
$customer = $data['nama_customer'];
$uscuci = $data['op_cuci'];
$ussetrika = $data['user_setrika'];
$uspacking = $data['user_packing'];

$to  = 'aruldyansst@gmail.com'.', ';
$to .= 'amma.akki1708@gmail.com';

// subject
$subject = 'Komplain : ';
$subject .= strip_tags($nomor);
$message = '<p>'.strip_tags($masalah).' : '.strip_tags($keterangan).'</p>';
$message .= '<table style="border-style: ridge; font-size: 10px" cellpadding="5">';
$message .= '<tr><td colspan="3" align="center">'.strip_tags($no_nota).'</td></tr>';
$message .= '<tr><td>Nama Customer</td><td>:</td><td>'.$customer.'</td></tr>';
$message .= '<tr><td>Cuci > Tanggal</td><td>:</td><td>'.strip_tags($uscuci.' > '.date('d/m/Y', strtotime($data['tgl_cuci']))).'</td></tr>';
$message .= '<tr><td>Setrika > Tanggal</td><td>:</td><td>'.strip_tags($ussetrika.' > '.date('d/m/Y', strtotime($data['tgl_setrika']))).'</td></tr>';
$message .= '<tr><td>Packing > Tanggal</td><td>:</td><td>'.strip_tags($uspacking.' > '.date('d/m/Y', strtotime($data['tgl_packing']))).'</td></tr>';
$message .= '</table>';
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'to :'.$to.'' . "\r\n";
$headers .= 'From: Form Komplain <admin@qnclaundry.com>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);



?>
