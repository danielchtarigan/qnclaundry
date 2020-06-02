<?php
function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }

date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
session_start();
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];

$setoran = htmlspecialchars($_REQUEST['setoran']);
$nama_outlet = htmlspecialchars($_REQUEST['nama_outlet']);
$pemasukan_tgl = htmlspecialchars($_REQUEST['keterangan']);
$bank = htmlspecialchars($_REQUEST['bank']);
$referensi = htmlspecialchars($_REQUEST['referensi']);
$penerimaan1 = htmlspecialchars($_REQUEST['penerimaan1']);

include '../config.php';

$querycek = mysqli_query($con, "SELECT *FROM setoran_bank WHERE outlet='$ot' AND reception='$us' AND penerimaan1='$penerimaan1' ");

if(mysqli_num_rows($querycek)>0){
    echo "<p style='color:red'>Tanggal Penerimaan Sudah Pernah dipilih, Coba Ingat lagi, Penerimaan Kas tanggal berapa yang disetor!!!</p>";
} 
else{

$sql =  "insert into setoran_bank(setoran,tanggal,outlet,reception,setoran_tgl,bank,verifikasi,kode_referensi, penerimaan1, penerimaan2, penerimaan3, penerimaan4) values('$setoran','$jam','$nama_outlet','$us','$pemasukan_tgl','$bank','Belum','$referensi', '$penerimaan1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00')";
$result = @mysqli_query($con,$sql);
if ($result){

$to  = 'aruldyan14@gmail.com' . ', '; // note the comma
$to .= 'quicknclean.indonesia@gmail.com';

// subject
$subject = 'Setoran Bank : ';
$subject .= strip_tags($us);
$subject .=  strip_tags($ot);
$message = '<html><body>';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr><td><strong>Tanggal:</strong> </td><td>" . strip_tags($jam) . "</td></tr>";
$message .= "<tr><td><strong>Outlet:</strong> </td><td>" . strip_tags($nama_outlet) . "</td></tr>";
$message .= "<tr><td><strong>Reception:</strong> </td><td>" . strip_tags($us) . "</td></tr>";
$message .= "<tr><td><strong>Setoran:</strong> </td><td>" . strip_tags($setoran) . "</td></tr>";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'to :'.$to.'' . "\r\n";
$headers .= 'From: Setoran Bank <admin@qnclaundry.com>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
	
?>
<script type="text/javascript">
 alert("Terima kasih! Silahkan lakukan konfirmasi ke bagian Akunting untuk mempercepat proses.");
 history.back();
</script>
<?php	
/*	echo <<<INFO
<div id="content" style="padding:0 50px">
<p>	Jumlah Setoran:$setoran</p>
<p> Outlet: $ot</p>
<p>	Reception: $us</p>
</div>
<a id="cccc" href="javascript:Clickheretoprint()">Print</a>
INFO;
*/
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>
<script language="javascript">
function Clickheretoprint()
{ 
	var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("content").innerHTML);
    newWindow.print(); 
}
</script>
<?php
}
?>