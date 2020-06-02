<?php 
include '../../config.php';
include '../zonawaktu.php';
$rcpInput = $_SESSION['user_id'];

if($_GET['batal']=='undefined'){
    echo "Pilih dulu Void atau Reject";
} else{
    $cekerror = mysqli_query($con, "SELECT * FROM order_batal WHERE no_order='$_GET[order]'");
    if(mysqli_num_rows($cekerror)>0){ ?>
    	<script type="text/javascript">
    		alert("<?php echo $_GET['order']. ' Sudah pernah dikirim'; ?>");
    		location.href="index.php?form=pembatalan";
    	</script>
    <?php
    } else{
    	$query = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$_GET[order]'");
    	$row = mysqli_fetch_assoc($query);
    
    	if($_GET['batal']=="void"){
    		$updateorder = mysqli_query($con, "UPDATE reception SET cara_bayar='Void',spk='1' WHERE no_nota='$_GET[order]'");
    	}
    	else if($_GET['batal']=="reject"){
    		$updateorder = mysqli_query($con, "UPDATE reception SET cara_bayar='Reject' WHERE no_nota='$_GET[order]'");
    	}
    
    	$nilaifaktur = mysqli_query($con, "SELECT SUM(total_bayar) AS total FROM reception WHERE no_faktur='$row[no_faktur]' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' ");
    	$total = mysqli_fetch_row($nilaifaktur)[0];
    	$total2 = $total/2;
    	$total3 = $total/3;
    
    	$updatebayar1 = mysqli_query($con, "UPDATE faktur_penjualan SET total='$total' WHERE no_faktur='$row[no_faktur]'");
    
    	$cekfaktur = mysqli_query($con, "SELECT * FROM cara_bayar WHERE no_faktur='$row[no_faktur]'");
    
    
    
    	if(mysqli_num_rows($cekfaktur)==1){
    		$updatebayar2 = mysqli_query($con, "UPDATE cara_bayar SET jumlah='$total' WHERE no_faktur='$row[no_faktur]'");
    	} else if(mysqli_num_rows($cekfaktur)==2){
    		$updatebayar2 = mysqli_query($con, "UPDATE cara_bayar SET jumlah='$total2' WHERE no_faktur='$row[no_faktur]'");
    	}  else if(mysqli_num_rows($cekfaktur)==3){
    		$updatebayar2 = mysqli_query($con, "UPDATE cara_bayar SET jumlah='$total3' WHERE no_faktur='$row[no_faktur]'");
    	}
    
    	mysqli_query($con, "INSERT INTO order_batal (tanggal,rcp_input,tgl_order,rcp_order,no_order,harga,no_faktur,alasan,status) VALUES ('$nowDate','$rcpInput','$row[tgl_input]','$row[nama_reception]','$_GET[order]','$row[total_bayar]','$row[no_faktur]','$_GET[als]','$_GET[batal]')");
    
    
    	?>
    
    	<script type="text/javascript">
    		alert("<?php echo $_GET['order']. ' adalah '.strtoupper($_GET['batal']); ?>");
    		location.href="index.php?form=pembatalan";
    	</script>
    <?php
    }
    
}
?>

    
	
