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

include '../../../config.php';

$sql =  "insert into tutup_kasir(setoran_bersih,pengeluaran,untuk,ijin,edc_mandiri,edc_bri,edc_bca,tanggal,outlet,reception) values('$setoran_bersih','$pengeluaran','$untuk','$ijin','$edc_mandiri','$edc_bri','$edc_bca','$jam','$ot','$us')";
$result = @mysqli_query($con,$sql);
if ($result){

$to  = 'setyawanrooney@gmail.com' . ', '; // note the comma
$to .= 'quicknclean.indonesia@gmail.com';

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
	
	echo <<<INFO
<div id="content" style="padding:0 50px">
<p>	Jumlah Setoran:$setoran_bersih</p>
<p> Outlet: $ot</p>
<p>	Reception: $us</p>
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