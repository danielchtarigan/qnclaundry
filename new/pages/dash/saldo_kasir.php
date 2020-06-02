<?php 
include '../function/saldo_kasir.php';

$reception = $_SESSION['user_id'];
$tanggal_mulai = '2018-09-01';
$startDate = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
$endDate = date('Y-m').'-25';
$tanggal_akhir = date('Y-m-d', strtotime('- 1 days', strtotime($startDate)));

$data = lap_sisa_saldo($reception,$tanggal_mulai,$endDate);



?>

<div class="col-lg-6">
    <div class="alert alert-block alert-warning">
        <a href="" data-toggle="modal" data-target="#rincian_kas"><font style="font-size: 12pt; color: green"><strong><u>Saldo Kas Anda Sekarang adalah <?php echo rupiah($data['sisa_saldo']) ?></u></strong></font></a>
    </div>
</div>

<div class="col-lg-6">
    <div class="alert alert-block alert-warning">
        <a href="" data-toggle="modal" data-target="#rincian_hutang"><font style="font-size: 12pt; color: red"><strong><u>Hutang Customer Anda adalah <?php echo rupiah($data['hutang']) ?></u></strong></font></a>
    </div>
</div>

    

<div class="modal fade" id="rincian_kas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" align="center"><u>Daftar Setoran Anda Periode <?php echo date('d M Y', strtotime($startDate)).' - '.date('d M Y', strtotime($endDate)); ?> </u></h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
        	<table class="tablex" style="font-size: 8pt;">
        		<thead class="kepala">
        			<tr class="trx">
        				<th class="thx">No</th>
        				<th class="thx">Tanggal</th>
        				<th class="thx">Pemasukan Kas</th>
        				<th class="thx">Setoran Bank</th>
        				<th class="thx">Saldo</th>
        				<th class="thx">Bank Setor</th>
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
    				<td class="tdx" style="text-align: center">
    					<?php 
                        $ket = mysqli_query($con, "SELECT nama_bank,ket,jumlah FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$reception' ");
                        while($dataket = mysqli_fetch_row($ket)){               
                            if($dataket[1]!='') echo rupiah($dataket[2]).' Setor di : '.$dataket[0].' ('.$dataket[1].')<br>'; else echo rupiah($dataket[2]).' Setor di : '.$dataket[0].'<br>';
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
  </div>
</div>


<div class="modal fade" id="rincian_hutang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" align="center"><u>Daftar hutang customer yang Anda terima cuciannya </u></h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="tablex" style="font-size: 8pt;">
                <thead class="kepala">
                    <tr class="trx">
                        <th class="thx">No</th>
                        <th class="thx">Tanggal</th>
                        <th class="thx">Nama Customer</th>
                        <th class="thx">Nomor Telepon</th>
                        <th class="thx">Nomor Order</th>
                        <th class="thx">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="tubuh">
                    <?php
                    $no = 1;
                    $total = 0;
                    $qhutang = mysqli_query($con, "SELECT * FROM reception a, customer b WHERE a.id_customer=b.id AND a.lunas=false AND a.nama_reception='$reception' AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') >= '$tanggal_mulai' ");
                    while($dataHutang = mysqli_fetch_array($qhutang)){
                        $tgl = $dataHutang['tgl_input'];
                        $total += $dataHutang['total_bayar'];
                    ?>
                    <tr class="trx">
                        <td class="tdx" class="hidden"><?php echo $no; ?></td>
                        <td class="tdx" style="text-align: center"><?php echo date('d/m/Y', strtotime($tgl)) ?></td>
                        <td class="tdx" style="text-align: center"><?php echo $dataHutang['nama_customer'] ?></td>
                        <td class="tdx" style="text-align: center"><?php echo $dataHutang['no_telp'] ?></td>
                        <td class="tdx" style="text-align: center"><?php echo $dataHutang['no_nota'] ?></td>
                        
                        <td class="tdx" style="text-align: center"><?php echo rupiah($dataHutang['total_bayar']) ?></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
                <tfoot>
                    <tr class="trx">
                        <td class="tdx" colspan="5" style="text-align: right">Total</td>
                        <td class="tdx"><?= rupiah($total) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
	.tablex {
		margin: 0 auto;
  		width: auto;
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

