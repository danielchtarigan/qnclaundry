<?php
///rupiah adalah fungsi yang nantinya akan kita panggil
     function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
     session_start();
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];

include "../config.php";
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
$id_cs=$_POST['id_customer2'];
$no_nota=$_POST['no_nota2'];
$nama_customer=$_POST['nama_customer2'];
$selisih=$_POST['selisih'];
$notare = "R$no_nota";
$id =$_POST['reject'];
$berat =$_POST['beratitem'];

$jumlah = count($id);
for($i=0; $i < $jumlah; $i++) 
{
$updatev  = mysqli_query($con,"update detail_spk set id='$id[$i]',status='1' WHERE id='$id[$i]' ");
}

$sql5=$con->query("SELECT sum(jumlah) as total FROM detail_spk WHERE no_nota='$no_nota' and status=false");
$d = $sql5->fetch_assoc();
$t=$d['total'];

$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan WHERE no_nota= '$no_nota'");
while($data = mysqli_fetch_array($sql2)){

$inreject = mysqli_query($con,"insert into detail_reject (tgl_reject,item,harga,jumlah,no_reject,no_nota,id_customer,berat) VALUES('$jam','$data[item]','$selisih','$data[jumlah]','$notare','$no_nota','$id_cs','$berat')");




$sql=$con->query("update reception set rijeck=false,berat='$berat',jumlah='$t' WHERE  no_nota= '$no_nota'");

$sql6=$con->query("update rijeck set status=true");

?>


<script language="javascript">
function Clickheretoprint()
{ 
	var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("content").innerHTML);
    newWindow.print(); 
}
</script>

<style type="text/css">
.style1 {font-weight: bold}
.style3 {font-size: 16px}
</style>
<a id="cccc" href="javascript:Clickheretoprint()">Print</a>
	<div class="content" id="content">
  <?php include"bar128.php" ?>
  	<div align="center"><img src="../logo.bmp" /></div>
  	<div style="font-size: 12px; font-family: Arial" >
    <div align="center"></div>
 	<?php
	$sql9=mysqli_query($con,"SELECT * FROM outlet WHERE nama_outlet='$ot'");
	while($dita = mysqli_fetch_array($sql9)){
	?>
    <div align="center">Outlet : <?php echo $dita['nama_outlet']; ?></div>
    <div align="center"><?php echo $dita['alamat']; ?></div>
    <div align="center"><?php echo $dita['Kota']; ?></div>
    <div align="center"><?php echo $dita['no_telp']; ?></div>
	<?php  
		}
	?>
    <div align="center" class="style1 style4"><strong><span class="style3">Nota Reject</span></strong></div>
    <div align="center"><?php echo bar128(stripslashes($notare))?></div>
    <div>
<?php
echo 'Nama : '.$nama_customer.'<br>';
echo 'No Order : '.$no_nota.'<br>';
?>
    </div>
    <table width="40%" id="resultTable" style="text-align: left;" data-responsive="table">
      <tbody>

        <tr>
          <td width="12%"><?php echo $data['jumlah'];?></td>
          <td width="63%"><?php echo $data['item'];?></td>
          <td width="6%">&nbsp;</td>
          <td width="19%"><?php echo $data['total'];?></td>
        </tr>
			<?php  
           		 }
            ?>
        <tr>
          <td colspan="2">Total :</td>
          <td>&nbsp;</td>
          <td colspan="3"><?php echo rupiah($selisih, true);?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="mainmain">
    <p style="border: 1px solid #000000;font-size: 8px; font-family: arial;padding: 3px"><strong>Maaf cucian kami TOLAK.</strong><br/>
      <br />
      Cucian Anda tidak dapat kami proses ke tahap selanjutnya sesuai prosedural mekanisme Quick &amp;' Clean Laundry..<br/>
      <br />
      Mintalah ke Reception Kami jumlah refound untuk cucian anda sesuai yang tertera pada NOTA REJECT.<strong></strong> </p>
  </div>
  <?php
echo "Tgl $jam<br />" ?>
  <?php echo "Reception :$_SESSION[user_id]" ?>
  <tr>
    <td col="col"><br/>
      <span style='float: left; text-align:center;'><br/>
        Customer<br/>
        </br>
        </br>
        <br/>
        (<?php echo $nama_customer ?>) </span></td>
  </tr>
  <div style="page-break-before:always;">
    <div style="font-size: 12px; font-family: Arial" >
      <div></div>
    </div>
    <div>
	<!--<?php
    echo ''.$ket.'<br>';
    
    ?>-->

    </div>

  </div>
</div>

