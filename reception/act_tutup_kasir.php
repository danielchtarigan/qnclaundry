@<?php
function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
     date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
$tgl = date("Y-m-d");
     session_start();
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];

$setoran_bersih = htmlspecialchars($_REQUEST['totalcash']);
$pengeluaran = htmlspecialchars($_REQUEST['keluar']);
$untuk = htmlspecialchars($_REQUEST['untuk']);
$izin = htmlspecialchars($_REQUEST['izin']);
$edc_bri = htmlspecialchars($_REQUEST['totalbri']);
$edc_mandiri = htmlspecialchars($_REQUEST['totalmdr']);
$edc_bca = htmlspecialchars($_REQUEST['totalbca']);
$edc_bni = htmlspecialchars($_REQUEST['totalbni']);
$void = htmlspecialchars($_REQUEST['void']); 
$nota_void =  htmlspecialchars($_REQUEST['nota_void']);
$pengeluaran = $pengeluaran+$void;

include '../config.php';

$ro= mysqli_query($con, "select DATE_FORMAT(tanggal_input, '%Y-%m-%d') as tanggal, sum(jumlah) as korder,resepsionis from cara_bayar where resepsionis='$us' and outlet='$ot' and DATE_FORMAT(tanggal_input, '%Y-%m-%d')='$tgl' and (cara_bayar='Cash' or cara_bayar='cash')");
WHILE($to = mysqli_fetch_array($ro)){
$rd = mysqli_query($con, "select sum(total) as deposit from faktur_penjualan where (date_format(tgl_transaksi, '%Y-%m-%d'))='$tgl' and rcp='$to[resepsionis]' and nama_outlet='$ot' and jenis_transaksi='deposit' and cara_bayar='cash'");
$td = mysqli_fetch_array($rd);
$rm = mysqli_query($con, "select sum(total) as membership from faktur_penjualan where (date_format(tgl_transaksi, '%Y-%m-%d'))='$tgl' and rcp='$to[resepsionis]' and nama_outlet='$ot' and jenis_transaksi='membership' and cara_bayar='cash'");
$tm = mysqli_fetch_array($rm);
$tot = $to['korder']+$td['deposit']+$tm['membership']-$pengeluaran;
$cek1 = $setoran_bersih-$tot;
if($cek1<='-10000'){
	echo '<p style="text-align:center">Maaf Tutup Kasir Anda tidak sesuai kas masuk</p>';
	echo '<p style="text-align:center;font-weight:bold;color:red">Selisih '.rupiah ($cek1).'</p>';
	echo '<p style="text-align:center"><a href="index.php?menu=tutup_kasir">Silahkan tutup kasir kembali!!!</a></p>';
}
else{

	
$rq = mysqli_query($con, "select DATE_FORMAT(tanggal, '%Y-%m-%d') as tanggal,outlet from tutup_kasir WHERE DATE_FORMAT(tanggal, '%Y-%m-%d')='$tgl' and reception='$us' and outlet ='$ot'");
if((mysqli_num_rows($rq))>0){
	?>
	<script type="text/javascript">
	alert("Maaf Anda sudah tutup kasir hari ini untuk outlet yang sama!");
	location.href="index.php?menu=tutup_kasir";
	</script>
<?php
}	
else{


$sql =  "insert into tutup_kasir(setoran_bersih,pengeluaran,untuk,nota_void,ijin,edc_mandiri,edc_bri,edc_bni,edc_bca,tanggal,outlet,reception) values('$setoran_bersih','$pengeluaran','$untuk','$nota_void','$izin','$edc_mandiri','$edc_bri','$edc_bni','$edc_bca','$jam','$ot','$us')";
$result = @mysqli_query($con,$sql);
if ($result){

$to  = 'quicknclean.indonesia@gmail.com';

// subject
$subject = 'Tutup Kasir : ';
$subject .= strip_tags($us);
$subject .=  strip_tags($ot);
$message = '<html><body>';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr><td><strong>Tanggal:</strong> </td><td>" . strip_tags($jam) . "</td></tr>";
$message .= "<tr><td><strong>Outlet:</strong> </td><td>" . strip_tags($ot) . "</td></tr>";
$message .= "<tr><td><strong>Reception:</strong> </td><td>" . strip_tags($us) . "</td></tr>";
$message .= "<tr><td><strong>Setoran:</strong> </td><td>" . strip_tags(rupiah($setoran_bersih)) . "</td></tr>";
$message .= "<tr><td><strong>edc bri:</strong> </td><td>" . strip_tags(rupiah($edc_bri)) . "</td></tr>";
$message .= "<tr><td><strong>edc bni:</strong> </td><td>" . strip_tags(rupiah($edc_bni)) . "</td></tr>";
$message .= "<tr><td><strong>edc bca:</strong> </td><td>" . strip_tags(rupiah($edc_bca)) . "</td></tr>";
$message .= "<tr><td><strong>edc mandiri:</strong> </td><td>" . strip_tags(rupiah($edc_mandiri)) . "</td></tr>";
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'to :'.$to.'' . "\r\n";
$headers .= 'From: Tutup Kasir <admin@qnclaundry.com>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
$hari = date('Y-m-d');
	$querykas = mysqli_query($con, "select * from tutup_kasir where outlet='$ot' and reception='$us' order by id desc limit 0,1");
	$rkas = mysqli_fetch_array($querykas);
	
	$qkas = mysqli_query($con, "select sum(total_bayar) as total from reception where nama_outlet='$ot' and nama_reception='$us' and tgl_input like '%$hari%'");
	$ruang = mysqli_fetch_array($qkas);
	$selisih = $ruang['total']-$setoran_bersih;

?>
  <script type="text/javascript">
   alert("Terima Kasih!");
   location.href="index.php?menu=tutup_kasir";
  </script>	
<?php
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>
<script type="text/javascript">
function Clickheretoprint()
{ 
	var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("content").innerHTML);
    newWindow.print(); 
}
</script>
<?php
}
}
}
?>