<?php
include '../config.php';

$nofaktur = "FTDL030611";

$sql_rcp = mysqli_query($con, "SELECT * FROM reception WHERE no_faktur='$nofaktur' ORDER BY tgl_input ASC LIMIT 1");
	while($rcps = mysqli_fetch_assoc($sql_rcp)){
	    $tgl_order = date('Y-m-d', strtotime($rcps['tgl_input']));
	    $rcp_order = $rcps['nama_reception'];
	    $tambahan_bayar = mysqli_query($con, "UPDATE cara_bayar SET tgl_order='$tgl_order',rcp_order='$rcp_order' WHERE no_faktur='$nofaktur'");
	}
	

?>