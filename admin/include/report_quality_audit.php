<?php 
if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];
} else{
	$startDate = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
	$endDate   = date('Y-m').'-25';
}

?>		
<script type="text/javascript">
		$(document).ready(function(){
			$('#laporan').dataTable({
        "order": [[ 1,"asc" ]],
        dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },

                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
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
				"iDisplayLength": 10,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],

			}).yadcf([
	    {column_number : 2}, {column_number : 12}
	    ]);

		});
	</script>
	

<div class="container" style="width:auto; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin: -15px -15px; padding-top:20px; color:#000000;">
    <?php require 'cari2.php'; ?>
	<legend align="center">Laporan Quality Audit Customer<br><?php echo 'Tanggal '.date("d F Y",strtotime($startDate)).' - '.date("d F Y",strtotime($endDate)); ?>
	</legend>
		<div class="table-responsive" style="overflow-x:auto;">
			<table class="table" style="font-size: 10px" id="laporan">
				<thead>
					<tr>
						<th style="text-align: center">Tanggal Audit</th>
						<th style="text-align: center">Nomor QA</th>
						<th style="text-align: center">Jenis Cuci</th>
						<th style="text-align: center">Nomor Nota</th>
						<th style="text-align: center">Nama Customer</th>
						<th style="text-align: center">Nomor Telepon</th>
						<th style="text-align: center">Bersih</th>
						<th style="text-align: center">Rapi</th>
						<th style="text-align: center">Harum</th>
						<th style="text-align: center">Tepat Waktu</th>
						<th style="text-align: center">Tepat Jumlah</th>
						<th style="text-align: center">Komentar</th>
						<th style="text-align: center">Diaudit Oleh</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query = mysqli_query($con, "SELECT a.tgl_input AS tgl_input,a.no_qa AS no_qa,b.jenis AS jenis,a.no_nota AS no_nota,a.nama_customer AS nama_customer,b.id_customer AS id_customer,a.harum AS harum,a.bersih AS bersih,a.rapi AS rapi, a.waktu AS waktu,a.jumlah AS jumlah,a.ket AS ket,a.user_input AS user_input FROM quality_audit AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota WHERE DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
					while($data = mysqli_fetch_array($query)){
					?>
					<tr>
						<td><?php echo date('d/m/Y H:i:s', strtotime($data['tgl_input'])) ?></td>
						<td><?php echo $data['no_qa'] ?></td>
						<td><?php if($data['jenis']=='k') echo "Kiloan"; else echo "Potongan" ?></td>
						<td><?php echo $data['no_nota'] ?></td>
						<td><?php echo $data['nama_customer'] ?></td>
						<td>
						<?php
						$qtelp = mysqli_fetch_row(mysqli_query($con, "SELECT no_telp FROM customer WHERE id='$data[id_customer]'"));
						echo $qtelp[0];
						?>					
						</td>
						<td><?php echo $data['bersih'] ?></td>
						<td><?php echo $data['rapi'] ?></td>
						<td><?php echo $data['harum'] ?></td>
						<td><?php echo $data['waktu'] ?></td>
						<td><?php echo $data['jumlah'] ?></td>
						<td><?php if($data['ket']<>'') echo $data['ket']; else echo "-" ?></td>
						<td><?php echo $data['user_input'] ?></td>
					</tr>
					<?php 
					} 
					?>
				</tbody>
			</table>
		</div>

    

</div>
