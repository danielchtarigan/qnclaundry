<?php
include '../../config.php';
session_start();

date_default_timezone_set('Asia/Makassar');
$tanggal = date("Y-m-d H:i:s");
if(isset($_GET['kirim'])){
    $rcp = $_SESSION['user_id'];
    $nota = $_GET['nota'];
    $hrg = $_GET['harga'];
    $fktr = $_GET['faktur'];
    $tot = $_GET['total'];
    $als = $_GET['alasan'];

    $ceknota = mysqli_query($con, "SELECT * FROM nota_void WHERE no_nota='$nota'");
        if(mysqli_num_rows($ceknota)<1){
            if($hrg=='Nomor Nota Salah..!') {
               ?>    
                <script type="text/javascript">
                alert("Nomor Nota Tidak Benar Mba!!");
                location.href="../index.php?menu=void";
                </script>
                	
                <?php
            } else {
                $qrcp = mysqli_query($con, "UPDATE reception set spk=1,cara_bayar='Void' where no_nota='$nota'");	
                $qvoid = mysqli_query($con, "INSERT into nota_void values ('','$tanggal','$rcp','$nota','$hrg','$fktr','$tot','$als','','')"); 
                
                
                if($qvoid){
                
                	$cekfaktur = mysqli_query($con, "SELECT no_faktur,total_bayar FROM reception WHERE no_nota='$nota'");
                	$data = mysqli_fetch_row($cekfaktur);
                
                
                	$jumlah_skrg = $tot-$data[1];
                
                	mysqli_query($con, "UPDATE cara_bayar SET jumlah='$jumlah_skrg' WHERE no_faktur='$data[0]'");
                	mysqli_query($con, "UPDATE faktur_penjualan SET total='$jumlah_skrg' WHERE no_faktur='$data[0]'");
                
                
                	?>
                	<script type="text/javascript">
                	alert("Berhasil dan Silahkan lanjutkan SPK Anda!");
                	location.href="../index.php";
                	</script>	
                    <?php	
                	}		
                	else{
                	?>    
                	<script type="text/javascript">
                	alert("Ulangi");
                	location.href="../index.php?menu=void";
                	</script>
                	
                    <?php
                	}
                
            }
        } else {
            ?>    
                <script type="text/javascript">
                alert("Nomor Nota Sudah divoid Mba!!");
                location.href="../index.php?menu=void";
                </script>
                	
                <?php
        }
}
?>