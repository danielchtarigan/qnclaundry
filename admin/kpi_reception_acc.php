<?php 
include '../config.php';
include 'header.php';
include 'fungsi/kpi_reception.php';


function rupiah($angka){
	$rp = number_format($angka,0);
	return $rp;
}


if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate = $_POST['end'];

} else{
	$startDate = date('Y-m', strtotime('-1 month', strtotime(date('Y-m-d')))).-'26';
	$endDate = date('Y-m').'-25';
}

?>


<div class="container-fluid" style="width:95%; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000; margin-top: 10px">

<div>
	<legend align="center">Key Performance Indicator<br>Receptionist
	<p style="font-size:10pt">Periode <?php echo date('d/m/Y', strtotime($startDate)).' Sampai '.date('d/m/Y', strtotime($endDate)) ?></p>
	</legend>
</div>

<div>
	<?php require 'cari2.php'; ?>
</div>
<div style="overflow-x: auto">
	<table class="table table-condensed" style="font-size:7pt" id="rincian_kpi">
		<thead>
			<tr>
				<th>Nama Reception</th>
				<th>Type</th>
				<th>Gaji Pokok</th>
				<th>SPK 4% (kiloan)</th>
				<th>SPK 2% (Potongan)</th>
				<th>SPK 7% (Potongan)</th>
				<th>Bonus SPK</th>
				<th>Reject</th>
				<th>Quality Audit</th>
				<th>Bonus Membership</th>
				<th>Komisi Langganan</th>
				<th>Tidak Tutup Kasir</th>
				<th>Tidak SO</th>
				<th>Bonus KPI</th>
				<th>Total Bonus KPI</th>
			</tr>
		</thead>
		<tbody>
			<?php 			
			$query = mysqli_query($con, "SELECT * FROM user WHERE level='reception' AND aktif='Ya' AND cabang='makassar'");
			while($data = mysqli_fetch_array($query)){
				$nama = $data['name'];
				$type = $data['type'];
				$jenis = $data['izinkan'];
				$data = kpi_reception($nama,$type,$jenis,$startDate,$endDate);
				?>
				<tr>
					<td><?php echo $nama ?></td>
					<td><?php if($type==NULL) echo 'C'; else echo $type; ?></td>
					<td><?php echo rupiah($data['gp']); ?></td>
					<td><?php echo rupiah($data['bonus_spk_kiloan']); ?></td>
					<td><?php echo rupiah($data['spk_potongan_2']); ?></td>
					<td><?php echo rupiah($data['spk_potongan_7']); ?></td>
					<td><?php echo rupiah($data['total_bonus_spk']) ?></td>
					<td><?php echo rupiah($data['reject']) ?></td>
					<td><?php echo rupiah($data['quality_audit']) ?></td>
					<td><?php echo rupiah($data['membership']) ?></td>
					<td><?php echo rupiah($data['langganan']) ?></td>
					<td><?php echo rupiah($data['tidak_tutup_kasir']) ?></td>
					<td><?php echo rupiah($data['tidak_so']) ?></td>
					<td><?php echo rupiah($data['bonus_kpi']) ?></td>
					<td>Bonus KPI+Komisi Omset+Denda Telat Setor</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
		$(document).ready(function(){
			$('#rincian_kpi').dataTable({
			"order": [[ 1,"asc" ]],
				dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [ 'copy',
                        {
                            'sExtends': 'xls',
                            'sFileName': 'KPI Resepsionis.xls',
                            'sButtonText': 'Excel'
                            
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
</div>