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

$setoran_bersih = htmlspecialchars($_REQUEST['setoran_bersih']);
$pengeluaran = htmlspecialchars($_REQUEST['pengeluaran']);
$untuk = htmlspecialchars($_REQUEST['untuk']);
$ijin = htmlspecialchars($_REQUEST['ijin']);
$edc_bri = htmlspecialchars($_REQUEST['edc_bri']);
$edc_mandiri = htmlspecialchars($_REQUEST['edc_mandiri']);
$edc_bca = htmlspecialchars($_REQUEST['edc_bca']);
$edc_bni = htmlspecialchars($_REQUEST['edc_bni']);

include '../config.php';

$sql =  "insert into tutup_kasir(setoran_bersih,pengeluaran,untuk,ijin,edc_mandiri,edc_bri,edc_bni,edc_bca,tanggal,outlet,reception) values('$setoran_bersih','$pengeluaran','$untuk','$ijin','$edc_mandiri','$edc_bri','$edc_bni','$edc_bca','$jam','$ot','$us')";
$result = @mysqli_query($con,$sql);
if ($result){

$to  = 'quicknclean.indonesia@gmail.com' . ', '; // note the comma
$to .= 'aruldyan14@gmail.com';

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
$headers .= 'Cc: admin@qnclaundry.com' . "\r\n";
$headers .= 'Bcc: admin@qnclaundry.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
$hari = date('Y-m-d');
	$querykas = mysqli_query($con, "select * from tutup_kasir where outlet='$ot' and reception='$us' order by id desc limit 0,1");
	$rkas = mysqli_fetch_array($querykas);
	
	$qkas = mysqli_query($con, "select sum(total_bayar) as total from reception where nama_outlet='$ot' and nama_reception='$us' and tgl_input like '%$hari%'");
	$ruang = mysqli_fetch_array($qkas);
	$selisih = $ruang['total']-$setoran_bersih;


	echo <<<INFO
<div id="content" style="padding:0 50px">
<div align="center"><img src="../logo.bmp" /></div>   
<div align="left">Outlet : $ot</div>
<div align="left">Reception : $us</div>
<div align="left">	Jumlah Setoran:$setoran_bersih</div>
<div align="left">	EDC BRI: $rkas[edc_bri]</div>
<div align="left">	EDC Mandiri: $rkas[edc_mandiri]</div>
<div align="left">	EDC BCA: $rkas[edc_bca]</div>
<div align="left">	EDC BRI: $rkas[edc_bri]</div>
<div align="left">	EDC BNI: $rkas[edc_bni]</div>
<div align="left">	Jumlah kas yang harus di setorkan : $ruang[total]</div>
<div align="left">	Selisih kas : $selisih</div>
</div>
<a id="cccc" href="javascript:Clickheretoprint()">Print</a>
INFO;

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