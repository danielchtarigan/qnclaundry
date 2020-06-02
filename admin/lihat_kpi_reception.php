<?php 
include '../config.php';
include 'header.php';

date_default_timezone_set('Asia/Makassar');

if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];
	
} else{
	$startDate = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
	$endDate   = date('Y-m').'-25';
}

$qmanager = mysqli_query($con, "SELECT *FROM user WHERE level='admin' AND jenis='superAdmin' ");
$datamanager = mysqli_fetch_array($qmanager);
$manager = $datamanager['name'];

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}

?>

<script type="text/javascript">
		$(document).ready(function(){
			$('#tampilok').dataTable({
			"order": [[ 0,"asc" ]],
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
	<h4 align="center">Pilih Range Waktu</h4>
  	<div class="col-md-6 col-md-offset-4">
		<form class="form-inline" method="POST">
		<div class="col-md-4 col-xs-5 col-md-offset-0"><input class="form-control" type="date" name="start" value="<?php echo $startDate ?>"></div>
		<div class="col-md-4 col-xs-5 col-md-offset-0"><input class="form-control" type="date" name="end" value="<?php echo $endDate ?>"></div>
		<div class="col-md-4 col-xs-2 col-xs-offset-0"><input class="btn btn-primary btn-md btn-active" type="submit" name="submit" value="Pilih"></div>
		</form>
    </div>
	<br><br><br>
	<form action="act/kunci_kpi_reception.php" method="POST">
		<?php if($_SESSION['user_id']==$manager) echo '<button class="btn btn-xs btn-danger btn-active" name="submit"><i class="fa fa-key" aria-hidden="true"></i>  KUNCI KPI</button></a>'; ?><br>

		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover" id="tampilok" style="font-size:9px">
				<thead>
					<tr>
						<th rowspan="2">No</th>
						<th rowspan="2">Tgl Mulai</th>
						<th rowspan="2">Tgl Akhir</th>
						<th rowspan="2">Nama Reception</th>	
						<th rowspan="2">Tipe</th>		
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
						<th>Izin Mendadak</th>
						<th>Izin Normal</th>			
					</tr>		
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qnamarcp = mysqli_query($con, "SELECT DISTINCT nama_reception FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND nama_outlet<>'mojokerto' ORDER BY nama_reception ASC ");
					while($namarcp = mysqli_fetch_array($qnamarcp)){
						$rcp = $namarcp['nama_reception'];
						$no = $i++;

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

						$extraop = mysqli_query($con, "SELECT *FROM extra_operasional AS a INNER JOIN user AS b ON a.id_user=b.user_id WHERE b.name='$rcp' ");
						$dataextra = mysqli_fetch_array($extraop);

						$duabelas = $duabelas+$dataextra['duabelasjam'];
						$komisiomset = $komisiomset+$dataextra['komisi_omset'];
						$absen = $absen+$dataextra['absen'];
						$izin1 = $izin1+$dataextra['izin_kurang_dua_jam']; //Mendadak
						$izin2 = $izin2+$dataextra['izin_lebih_dua_jam']; //Normal
						$lembur = $lembur+$dataextra['lembur_reguler'];
						$terlambat = $terlambat+$dataextra['akumulasi_telat'];
						$tidaksetor = $tidaksetor+$dataextra['telat_setor'];



						$kehadiran = mysqli_query($con, "SELECT COUNT(DISTINCT DATE_FORMAT(tgl_log, '%Y-%m-%d')) AS hari FROM log_rcp WHERE id_user='$rcp' AND DATE_FORMAT(tgl_log, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
						$datahadir = mysqli_fetch_row($kehadiran);
						$hadir = $datahadir[0];

						if($absen==0 || $izin1==0 || $izin2==0) $hadir = 25; else $hadir = $hadir;

						$kehadiran = mysqli_query($con, "SELECT COUNT(DISTINCT DATE_FORMAT(tgl_log, '%Y-%m-%d')) AS hari FROM log_rcp WHERE id_user='$rcp' AND DATE_FORMAT(tgl_log, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
						$datahadir = mysqli_fetch_row($kehadiran);
						$hadir = $datahadir[0];

						
						$tutupkasir = mysqli_query($con, "SELECT COUNT(DISTINCT DATE_FORMAT(tanggal, '%Y-%m-%d')) as tutup_kasir FROM tutup_kasir WHERE reception='$rcp' AND DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
						$datatutupkasir = mysqli_fetch_row($tutupkasir);
						$kasir = $datatutupkasir[0];	

						if($rcp=='natasia' || $rcp=='marwah' || $rcp=='fita-rcp' || $rcp=='erma.rcp' || $rcp=='novi-rcp' || $rcp=='Sari.rcp'){
							$tipe = 'A';
							$gajipokok = $gajipokok+1000000;
							$lembur = $lembur*($gajipokok/25/8)*2;
							$duabelas = ($gajipokok/25/8)*4*$duabelas;
						} else if($rcp=='anita'){
							$tipe = 'A+';
							$gajipokok = 1400000;
							$lembur = $lembur*($gajipokok/25/8)*2;
							$duabelas = ($gajipokok/25/8)*4*$duabelas;
						} else if($rcp=='ibhe'){
							$tipe = 'Peluncur';
							$gajipokok = 800000;
							$lembur = $lembur*($gajipokok/25/8)*2;
							$duabelas = ($gajipokok/25/8)*4*$duabelas;
						} else if($rcp=='nurul'){
							$tipe = 'Part Time';
							$gajipokok = 500000;
							$lembur = $lembur*($gajipokok/25/4)*2;
							$duabelas = ($gajipokok/25/4)*8*$duabelas;
						} else{
							$tipe = 'C';
							$gajipokok = $gajipokok+1250000;
							$lembur = $lembur*($gajipokok/25/12)*2;
							$duabelas = ($gajipokok/25/12)*4*$duabelas;
						}

						$hadirreg = 25-$absen-$izin1-$izin2;			

						//$gajipokok = ($gajipokok/25)*$hadirreg*0;
						$gajipokok = $gajipokok;

						
						$absen = ($gajipokok/25)*$absen*-3;
						$izin1 = ($gajipokok/25)*$izin1*-2; //Mendadak
						$izin2 = ($gajipokok/25)*$izin2*-1; //Normal
						$tidaksetor = $tidaksetor*-5000;
						if($terlambat>=120) $terlambat = ($terlambat/120)*$gajipokok/25; else $terlambat = $terlambat*0;

						$qso = mysqli_query($con, "SELECT COUNT(DISTINCT DATE_FORMAT(tgl_so, '%Y-%m-%d')) AS so FROM reception WHERE rcp_so='$rcp' AND  DATE_FORMAT(tgl_so, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
						$dataso = mysqli_fetch_row($qso);
						$so = $dataso[0];

						$qspk = mysqli_query($con, "SELECT SUM(total_bayar+diskon) AS spk FROM reception WHERE rcp_spk='$rcp' AND DATE_FORMAT(tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
						$spk = mysqli_fetch_array($qspk);
						$bonusspk = $spk['spk'];
						
						if($rcp=='Ratna') $bonusspk = $bonusspk*0.05; else $bonusspk = $bonusspk*0.04;

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
					
						$qqa = mysqli_query($con, "SELECT COUNT(*) AS customer FROM quality_audit WHERE user_input='$rcp' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
						$qa = mysqli_fetch_array($qqa);
						if($rcp=='marwah' || $rcp=='fita-rcp') {
						     $qa['customer'] = $qa['customer'];
						} else {
						    if($qa['customer']>20) $qa['customer'] = 20; else $qa['customer'] = $qa['customer'];
						}
						
						$bonusqa = $qa['customer']*5000;

						$masukoutlet = mysqli_query($con, "SELECT id_outlet FROM log_rcp WHERE DATE_FORMAT(tgl_log, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND id_user='$rcp'");
						$dataoutlet = mysqli_fetch_row($masukoutlet);
						$coutlet = $dataoutlet[0];

						$tidaktutupkasir = (-$hadir+$kasir)*25000*0;
						if($coutlet!='support')	$tidakso = (-$hadir+$so)*5000; else $tidakso = 0;

						$qkomisilgn = mysqli_query($con, "SELECT SUM(b.total*0.1) AS total FROM langganan AS a INNER JOIN faktur_penjualan AS b ON a.id_customer=b.id_customer WHERE a.tgl_join BETWEEN '$startDate' AND '$endDate' AND b.rcp='$rcp' AND b.jenis_transaksi='deposit' AND DATE_FORMAT(b.tgl_transaksi, '%Y-%m-%d')=a.tgl_join ");
						$datakomisilangganan = mysqli_fetch_row($qkomisilgn);
						$komisilgn = $datakomisilangganan[0];


											
						if($tipe=='C'){
							$gaji = $gajipokok+$lembur+$bonusmember+$komisilgn+$komisiomset+$tidaksetor+$tidaktutupkasir+$tidakso+$absen+$izin1+$izin2-$terlambat;
						} else if($tipe=='Peluncur'){
							$gaji = $gajipokok+$lembur+$duabelas+$bonusmember+$komisilgn+$komisiomset+$tidaksetor+$tidaktutupkasir+$tidakso+$absen+$izin1+$izin2-$terlambat;
						} else if($tipe=='Part Time'){
							$gaji = $gajipokok+$duabelas+$lembur+$komisiomset;
						} else{
							$gaji = $gajipokok+$lembur+$duabelas+$bonusspk+$bonusmember+$bonusqa+$komisilgn+$komisiomset+$reject+$tidaksetor+$tidaktutupkasir+$tidakso+$absen+$izin1+$izin2-$terlambat;
						}


						

					?>
					<tr>
						<td><input class="hidden" type="text" name="id[]" value="<?php echo $no; ?>"><?php echo $no ?></td>
						<td><input class="hidden" type="text" name="awal[]" value="<?php echo $startDate ?>"><?php echo $startDate ?></td>
						<td><input class="hidden" type="text" name="akhir[]" value="<?php echo $endDate ?>"><?php echo $endDate ?></td>
						<td><input class="hidden" type="text" name="rcp[]" value="<?php echo $rcp ?>"><?php echo $rcp ?></td>	
						<td><input class="hidden" type="text" name="tipe[]" value="<?php echo $tipe ?>"><?php echo $tipe ?></td>		
						<td><input class="hidden" type="text" name="hadir[]" value="<?php echo $hadirreg; ?>"><?php echo $hadirreg; ?></td>
						<td><input class="hidden" type="text" name="gajipokok[]" value="<?php echo $gajipokok ?>"><?php echo rupiah($gajipokok) ?></td>
						<td><input class="hidden" type="text" name="lemburreg[]" value="<?php echo $lembur ?>"><?php echo rupiah($lembur) ?></td>
						<td><input class="hidden" type="text" name="duabelas[]" value="<?php echo $duabelas ?>"><?php echo rupiah($duabelas) ?></td>		
						<td><input class="hidden" type="text" name="bonusspk[]" value="<?php echo $bonusspk ?>"><?php echo rupiah($bonusspk); ?></td>
						<td><input class="hidden" type="text" name="bonusmember[]" value="<?php echo $bonusmember ?>"><?php echo rupiah($bonusmember); ?></td>
						<td><input class="hidden" type="text" name="bonusqa[]" value="<?php echo $bonusqa ?>"><?php echo rupiah($bonusqa) ?></td>
						<td><input class="hidden" type="text" name="komisilgn[]" value="<?php echo $komisilgn ?>"><?php echo rupiah($komisilgn) ?></td>
						<td><input class="hidden" type="text" name="komisiomset[]" value="<?php echo $komisiomset ?>"><?php echo rupiah($komisiomset) ?></td>
						<td><input class="hidden" type="text" name="reject[]" value="<?php echo $reject ?>"><?php echo rupiah($reject) ?></td>
						<td><input class="hidden" type="text" name="tidaksetor[]" value="<?php echo $tidaksetor ?>"><?php echo rupiah($tidaksetor) ?></td>
						<td><input class="hidden" type="text" name="tidaktk[]" value="<?php echo $tidaktutupkasir ?>"><?php echo rupiah($tidaktutupkasir); ?></td>
						<td><input class="hidden" type="text" name="tidakso[]" value="<?php echo $tidakso ?>"><?php echo rupiah($tidakso) ?></td>
						<td><input class="hidden" type="text" name="absen[]" value="<?php echo $absen ?>"><?php echo rupiah($absen) ?></td>
						<td><input class="hidden" type="text" name="izin1[]" value="<?php echo $izin1 ?>"><?php echo rupiah($izin1) ?></td>
						<td><input class="hidden" type="text" name="izin2[]" value="<?php echo $izin2 ?>"><?php echo rupiah($izin2) ?></td>	
						<td><input class="hidden" type="text" name="terlambat[]" value="<?php echo $terlambat ?>"><?php echo rupiah($terlambat) ?></td>	
						<td><input class="hidden" type="text" name="gaji[]" value="<?php echo $gaji ?>"><?php echo rupiah($gaji) ?></td>
					</tr>
					<?php 
					}
					?>
				</tbody>
			</table>
		</div>

	</form>
