    <?php 
    include '../config.php';
    date_default_timezone_set('Asia/Makassar');
    $date = date('Y-m-d');
    include 'fungsi/kas_rcp.php'; 
    function rupiah($angka){
        $jadi = "Rp.".number_format($angka,0,',','.');
        return $jadi;
    }

       	$nama = $_GET['pilih_nama'];
    	$startDate = $_GET['start'];
    	$endDate = $_GET['end'];
    	$tanggal_mulai = '2017-01-01';
    	$tanggal_akhir = date('Y-m-d', strtotime('- 1 days', strtotime($startDate)));	
    
    ?>	
    
    <script type="text/javascript" src="../accounting/js/jquery.PrintArea.js"></script>
    
    <div class="">
		<button id="cetak" class="btn pull-center btn-default">Print</button>
	</div>
	
	<div class="data-cetak">
	    <div align="center">
	        <?php
        	$data = lap_sisa_saldo($nama,$tanggal_mulai,$endDate);
            	$kas = $data['sisa_saldo'];
            		echo '<div class="col-md-6 col-md-offset-3">';
            		echo '<table class="tablex" style="background-color: #91948c; color: #DAEEF6; font : bold 12pt Arial, Calibri, sans-serif;">';
            		echo '<tr><td style="text-align: right">Nama</td><td> &nbsp;:&nbsp; </td><td>'.strtoupper($nama).'</td></tr>';
            		echo '<tr><td style="text-align: right">Saldo Kas</td><td> &nbsp;:&nbsp; </td><td>Rp '.number_format($kas,0,',','.').'</td></tr>';
            		echo '</table>';
            		echo '</div>';
        	?>
        	
        	<div class="col-md-10 col-md-offset-1" style="overflow-x: auto">
                <marquee direction="right" align="center" behavior="alternate" width="50%" scrollamount="3" onmouseover ="this.stop()" onmouseout="this.start()" class="list-group-item" style="background-color: #91948c; color: #DAEEF6; font : bold 12pt Arial, Calibri, sans-serif;">Rincian Kas</marquee>
    	    
        	    
    	        <table class="table table-bordered table-striped" style="font-size: 9pt">
            		<thead>
            			<tr class="trx">
            				<th class="thx">Tanggal</th>
            				<th class="thx">Debet</th>
            				<th class="thx">Kredit</th>
            				<th class="thx">Saldo</th>
            				<th class="thx">Deskripsi</th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php
            			$no = 1;
            			$query = mysqli_query($con, "SELECT DISTINCT DATE_FORMAT(tgl_input, '%Y-%m-%d') AS tgl , nama_reception AS rcp FROM reception WHERE nama_reception='$nama' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' UNION SELECT tanggal AS tgl, nama AS rcp FROM setoran_bank_sebenarnya WHERE nama='$nama' AND tanggal BETWEEN '$startDate' AND '$endDate' UNION SELECT DATE_FORMAT(tanggal, '%Y-%m-%d') AS tgl, nama_reception AS rcp FROM setoran_delivery WHERE nama_reception='$nama' AND DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ORDER BY tgl ASC ");
            			while($row = mysqli_fetch_row($query)){
            			$nama = $row[1];
            			$tgl = $row[0];
            			$nos = $no++;
            			$data = laporan_saldo($nama,$tgl,$tanggal_mulai,$tanggal_akhir);
            			?>
            			<tr class="trx">
            				<td class="hidden"><?php echo $nos; ?></td>
            				<td style="text-align: right" class="tdx"><?php echo date('d/m/Y', strtotime($tgl)) ?></td>
            				<td style="text-align: right" class="tdx"><?php echo rupiah($data['debet']) ?></td>
            				<td style="text-align: right" class="tdx"><?php echo rupiah($data['kredit']) ?></td>
            				<?php 
            				$debet = $data['debet'];
            				$kredit = $data['kredit'];
            				if($nos==1){
            					$saldo = $debet-$kredit+$data['saldo'];
            				}else{
            					$saldo = $saldo+$debet-$kredit;
            				}
            				?>
            				<td style="text-align: right" class="tdx"><?php echo rupiah($saldo) ?></td>
            				<td class="tdx" width="36%">
            					<?php 
            					$ket = mysqli_query($con, "SELECT nama_bank,ket,jumlah FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$nama' ");
            					while($dataket = mysqli_fetch_row($ket)){ 
            					    $ketStat = ($dataket[2]<0) ? "Masuk " : "Keluar ";
            					    $nominal = ($dataket[2]<0) ? $dataket[2]*-1 : $dataket[2] ;
                                    if($dataket[1]!='') echo '
                                    <li>'.$ketStat.rupiah($nominal).' ke '.$dataket[0].' ('.$dataket[1].')</li>';
                                    else echo '
                                    <li>'.$ketStat.rupiah($nominal).' ke '.$dataket[0].'</li>';
                                }
            					?>
            				</td>
            			</tr>
            			<?php } ?>
            		</tbody>
            
            	</table>
            </div>
	    </div>
    
        
    </div>
    
    <style type="text/css">
        .tablex {
            border : 5 px solid;
            border-radius: 10px;
            width : 260px;
            height : 60px;
            padding: 25px;
        }
    	.trx {
    	  	font: normal 12px Arial, Calibri, sans-serif;
    	  	background: #ececec;
    	}
    
    	.thx, .tdx{
    		padding: 5px 10px;
    	  	border: 2px solid #EEF7FB;
    	}
    
    	.txr:nth-child(2n+0) {
    	  	background: #d8d8d8;
    	}
    	.tdx:hover, td:nth-child(2n+0):hover {
    	  	background: #f3f4f4;
    	}
    	
    </style>
    
    <script>
        (function($) {
        	$(document).ready(function(e) {
            	$("#cetak").bind("click", function(event) {
            		$('.data-cetak').printArea();
                });
            });
        }) (jQuery);
    </script>