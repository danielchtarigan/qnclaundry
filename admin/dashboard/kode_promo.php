<ul class="list-group">
	<?php 
	$startDate = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));
	$endDate = date('Y-m-d', strtotime('-1 days', strtotime(date('Y-m-d'))));
	$sql = $con->query("SELECT DISTINCT voucher, COUNT(id_customer) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND diskon<>'0' AND voucher NOT LIKE 'CASHB%' AND voucher NOT LIKE 'RCV%' GROUP BY voucher ORDER BY COUNT(voucher) DESC LIMIT 20 ");
	while($data = $sql->fetch_array()){
		$userVoucher = mysqli_query($con, "SELECT DISTINCT id_customer FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND voucher='$data[0]' AND diskon<>'0' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
		echo '
			<button class="list-group-item">
		    	<span class="badge" style="background-color: #8d8d8d" title="Penggunaa">'.mysqli_num_rows($userVoucher).'</span>
		    	<span class="badge" style="background-color: #96a597" title="Penggunaan">'.$data[1].'</span>
		    	'.str_replace("VOUCHER", "", strtoupper($data[0])) .'
		  	</button>
		';
	}


	$recovery = $con->query("SELECT DISTINCT a.voucher FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND a.voucher LIKE 'RCV%' ");
	$cashback = $con->query("SELECT DISTINCT a.voucher FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND a.voucher LIKE 'CASHB%' ");
	$cashbackUser = $con->query("SELECT DISTINCT a.id_customer FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND a.voucher LIKE 'CASHB%' ");

	echo '
		<button class="list-group-item list-group-item-info">
	    	<span class="badge" style="background-color: #8d8d8d" title="Penggunaa">'.mysqli_num_rows($recovery).'</span>
	    	<span class="badge" style="background-color: #96a597" title="Penggunaan">'.mysqli_num_rows($recovery).'</span>
	    	Recovery
	  	</button>
	  	<button class="list-group-item list-group-item-info">
	    	<span class="badge" style="background-color: #8d8d8d" title="Penggunaa">'.mysqli_num_rows($cashbackUser).'</span>
	    	<span class="badge" style="background-color: #96a597" title="Penggunaan">'.mysqli_num_rows($cashback).'</span>
	    	Cashback
	  	</button>
	';


	?>
</ul>

<p style="font-size:9px; font-style: oblique; font-weight: bold">Sumber: <?= date('d/m/Y', strtotime($startDate)).' - '.date('d/m/Y', strtotime($endDate)) ?></p>