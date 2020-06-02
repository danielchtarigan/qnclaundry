<html>
<head>

	<?php

	date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
	include "header.php";
	include "../config.php";

	?>
</head>
<body>
	<div class="container" style="width:1250px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-top:50px; margin-bottom:50px; color:#000000;">
		<script type="text/javascript">
		$(document).ready(function(){
			$('#antar').dataTable({
				"order": [[ 0,"desc" ]],
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
				dom: 'T<"clear">lfrtip',
				tableTools: {
					"sSwfPath": "swf/copy_csv_xls_pdf.swf",
					"aButtons": [
						{
							"sExtends": "copy",
							"mColumns": [0,1,2,3,4,5,6,7,8,9,10],
							"oSelectorOpts": { filter: "applied", order: "current" }
						},
						{
							'sExtends': 'xls',
							"mColumns": [0,1,2,3,4,5,6,7,8,9,10],
							"oSelectorOpts": { filter: 'applied', order: 'current' }
						},

						{
							'sExtends': 'print',
							"mColumns": [0,1,2,3,4,5,6,7,8,9,10],
							"oSelectorOpts": { filter: 'applied', order: 'current' }
						}

					]
				},
				"columnDefs": [
					{
						"targets": [0],
						"visible": true,
						"searchable": true,"width":"5%",
					},
				],
				"bAutoWidth": false,
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
					if (aData[8] == 0) {
						$('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');
					} else if(aData[8] >= 1){
						$('td', nRow).css('background-color', 'red').css('color', 'white').css('font-weight', 'bold');
					}
				}
			});

		$('#jemput').dataTable({
			"order": [[ 0,"desc" ]],
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
			dom: 'T<"clear">lfrtip',
			tableTools: {
				"sSwfPath": "swf/copy_csv_xls_pdf.swf",
				"aButtons": [
					{
						"sExtends": "copy",
						"mColumns": [0,1,2,3,4,5,6,7,8],
						"oSelectorOpts": { filter: "applied", order: "current" }
					},
					{
						'sExtends': 'xls',
						"mColumns": [0,1,2,3,4,5,6,7,8],
						"oSelectorOpts": { filter: 'applied', order: 'current' }
					},

					{
						'sExtends': 'print',
						"mColumns": [0,1,2,3,4,5,6,7,8],
						"oSelectorOpts": { filter: 'applied', order: 'current' }
					}

				]
			},
			"columnDefs": [
				{
					"targets": [0],
					"visible": true,
					"searchable": true,"width":"5%",
				},
			],
			"bAutoWidth": false,
			"bJQueryUI" : true,
			"sPaginationType" : "full_numbers",
			"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				if (aData[7] == 0) {
					$('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');
				} else if(aData[7] >= 1){
					$('td', nRow).css('background-color', 'red').css('color', 'white').css('font-weight', 'bold');
				}
			}
		});

	});
	</script>

		<fieldset>
			<legend align="center" ><marquee behavior=alternate  width="800"><strong>Tabel Antar</strong></marquee></legend>
			<table id="antar" class="display" style="font-size:14px">
				<thead>
					<tr>
						<th>Jadwal Delivery</th>
						<th>No. Faktur</th>
						<th>Nama</th>
						<th>No. Telp</th>
						<th>Alamat</th>
						<th>Catatan</th>
						<th>Delivery</th>
						<th>Waktu</th>
						<th>Selisih Hari</th>
						<th>Status</th>
						<th>Gateway</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT DATE_FORMAT(tgl_permintaan,'%d/%m/%Y') AS tgl_permintaan, no_faktur, nama_customer, no_telp, alamat, catatan, nama_pengantar, waktu_permintaan, DATEDIFF(NOW(),tgl_permintaan) AS selisih, status, gateway FROM delivery WHERE jenis_permintaan='Antar' AND no_faktur IS NOT NULL ORDER BY selisih DESC";
					$tampil = mysqli_query($con, $query);
					while($data = mysqli_fetch_array($tampil)){?>
						<tr>
							<td><?php echo $data['tgl_permintaan']; ?></td>
							<td><?php echo $data['no_faktur']; ?></td>
							<td><?php echo $data['nama_customer']; ?></td>
							<td><?php echo $data['no_telp']; ?></td>
							<td><?php echo $data['alamat']; ?></td>
							<td><?php echo $data['catatan']; ?></td>
							<td><?php echo $data['nama_pengantar']; ?></td>
							<td><?php echo $data['waktu_permintaan']; ?></td>
							<td><?php echo $data['selisih']; ?></td>
							<td><?php echo $data['status']; ?></td>
							<td><?php echo $data['gateway']; ?></td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</fieldset>

			<fieldset>
				<legend align="center" ><marquee behavior=alternate  width="800"><strong>Tabel Jemput</strong></marquee></legend>
				<table id="jemput" class="display" style="font-size:14px">
					<thead>
						<tr>
							<th>Jadwal Delivery</th>
							<th>Nama</th>
							<th>No. Telp</th>
							<th>Alamat</th>
							<th>Catatan</th>
							<th>Delivery</th>
							<th>Waktu</th>
							<th>Selisih Hari</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT DATE_FORMAT(tgl_permintaan,'%d/%m/%Y') AS tgl_permintaan, nama_customer, no_telp, alamat, catatan, nama_pengantar, waktu_permintaan, DATEDIFF(NOW(),tgl_permintaan) AS selisih, status FROM delivery WHERE jenis_permintaan='Jemput' ORDER BY selisih DESC";
						$tampil = mysqli_query($con, $query);
						while($data = mysqli_fetch_array($tampil)){?>
							<tr>
								<td><?php echo $data['tgl_permintaan']; ?></td>
								<td><?php echo $data['nama_customer']; ?></td>
								<td><?php echo $data['no_telp']; ?></td>
								<td><?php echo $data['alamat']; ?></td>
								<td><?php echo $data['catatan']; ?></td>
								<td><?php echo $data['nama_pengantar']; ?></td>
								<td><?php echo $data['waktu_permintaan']; ?></td>
								<td><?php echo $data['selisih']; ?></td>
								<td><?php echo $data['status']; ?></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</fieldset>

		</div>
	</body>
</html>
