<?php 
include '../config.php';
include 'header.php';
include 'fungsi/kpi_operasional.php';

date_default_timezone_set('Asia/Makassar');
if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];

	$pastStartDate = date('Y-m-d', strtotime('-3 months', strtotime($startDate)));
	$pastEndDate = date('Y-m-d', strtotime('-1 months', strtotime($endDate)));
} else{
	$startDate = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
	$endDate   = date('Y-m').'-25';
}

?>

<div class="container" style="width:auto; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-top:50px; margin-bottom:50px; color:#000000;">
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



<style type="text/css">
	th{
		text-align: center;
	}
</style>

	<fieldset>
	<legend align="center" >DAFTAR PENCAPAIAN POIN DAN KPI OPERASIONAL<br>
	<h4 align="center"></center><?php echo 'Periode '.date("d F Y", strtotime($startDate)).' - '.date("d F Y", strtotime($endDate)); ?></h4></legend>
	<?php include 'cari2.php' ?>
		<div style="overflow-x: auto">
			<table class="table  table-condensed" id="tampilok" style="font-size: 11px">
				<thead>
					<tr>
						<th>Nama</th>
						<th>Posisi</th>
						<th>Target</th>
						<th>Hari Kerja</th>
						<th>Masuk Malam</th>
						<th>Poin Minimal</th>
						<th>Cuci Kiloan</th>
						<th>Cuci Potongan</th>
						<th>Kering Kiloan</th>
						<th>Setrika Retail</th>
						<th>Packing Kiloan</th>
						<th>Packing Potongan</th>
						<th>Express Operator</th>
						<th>Express Setrika</th>
						<th>Express Packing</th>
						<th>Priority Operator</th>
						<th>Insentif Malam</th>
						<th>Bagi Brosur</th>
						<th>Cucian Telat</th>
						<th>Kasus Operasional</th>
						<th>Pencapaian Operator</th>
						<th>Pencapaian Setrika</th>
						<th>Pencapaian Packing</th>
						<th>Bonus Omset Potongan</th>
						<th>Nominal Target</th>
						<th>Nominal Dicapai</th>
						<th>Grand Total</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$a = user_name();
					while($users = mysqli_fetch_array($a)){
						$user = $users['name'];
						$level = $users['level'];
						$jenis = $users['jenis'];
						$tipe = $users['type'];
						$posisi = ucwords($level.' '.$jenis);
						$id = $users['user_id'];
						$data = laporan_pencapaian_operasional($user,$posisi,$tipe,date('Y/m/d', strtotime($startDate)),date('Y/m/d', strtotime($endDate)));
						?>

						<tr>
							<td><?php echo $user ?></td>
							<td><?php echo $posisi ?></td>
							<td><?php echo $data['target'] ?></td>
							<td><?php echo $data['hari_kerja'] ?></td>
							<td><?php echo $data['masuk_malam'] ?></td>
							<td><?php echo $data['poin_minimal'] ?></td>
							<td><?php if(array_key_exists('cuci_kiloan', $data)) echo $data['cuci_kiloan']; else echo 0; ?></td>
							<td><?php if(array_key_exists('cuci_potongan', $data)) echo $data['cuci_potongan']; else echo 0; ?></td>
							<td><?php if(array_key_exists('kering_kiloan', $data)) echo $data['kering_kiloan']; else echo 0; ?></td>
							<td><?php if(array_key_exists('setrika', $data)) echo $data['setrika']; else echo 0; ?></td>
							<td><?php if(array_key_exists('packing_kiloan', $data)) echo $data['packing_kiloan']; else echo 0; ?></td>
							<td><?php if(array_key_exists('packing_potongan', $data)) echo $data['packing_potongan']; else echo 0; ?></td>
							<td><?php if(array_key_exists('express_opr', $data)) echo $data['express_opr']; else echo 0; ?></td>
							<td><?php if(array_key_exists('express_str', $data)) echo $data['express_str']; else echo 0; ?></td>
							<td><?php if(array_key_exists('express_pck', $data)) echo $data['express_pck']; else echo 0; ?></td>
							<td><?php if(array_key_exists('priority_opr', $data)) echo $data['priority_opr']; else echo 0; ?></td>
							<td><?php echo round($data['insentif_malam'],2) ?></td>
							<td><?php echo $data['bagi_brosur'] ?></td>
							<td><?php echo $data['cucian_telat'] ?></td>
							<td><?php echo $data['kasus_operasional'] ?></td>
							<td><?php if(array_key_exists('pencapaian_operator', $data)) echo $data['pencapaian_operator']; else echo 0; ?></td>
							<td><?php echo $data['pencapaian_setrika']; ?></td>
							<td><?php if(array_key_exists('pencapaian_packing', $data)) echo $data['pencapaian_packing']; else echo 0; ?></td>
							<td><?php if(array_key_exists('bonus_omset_potongan', $data)) echo mata_uang($data['bonus_omset_potongan']); else echo 0;  ?></td>
							<td><?php echo mata_uang($data['nominal_target']) ?></td>
							<td><?php echo mata_uang($data['total_capai']) ?></td>
							<td><?php echo mata_uang($data['grand_total']) ?></td>
						</tr>
					<?php		
					}

					?>
				</tbody>
			</table>
		</div>
	</fieldset>
</div>