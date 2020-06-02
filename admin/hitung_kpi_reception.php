<?php 
include '../config.php';
include 'header.php';

date_default_timezone_set('Asia/Makassar');
if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];

	$pastStartDate = date('Y-m-d', strtotime('-3 months', strtotime($startDate)));
	$pastEndDate = date('Y-m-d', strtotime('-1 months', strtotime($endDate)));
} else{
	$startDate = date('Y').'-'.date('m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
	$endDate   = date('Y').'-'.date('m').'-25';
}

	

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}

?>

<script type="text/javascript">
		$(document).ready(function(){
			$('#tampilok').dataTable({
			"order": [[ 1,"asc" ]],
				dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [ 'copy',
                        {
                            'sExtends': 'xls',
                            'sFileName': 'KPI Resepsionis.xls',
                            'sButtonText': 'Simpan Ke Excel'
                            
                        }

                    ]
                },
	                "columnDefs": [
	                    {
	                        "targets": [0],
	                        "visible": true,
	                        "searchable": true,"width":"4px",
	                    },
	                ],
	                "bAutoWidth": false,
					"bJQueryUI" : true,
					"sPaginationType" : "full_numbers",
					"iDisplayLength": 25,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				});

		});
</script>

<style type="text/css">
	th{
		text-align: center;
	}
