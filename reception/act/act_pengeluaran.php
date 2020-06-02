<?php
include '../../config.php';
session_start();
$ot = $_SESSION['nama_outlet'];
$rcp = $_SESSION['user_id'];

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');

$jam1 = date("Y-m-d H:i:s");	 
$tgl = date("Y-m-d");

$id = $_GET['id'];
$item = $_GET['item'];
$uang = $_GET['uang'];
$penerima = $_GET['penerima'];
$keterangan = $_GET['keterangan'];

$query = mysqli_query($con, "delete from pengeluaran where id='$id'");
$query = mysqli_query($con, "insert into pengeluaran values ('$id', '$ot', '$jam1', '$rcp', '$item', '$uang', '$penerima', '$keterangan')");
if ($query){
?>
<body onLoad="print()">
<style type="text/css">
.style1 {font-weight: bold}
.style3 {font-size: 16px}
</style>
<div class="content" id="content">
<div style="max-width:80mm;margin:5mm;">
<?php include"../bar128.php" ?>
<div style="font-size: 9pt; font-family: Tahoma" >
  <div align="center"></div>
  			<?php
			$sql9=mysqli_query($con,"SELECT * FROM outlet WHERE nama_outlet='$ot'");
			while($dita = mysqli_fetch_array($sql9)){
			?>
            <div align="center"><b>OUTLET : <?php echo $dita['nama_outlet']; ?></b></div>
            <br>
	<div align="center"><?php echo $dita['alamat']; ?>, <?php echo $dita['Kota']; ?></div>
            <div align="center">Call Center : 08114443180 / 0411-444180</div>
            <br>
            <?php  
                }
            ?>
            <div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-siez:10pt;">NOTA PENGELUARAN</span></strong></div>
            <div align="center"><b><?php echo $id; ?></b></div>
            <br />
     <table style="border-top: 1px dotted #000;width:100%;">
         <tr>
             <td>
                 <span style="float:left;font-size: 9pt;"><?= date('l, d M y H:iA'); ?></span>
             </td>
             <td>
                 <span style="float:right;font-size: 9pt;">Kasir : <?php echo $_SESSION['user_id']; ?></span>
             </td>
         </tr>
     </table>     
     <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
         <tr>
            <?php
                echo '<tr><td>Keperluan</td> <td>:</td> <td>'.$item.'</td>';
                echo '<tr><td>Keterangan</td> <td>:</td> <td>'.$keterangan.'</td>';
            ?>
         </tr>
    </table>     
<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($uang,0,',','.');?>
                                </td>
                            </tr>			
</table>
</div>
<div style="width:100%;border-top: 1px dotted #000;font-size: 8pt;font-family: Tahoma;padding: 5px 0px;border-top: 1px dashed #000;margin-top:1px;text-align: center;">
<br /><br />
<br />
<br /><br />
( <?php echo strtoupper($penerima); ?> )
</div>
</div>
</div>        
</div>
</body>
<?php		
}
else{
?>
<script type="application/javascript">
 alert("Gagal query!!");
 history.back();
</script>
<?php	
}
?>