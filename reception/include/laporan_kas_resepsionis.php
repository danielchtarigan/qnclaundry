<?php 
include '../admin/fungsi/kas_rcp.php';

$reception = $_SESSION['user_id'];
$tanggal_mulai = '2017-01-01';
$startDate = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
$endDate = date('Y-m').'-25';
$tanggal_akhir = date('Y-m-d', strtotime('- 1 days', strtotime($startDate)));

$data = lap_sisa_saldo($reception,$tanggal_mulai,$endDate);

?>

<div align="center">
	<a href="" data-toggle="modal" data-target="#rincian_kas"><font style="font-size: 12pt; color: black"><strong><u>Dompet Saldo Kas Anda Sekarang adalah <?php echo rupiah($data['sisa_saldo']) ?></u></strong></font></a>
</div>

<div class="modal fade" id="rincian_kas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" align="center"><u>Daftar Setoran Anda Periode <?php echo date('d M Y', strtotime($startDate)).' - '.date('d M Y', strtotime($endDate)); ?> </u></h4>
      </div>
      <div class="modal-body">
        <div>
        	<table class="tablex" style="font-size: 8pt; width: 100%">
        		<thead class="kepala">
        			<tr class="trx">
        				<th class="thx">No</th>
        				<th class="thx">Tanggal</th>
        				<th class="thx">Pemasukan Kas</th>
        				<th class="thx">Setoran Bank</th>
        				<th class="thx">Saldo</th>
        				<th class="thx">Deskripsi</th>
        			</tr>
        		</thead>
        		<tbody class="tubuh">
        			<?php
        			$no = 1;
    			$query = mysqli_query($con, "SELECT DISTINCT DATE_FORMAT(tgl_input, '%Y-%m-%d') AS tgl , nama_reception AS rcp FROM reception WHERE nama_reception='$reception' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' UNION SELECT tanggal AS tgl, nama AS rcp FROM setoran_bank_sebenarnya WHERE nama='$reception' AND tanggal BETWEEN '$startDate' AND '$endDate' UNION SELECT DATE_FORMAT(tanggal, '%Y-%m-%d') AS tgl, nama_reception AS rcp FROM setoran_delivery WHERE nama_reception='$reception' AND DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ORDER BY tgl ASC ");
    			while($row = mysqli_fetch_row($query)){
    			$nama = $row[1];
    			$tgl = $row[0];
    			$nos = $no++;
    			$data = laporan_saldo($nama,$tgl,$tanggal_mulai,$tanggal_akhir);
    			?>
    			<tr class="trx">
    				<td class="tdx" class="hidden"><?php echo $nos; ?></td>
    				<td class="tdx" style="text-align: center"><?php echo date('d/m/Y', strtotime($tgl)) ?></td>
    				<td class="tdx" style="text-align: center"><?php echo rupiah($data['debet']) ?></td>
    				<td class="tdx" style="text-align: center"><?php if($data['kredit']!='0') echo rupiah($data['kredit']); else echo '-'; ?></td>
    				<?php 
    				$debet = $data['debet'];
    				$kredit = $data['kredit'];
    				if($nos==1){
    					$saldo = $debet-$kredit+$data['saldo'];
    				}else{
    					$saldo = $saldo+$debet-$kredit;
    				}
    				?>
    				<td class="tdx" style="text-align: center"><?php echo rupiah($saldo) ?></td>
    				<td class="tdx" style="text-align: left">
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
        		</tbody>
        	</table>
        </div>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
	.tablex {
		margin: 0 auto;
  		width: 860px;
  		border-collapse: collapse;
  		box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
	}
	.tubuh {
	  	color: black;
	}
	.thx, .tdx {
		text-align: center;
	  	padding: 5px 10px;
	  	border: 2px solid #EEF7FB;
	}
	.trx {
	  	font: normal 12px Tahoma, Geneva, sans-serif;
	  	background: #94e588;
	}
	/*.tdx {
	  -webkit-transition: all 0.7s ease-in-out 0s;
	  -moz-transition: all 0.7s ease-in-out 0s;
	  -o-transition: all 0.7s ease-in-out 0s;
	  transition: all 0.7s ease-in-out 0s;
	}*/
	.trx:nth-child(2n+0) {
	  	background: #c5ecbf;
	}
	.tdx:hover, .tdx:nth-child(2n+0):hover {
	  	background: #EEF7FB;
	}
	.thx {
	  	background: #6d816a;
	  	color: #DAEEF6;
	  	text-shadow: 1px 1px 0 #1F627F;
	  	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25), 0 0 100px rgba(0, 0, 0, 0.15) inset;
	  	font: bold 12px Arial, Helvetica, sans-serif;
	}

/*	@media screen and (min-width: 768px){
		.tablex {
			width: 100%;
			float: none;
			margin-left: 5px;
			margin-right: 5px;
		}
	}

	@media screen and (min-width: 700px){
		.tablex {
			width: 100%;
			float: none;
			margin-left: 5px;
			margin-right: 5px;
		}
	}*/
</style>