</style>

	<h3 align="center">KPI DAN GAJI RESEPSIONIS</h3>
	<div class="col-md-5 col-md-offset-4">
		<form class="form-inline" method="POST">
		<div class="col-md-4 col-xs-6 col-md-offset-0"><input class="form-control" type="date" name="start" value="<?php echo $startDate ?>"></div>
		<div class="col-md-4 col-xs-6 col-md-offset-0"><input class="form-control" type="date" name="end" value="<?php echo $endDate ?>"></div>
		<div class="col-md-4 col-xs-6 col-md-offset-0"><input class="btn btn-default btn-md btn-active" type="submit" name="submit" value="Range"></div>
		</form>
		</div><br><br><br>
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover" id="tampilok" style="font-size:8px">
			<thead>
				<tr>
					<th rowspan="2">No</th>
					<th rowspan="2">Nama Reception</th>		
					<th rowspan="2">Hari Kerja</th>
					<th rowspan="2">Gaji Pokok</th>		
					<th colspan="2">Lembur</th>
					<th colspan="3">Bonus</th>
					<th rowspan="2">Komisi 10% Langganan Baru</th>
					<th rowspan="2">Kenaikan Omset 2 Juta</th>
					<th rowspan="2">Kasus Reject</th>
					<th colspan="3">Denda</th>
					<th colspan="3">Absen atau Izin Sebelum Kerja</th>
					<th rowspan="2">Akumulasi Terlambat Masuk</th>			
					<th rowspan="2">Gaji Bersih</th>
				</tr>
				<tr>
					<th>Reguler (L)</th>
					<th>12 Jam (L)</th>
					<th>4% SPK</th>
					<th>Membership</th>
					<th>Quality Audit</th>			
					<th>Tidak Menyetor Senin, Rabu, Jumat</th>
					<th>Tidak Tutup Kasir</th>
					<th>Tidak Stok Opname</th>
					<th>Tanpa Keterangan</th>
					<th>Izin < 2 Jam</th>
					<th>Izin > 2 Jam</th>			
				</tr>		
			</thead>
			<tbody>
				<?php
				$no = 1;
				$qnamarcp = mysqli_query($con, "SELECT DISTINCT nama_reception FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND nama_outlet<>'mojokerto' ORDER BY nama_reception ASC ");
				while($namarcp = mysqli_fetch_array($qnamarcp)){
					$rcp = $namarcp['nama_reception'];

					$gajipokok = 0;
					$lembur = 0;
					$duabelas = 0;
					$komisilgn = 0;
					$komisiomset = 0;
					$tidaksetor = 0;
					$absen = 0;
					$izin1 = 0;
					$izin2 = 0;
					$terlambat = 0;


					$kehadiran = mysqli_query($con, "SELECT COUNT(DISTINCT DATE_FORMAT(tgl_log, '%Y-%m-%d')) AS hari FROM log_rcp WHERE id_user='$rcp' AND DATE_FORMAT(tgl_log, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
					$datahadir = mysqli_fetch_row($kehadiran);
					$hadir = $datahadir[0];

					$tutupkasir = mysqli_query($con, "SELECT COUNT(DISTINCT DATE_FORMAT(tanggal, '%Y-%m-%d')) as tutup_kasir FROM tutup_kasir WHERE reception='$rcp' AND DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
					$datatutupkasir = mysqli_fetch_row($tutupkasir);
					$kasir = $datatutupkasir[0];	

					if($rcp=='natasia' || $rcp=='marwah' || $rcp=='fita-rcp' || $rcp=='erma.rcp' || $rcp=='novi-rcp' || $rcp=='Sari.rcp'){
						$tipe = 'A';
						$gajipokok = $gajipokok+1000000;
					} else if($rcp=='anita'){
						$tipe = 'A';
						$gajipokok = 1400000;
					} else{
						$tipe = 'C';
						$gajipokok = $gajipokok+1250000;
					}

					if($hadir>25){
						$lemburreg = $hadir-25;
						$hadirreg = $hadir-$lemburreg;
					} else{
						$lemburreg = 0;
						$hadirreg = $hadir;
					}

					$gajipokok = ($gajipokok/25)*$hadirreg;
					$lembur = $lemburreg*($gajipokok/25);

					$qso = mysqli_query($con, "SELECT COUNT(DISTINCT DATE_FORMAT(tgl_so, '%Y-%m-%d')) AS so FROM reception WHERE rcp_so='$rcp' AND  DATE_FORMAT(tgl_so, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
					$dataso = mysqli_fetch_row($qso);
					$so = $dataso[0];

					$qspk = mysqli_query($con, "SELECT SUM((total_bayar+diskon)*0.04) AS spk FROM reception WHERE rcp_spk='$rcp' AND DATE_FORMAT(tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
					$spk = mysqli_fetch_array($qspk);
					$bonusspk = $spk['spk'];

					$qmember = mysqli_query($con, "SELECT COUNT(DISTINCT id_customer) AS member FROM faktur_penjualan WHERE jenis_transaksi='membership' AND rcp='$rcp' AND DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
					$member = mysqli_fetch_array($qmember);
					$bonusmember = $member['member']*20000;
					
					$qreject = mysqli_query($con, "SELECT SUM((a.total_bayar+a.diskon)*0.08) AS reject FROM reception AS a INNER JOIN rijeck AS b ON a.no_nota=b.no_nota WHERE a.rcp_spk='$rcp' AND DATE_FORMAT(b.tgl_rijeck, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
					$reject = mysqli_fetch_array($qreject);
					$potonganreject = $reject['reject'];

					$qspkedit = mysqli_query($con, "SELECT SUM((a.total_bayar+a.diskon)*0.08) AS spkedit FROM reception AS a INNER JOIN rijeck AS b ON a.no_nota=b.no_nota WHERE a.rcp_spk_edit='$rcp' AND DATE_FORMAT(a.tgl_spk_edit, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
					$spkedit = mysqli_fetch_array($qspkedit);
					$bonuseditspk = $spkedit['spkedit'];
					$reject = $bonuseditspk-$potonganreject;
				
					$qqa = mysqli_query($con, "SELECT COUNT(DISTINCT nama_customer) AS customer FROM quality_audit WHERE user_input='$rcp' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
					$qa = mysqli_fetch_array($qqa);
					$bonusqa = $qa['customer']*5000;

					$tidaktutupkasir = (-$hadir+$kasir)*25000;
					$tidakso = (-$hadir+$so)*5000;

					
					$gaji = $gajipokok+$lembur+$duabelas+$bonusspk+$bonusmember+$bonusqa+$komisilgn+$komisiomset+$reject+$tidaksetor+$tidaktutupkasir+$tidakso+$absen+$izin1+$izin2+$terlambat;

				?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $rcp ?></td>			
					<td><?php echo $hadirreg; ?></td>
					<td><?php echo rupiah($gajipokok) ?></td>
					<td><?php echo rupiah($lembur) ?></td>
					<td><?php echo rupiah($duabelas) ?></td>		
					<td><?php echo rupiah($bonusspk); ?></td>
					<td><?php echo rupiah($bonusmember); ?></td>
					<td><?php echo rupiah($bonusqa) ?></td>
					<td><?php echo rupiah($komisilgn) ?></td>
					<td><?php echo rupiah($komisiomset) ?></td>
					<td><?php echo rupiah($reject) ?></td>
					<td><?php echo rupiah($tidaksetor) ?></td>
					<td><?php echo rupiah($tidaktutupkasir); ?></td>
					<td><?php echo rupiah($tidakso) ?></td>
					<td><?php echo rupiah($absen) ?></td>
					<td><?php echo rupiah($izin1) ?></td>
					<td><?php echo rupiah($izin2) ?></td>	
					<td><?php echo rupiah($terlambat) ?></td>	
					<td><?php echo rupiah($gaji) ?></td>				
				</tr>
				<?php 
				}
				?>
			</tbody>
		</table>
	</div>
