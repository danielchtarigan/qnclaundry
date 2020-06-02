    <?php 
    include '../config.php';
    date_default_timezone_set('Asia/Makassar');
    $date = date('Y-m-d');
    include 'fungsi/kas_rcp2.php'; 
    function rupiah($angka){
        $jadi = number_format($angka,0,',','.');
        return $jadi;
    }

       	$nama = $_GET['pilih_nama'];
    	$startDate = $_GET['start'];
    	$endDate = $_GET['end'];
    	$tanggal_mulai = '2017-01-01';
    	$tanggal_akhir = date('Y-m-d', strtotime('- 1 days', strtotime($startDate)));
    	$data = lap_sisa_saldo($nama,$tanggal_mulai,$endDate);
    	$kas = $data['sisa_saldo'];
    		echo '<div class="col-md-6 col-md-offset-3">';
    		echo '<table class="table	table-condensed" style="border-style: outset">';
    		echo '<tr><td>Nama</td><td>:</td><td>'.$nama.'</td></tr>';
    		echo '<tr><td>Saldo Kas</td><td>:</td><td>Rp '.number_format($kas,0,',','.').'</td></tr>';
    		echo '</table>';
    		echo '</div>';
    		
    
    ?>
    <div class="col-md-6 col-md-offset-3">
    	<legend>Rincian Kas</legend>
    </div>	
    <div class="col-md-12" style="overflow-x: auto">
    	<table class="table table-bordered table-striped" style="font-size: 9pt">
    		<thead>
    			<tr>
    				<th>Tanggal</th>
    				<th>Debet</th>
    				<th>Kredit</th>
    				<th>Saldo</th>
    				<th>Deskripsi</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php
    			$no = 1;
    			$query = mysqli_query($con, "SELECT DISTINCT DATE_FORMAT(tgl_input, '%Y-%m-%d') AS tgl , nama_reception AS rcp FROM reception WHERE nama_reception='$nama' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' UNION SELECT tanggal AS tgl, nama AS rcp FROM setoran_bank_sebenarnya WHERE nama='$nama' AND tanggal BETWEEN '$startDate' AND '$endDate' ORDER BY tgl ASC ");
    			while($row = mysqli_fetch_row($query)){
    			$nama = $row[1];
    			$tgl = $row[0];
    			$nos = $no++;
    			$data = laporan_saldo($nama,$tgl,$tanggal_mulai,$tanggal_akhir);
    			?>
    			<tr>
    				<td class="hidden"><?php echo $nos; ?></td>
    				<td><?php echo date('d/m/Y', strtotime($tgl)) ?></td>
    				<td><?php echo rupiah($data['debet']) ?></td>
    				<td><?php echo rupiah($data['kredit']) ?></td>
    				<?php 
    				$debet = $data['debet'];
    				$kredit = $data['kredit'];
    				if($nos==1){
    					$saldo = $debet-$kredit+$data['saldo'];
    				}else{
    					$saldo = $saldo+$debet-$kredit;
    				}
    				?>
    				<td><?php echo rupiah($saldo) ?></td>
    				<td>
    					<?php 
    					$ket = mysqli_query($con, "SELECT ket FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$nama' ");
    					while($dataket = mysqli_fetch_row($ket)){                            
                            echo $dataket[0];
                        }
    					?>
    				</td>
    			</tr>
    			<?php } ?>
    		</tbody>
    
    	</table>
    </div>
    
    <style type="text/css">
    	th{
    		text-align: center;
    	}
    </style>