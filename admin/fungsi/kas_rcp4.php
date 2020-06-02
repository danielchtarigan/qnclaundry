    <?php 
    
    date_default_timezone_set('Asia/Makassar');
    $date = date('Y-m-d');
    

    function cash_order($nama,$tgl){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM cara_bayar WHERE resepsionis='$nama' AND tanggal_input like '%$tgl%' and (cara_bayar='Cash' or cara_bayar='cash')");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function cash_langganan($nama,$tgl){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE cara_bayar='cash' AND tgl_transaksi LIKE '%$tgl%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND rcp='$nama'");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function pengeluaran($nama,$tgl){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(pengeluaran),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tgl%' AND reception='$nama'");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function setoran_bersih($nama,$tgl){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(setoran_bersih),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tgl%' AND reception='$nama'");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function setoran_bank_sebenarnya($nama,$tgl){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$nama'");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function saldo_awal($nama,$tgl){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM saldo_awal WHERE nama='$nama' AND tgl_input LIKE '%$tgl%'");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function all_cash_orders($nama,$tanggal_mulai,$tanggal_akhir){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM cara_bayar WHERE resepsionis='$nama' AND (DATE_FORMAT(tanggal_input, '%Y-%m-%d') BETWEEN '$tanggal_mulai' AND '$tanggal_akhir') AND (cara_bayar='Cash' or cara_bayar='cash')");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function all_cash_langganans($nama,$tanggal_mulai,$tanggal_akhir){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE cara_bayar='cash' AND (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$tanggal_mulai' AND '$tanggal_akhir') AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND rcp='$nama'");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function all_pengeluaran($nama,$tanggal_mulai,$tanggal_akhir){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(pengeluaran),0) AS total FROM tutup_kasir WHERE (DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$tanggal_mulai' AND '$tanggal_akhir') AND reception='$nama'");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function all_setoran_sebenarnya($nama,$tanggal_mulai,$tanggal_akhir){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE (DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$tanggal_mulai' AND '$tanggal_akhir') AND nama='$nama'");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function cash_orders($nama,$tanggal_mulai,$endDate){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM cara_bayar WHERE resepsionis='$nama' AND (DATE_FORMAT(tanggal_input, '%Y-%m-%d') BETWEEN '$tanggal_mulai' AND '$endDate') AND (cara_bayar='Cash' or cara_bayar='cash')");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function cash_langganans($nama,$tanggal_mulai,$endDate){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE cara_bayar='cash' AND (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$tanggal_mulai' AND '$endDate') AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND rcp='$nama'");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function pengeluarans($nama,$tanggal_mulai,$endDate){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(pengeluaran),0) AS total FROM tutup_kasir WHERE (DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$tanggal_mulai' AND '$endDate') AND reception='$nama'");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function setoran_sebenarnyas($nama,$tanggal_mulai,$endDate){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE (DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$tanggal_mulai' AND '$endDate') AND nama='$nama'");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function non_cash_orders($nama,$tanggal_mulai,$endDate){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM cara_bayar WHERE resepsionis='$nama' AND (DATE_FORMAT(tanggal_input, '%Y-%m-%d') BETWEEN '$tanggal_mulai' AND '$endDate') AND (cara_bayar<>'Cash' or cara_bayar<>'cash' or cara_bayar<>'Kuota')");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function non_cash_langganans($nama,$tanggal_mulai,$endDate){
    	global $con;
    	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE cara_bayar<>'cash' AND (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$tanggal_mulai' AND '$endDate') AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND rcp='$nama'");
    	$data = mysqli_fetch_row($sql);
    	return $data[0];
    }
    
    function lap_sisa_saldo($nama,$tanggal_mulai,$endDate){
    	$data['sisa_saldo'] = cash_orders($nama,$tanggal_mulai,$endDate)+cash_langganans($nama,$tanggal_mulai,$endDate)-pengeluarans($nama,$tanggal_mulai,$endDate)-setoran_sebenarnyas($nama,$tanggal_mulai,$endDate);
    	$data['non_cash'] = non_cash_orders($nama,$tanggal_mulai,$endDate)+non_cash_langganans($nama,$tanggal_mulai,$endDate);
    	
    	return $data;
    }
    
    function laporan_saldo($nama,$tgl,$tanggal_mulai,$tanggal_akhir){
    	$data['debet'] = cash_order($nama,$tgl)+cash_langganan($nama,$tgl)-pengeluaran($nama,$tgl);
    	$data['kredit'] = setoran_bank_sebenarnya($nama,$tgl);
    	$data['saldo_awal'] = saldo_awal($nama,$tgl);
    	$data['saldo'] = all_cash_orders($nama,$tanggal_mulai,$tanggal_akhir)+all_cash_langganans($nama,$tanggal_mulai,$tanggal_akhir)-all_pengeluaran($nama,$tanggal_mulai,$tanggal_akhir)-all_setoran_sebenarnya($nama,$tanggal_mulai,$tanggal_akhir);
    
    	return $data;
    }