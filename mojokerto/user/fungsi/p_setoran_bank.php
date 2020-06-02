<?php
function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }

date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
     session_start();
$us=$_SESSION['name'];
$ot=$_SESSION['nama_outlet'];

$setoran = htmlspecialchars($_REQUEST['setoran']);
$pemasukan_tgl = htmlspecialchars($_REQUEST['pemasukan_tgl']);
$bank = htmlspecialchars($_REQUEST['bank']);


include '../../../config.php';

$sql =  "insert into setoran_bank(setoran,tanggal,outlet,reception,setoran_tgl,bank) values('$setoran','$jam','$ot','$us','$pemasukan_tgl','$bank')";
$result = @mysqli_query($con,$sql);
if ($result){

$to  = 'rezadjannatin@gmail.com' . ', '; // note the comma
$to .= 'quicknclean.indonesia@gmail.com';

// subject
$subject = 'Setoran Bank : ';
$subject .= strip_tags($us);
$subject .=  strip_tags($ot);
$message = '<html><body>';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr><td><strong>Tanggal:</strong> </td><td>" . strip_tags($jam) . "</td></tr>";
$message .= "<tr><td><strong>Outlet:</strong> </td><td>" . strip_tags($ot) . "</td></tr>";
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
	
	echo <<<INFO
<div id="content" style="padding:0 50px">
<p>	Jumlah Setoran:$setoran</p>
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