<?php 
include '../../config.php';
include '../zonawaktu.php';
include '../kode.php';

if($_GET['level']=="undefined" or $_GET['pembayaran']=="undefined" or $_GET['carabayar']==""){
	echo "Error";
} else {
	if($_GET['level']=="red"){
		$harga = "100000";
		$level = "RED";
		$dateEnd = date('Y-m-d', strtotime('+12 months', strtotime($nowDate)));
	} else {
	    if($_GET['cabang']=="Mojokerto"){
	        if($_GET['harga']=="3") {
    			$harga = "100000";
    			$level = "Blue 3 Bulan";
    			$dateEnd = date('Y-m-d', strtotime('+3 months', strtotime($nowDate)));
    		} else if($_GET['harga']=="6"){
    			$harga = "150000";
    			$level = "Blue 6 Bulan";
    			$dateEnd = date('Y-m-d', strtotime('+6 months', strtotime($nowDate)));
    		} else if($_GET['harga']=="12"){
    			$harga = "200000";
    			$level = "Blue 12 Bulan";
    			$dateEnd = date('Y-m-d', strtotime('+12 months', strtotime($nowDate)));
    		}
	    }
	    else {
	        if($_GET['harga']=="3") {
    			$harga = "100000";
    			$level = "Blue 3 Bulan";
    			$dateEnd = date('Y-m-d', strtotime('+3 months', strtotime($nowDate)));
    		} else if($_GET['harga']=="6"){
    			$harga = "150000";
    			$level = "Blue 6 Bulan";
    			$dateEnd = date('Y-m-d', strtotime('+6 months', strtotime($nowDate)));
    		} else if($_GET['harga']=="12"){
    			$harga = "250000";
    			$level = "Blue 12 Bulan";
    			$dateEnd = date('Y-m-d', strtotime('+12 months', strtotime($nowDate)));
    		}
	    }
    		

	}

		
	if($_GET['pembayaran']=="Cash"){
		$carabayar = "Cash";
	} else {
		$carabayar = $_GET['carabayar'];
	}



	$query = mysqli_query($con, "SELECT no_faktur_urut FROM faktur_penjualan WHERE nama_outlet='$_SESSION[outlet]' ORDER BY id DESC LIMIT 0,1");
		$result = mysqli_fetch_row($query);

	$lastfaktur = (int)substr($result[0], 4)+1;
	$no_faktur = $kode_faktur.sprintf('%06s', $lastfaktur);

	$custData = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM customer WHERE id='$_GET[id]'"));

	$upd = mysqli_query($con, "INSERT INTO faktur_penjualan (no_faktur,no_faktur_urut,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi) VALUES ('$no_faktur','$no_faktur','$_SESSION[outlet]','$_SESSION[user_id]','$nowDate','$harga','$carabayar','$_GET[id]','membership')");
	$upd .=	$con-> query("INSERT INTO membership (customer_id,no_telp,level,join_date,expire_date,user_allow,status) VALUES ('$_GET[id]','$custData[no_telp]','$level','$nowDate','$dateEnd','$_SESSION[user_id]','1')");

	// $membership = mysqli_query($con, "SELECT * FROM customer WHERE member='1'");

	mysqli_query($con, "UPDATE customer SET member='1',jenis_member='$level',tgl_join='$nowDate',tgl_akhir='$dateEnd' WHERE id='$_GET[id]'");

	?>
	<script type="text/javascript">
		window.location="";
	</script>

	<?php
}

	



?>