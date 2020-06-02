<?php 
include '../config.php';
include 'header.php';
include '../fungsi_poin_operasional.php';

function rupiah($angka)
{
	$jadi = "Rp ".number_format($angka,0,',','.');
	return $jadi;
}

if(isset($_POST['cari'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];
} else{
	$startDate = date('Y/m', strtotime('-1 months', strtotime(date('Y-m-d')))).'/26';
	$endDate   = date('Y/m').'/25';
}
?>



<div class="container" style="width:auto; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4); margin-top:0px; margin-bottom:70px; color:#000000; padding-top: 60px">

<style type="text/css">
	th{
		text-align: center;
	}
</style>

<script type="text/javascript">
		$(document).ready(function(){
			$('#tampil').dataTable({
			"order": [[ 4,"asc" ]],
				dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [ 'copy',
                        {
                            'sExtends': 'xls',
                            'sFileName': 'KPI operasional.xls',
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
					"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],					
				});

		});
	</script>

	<legend align="center">KPI OPERASIONAL</legend>
	    <?php include 'cari.php'; ?>
		<form action="act/kunci_kpi.php" method="POST">
			<button type="submit"><i class="fa fa-key fa-fw" aria-hidden="true"></i>Kunci</button><br><br><br>
			<div class="table-responsive" style="overflow-x:auto;">
				<table class="table table-hover table-border" id="tampil" style="font-size: 10px">
					<thead>
						<tr>
							<th rowspan="2" class="hidden">Start</th>
							<th rowspan="2" class="hidden">End</th>
							<th rowspan="2">USER ID</th>
							<th rowspan="2">NAMA CREW</th>
							<th rowspan="2">JABATAN</th>
							<th rowspan="2">TARGET</th>
							<th rowspan="2">HARI KERJA</th>
							<th rowspan="2">MASUK MALAM</th>
							<th rowspan="2">POIN MINIMAL</th>
							<th colspan="7">PENCAPAIAN POIN NORMAL</th>
							<th colspan="4">PENCAPAIAN POIN BONUS</th>
							<th rowspan="2">TOTAL PENCAPAIAN POIN</th>
							<th rowspan="2">BONUS OMSET POTONGAN</th>
							<th colspan="2">POIN DENDA OPERASIONAL</th>
							<th rowspan="2">TOTAL DENDA OPERASIONAL</th>
							<th rowspan="2">PENCAPAIAN-DENDA</th>
							<th rowspan="2">RATA-RATA HARIAN</th>
							<th rowspan="2">KEKURANGAN POIN PERBULAN</th>
							<th rowspan="2">TOTAL BONUS RUPIAH</th>
							<th rowspan="2">TOTAL POTONGAN RUPIAH</th>
							<th rowspan="2">GRAND TOTAL RUPIAH</th>
						</tr>
						<tr>
							<th>Cuci Kiloan</th>
							<th>Kering Kiloan</th>
							<th>Cuci Potongan</th>
							<th>Setrika Retail</th>
							<th>Packing Kiloan</th>
							<th>Packing Potongan</th>
							<th>Cuci dan Packing Hotel</th>
							<th>Insentif Malam</th>
							<th>Bagi Brosur</th>
							<th>Express</th>
							<th>Priority</th>				
							<th>Cucian Telat</th>
							<th>Kasus Operasional</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						   $startDate = $startDate;
						   $endDate = $endDate;
						
						$users = mysqli_query($con, "SELECT name, user_id, level, jenis FROM user WHERE (level='operator' OR level='setrika' OR level='packer') AND aktif='Ya'");
						while($us = mysqli_fetch_row($users)){				
								$id = $us[1];
								$user = $us[0];
								$posisi = $us[2];
								$jenis = $us[3];

								$data = result_poin($user,$posisi,$jenis,$startDate,$endDate);
								if($data['hadir']>0){
								?>
								<tr>
									<td class="hidden"><input type="text" name="awal[]" value="<?php echo date('Y-m-d', strtotime($startDate)); ?>"></td>
									<td class="hidden"><input type="text" name="akhir[]" value="<?php echo date('Y-m-d', strtotime($endDate)); ?>"></td>
									<td><input class="hidden" type="text" name="id[]" value="<?php echo $id; ?>"><?php echo $id; ?></td>
									<td><input class="hidden" type="text" name="user[]" value="<?php echo $user; ?>"><?php echo $user; ?></td>
									<td><input class="hidden" type="text" name="jabatan[]" value="<?php echo $data['jabatan']; ?>"><?php echo $data['jabatan']; ?></td>
									<td><input class="hidden" type="text" name="target[]" value="<?php echo $data['target'] ?>"><?php echo $data['target'] ?></td>
									<td><input class="hidden" type="text" name="hadir[]" value="<?php echo $data['hadir']; ?>"><?php echo $data['hadir']; ?></td>
									<td><input class="hidden" type="text" name="masuk_malam[]" value="<?php echo $data['masuk_malam'] ?>"><?php echo $data['masuk_malam'] ?></td>
									<td><input class="hidden" type="text" name="poin_minimal[]" value="<?php echo $data['poin_minimal'] ?>"><?php echo $data['poin_minimal'] ?></td>
									<td><input class="hidden" type="text" name="cuci_kiloan[]" value="<?php if(array_key_exists('cuci_kiloan', $data)) echo $data['cuci_kiloan']; else echo 0; ?>"><?php if(array_key_exists('cuci_kiloan', $data)) echo $data['cuci_kiloan']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="poin_pengering[]" value="<?php if(array_key_exists('poin_pengering', $data)) echo $data['poin_pengering']; else echo 0; ?>"><?php if(array_key_exists('poin_pengering', $data)) echo $data['poin_pengering']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="cuci_potongan[]" value="<?php if(array_key_exists('cuci_potongan', $data)) echo $data['cuci_potongan']; else echo 0; ?>"><?php if(array_key_exists('cuci_potongan', $data)) echo $data['cuci_potongan']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="setrika[]" value="<?php if(array_key_exists('setrika', $data)) echo $data['setrika']; else echo 0; ?>"><?php if(array_key_exists('setrika', $data)) echo $data['setrika']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="packing_kiloan[]" value="<?php if(array_key_exists('packing_kiloan', $data)) echo $data['packing_kiloan']; else echo 0; ?>"><?php if(array_key_exists('packing_kiloan', $data)) echo $data['packing_kiloan']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="packing_potongan[]" value="<?php if(array_key_exists('packing_potongan', $data)) echo $data['packing_potongan']; else echo 0; ?>"><?php if(array_key_exists('packing_potongan', $data)) echo $data['packing_potongan']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="poin_hotel[]" value="0">0</td>
									<td><input class="hidden" type="text" name="insentif_malam[]" value="<?php if(array_key_exists('insentif_malam', $data)) echo round($data['insentif_malam'],2); else echo 0; ?>"><?php if(array_key_exists('insentif_malam', $data)) echo round($data['insentif_malam'],2); else echo 0; ?></td>
									<td><input class="hidden" type="text" name="bagi_brosur[]" value="<?php if(array_key_exists('bagi_brosur', $data)) echo $data['bagi_brosur']; else echo 0; ?>"><?php if(array_key_exists('bagi_brosur', $data)) echo $data['bagi_brosur']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="poin_express[]" value="<?php if(array_key_exists('poin_express', $data)) echo $data['poin_express']; else echo 0; ?>"><?php if(array_key_exists('poin_express', $data)) echo $data['poin_express']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="poin_priority[]" value="<?php if(array_key_exists('poin_priority', $data)) echo $data['poin_priority']; else echo 0; ?>"><?php if(array_key_exists('poin_priority', $data)) echo $data['poin_priority']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="total_pencapaian_poin[]" value="<?php if(array_key_exists('total_pencapaian_poin', $data)) echo round($data['total_pencapaian_poin'],2); else echo 0; ?>"><?php if(array_key_exists('total_pencapaian_poin', $data)) echo round($data['total_pencapaian_poin'],2); else echo 0; ?></td>
									<td><input class="hidden" type="text" name="bonus_omset_potongan[]" value="<?php if(array_key_exists('bonus_omset_potongan', $data)) echo $data['bonus_omset_potongan']; else echo 0; ?>"><?php if(array_key_exists('bonus_omset_potongan', $data)) echo rupiah($data['bonus_omset_potongan'],2); else echo 0; ?></td>
									<td><input class="hidden" type="text" name="cucian_telat[]" value="<?php if(array_key_exists('cucian_telat', $data)) echo $data['cucian_telat']; else echo 0; ?>"><?php if(array_key_exists('cucian_telat', $data)) echo $data['cucian_telat']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="kasus_operasional[]" value="<?php if(array_key_exists('kasus_operasional', $data)) echo $data['kasus_operasional']; else echo 0; ?>"><?php if(array_key_exists('kasus_operasional', $data)) echo $data['kasus_operasional']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="total_denda_operasional[]" value="<?php if(array_key_exists('total_denda_operasional', $data)) echo $data['total_denda_operasional']; else echo 0; ?>"><?php if(array_key_exists('total_denda_operasional', $data)) echo $data['total_denda_operasional']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="pencapaian_akhir[]" value="<?php if(array_key_exists('pencapaian_akhir', $data)) echo round($data['pencapaian_akhir'],2); else echo 0; ?>"><?php if(array_key_exists('pencapaian_akhir', $data)) echo round($data['pencapaian_akhir'],2); else echo 0; ?></td>
									<td><input class="hidden" type="text" name="rata_harian[]" value="<?php if(array_key_exists('rata_harian', $data)) echo round($data['rata_harian'],2); else echo 0; ?>"><?php if(array_key_exists('rata_harian', $data)) echo round($data['rata_harian'],2); else echo 0; ?></td>
									<td><input class="hidden" type="text" name="kekurangan_poin_perbulan[]" value="<?php if(array_key_exists('kekurangan_poin_perbulan', $data)) echo $data['kekurangan_poin_perbulan']; else echo 0; ?>"><?php if(array_key_exists('kekurangan_poin_perbulan', $data)) echo $data['kekurangan_poin_perbulan']; else echo 0; ?></td>
									<td><input class="hidden" type="text" name="total_bonus[]" value="<?php if(array_key_exists('total_bonus', $data)) echo $data['total_bonus']; else echo 0; ?>"><?php if(array_key_exists('total_bonus', $data)) echo rupiah($data['total_bonus']); else echo 0; ?></td>
									<td><input class="hidden" type="text" name="total_potongan[]" value="<?php if(array_key_exists('total_potongan', $data)) echo $data['total_potongan']; else echo 0; ?>"><?php if(array_key_exists('total_potongan', $data)) echo rupiah($data['total_potongan']); else echo 0; ?></td>
									<td><input class="hidden" type="text" name="grand_total[]" value="<?php if(array_key_exists('grand_total', $data)) echo $data['grand_total']; else echo 0; ?>"><?php if(array_key_exists('grand_total', $data)) echo rupiah($data['grand_total']); else echo 0; ?></td>
								</tr>

						<?php 
							}
						}
					
						?>			
					</tbody>
				</table>
			</div>
		</form>
</div>