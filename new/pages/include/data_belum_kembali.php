<?php 
include '../../config.php';
session_start();
$outlet = $_SESSION['outlet'];

?>



<div class="panel panel-default">		
	<div class="panel-body">
		<h4 class="black"> <i class="ace-icon glyphicon glyphicon-list"></i> Cucian Belum Kembali</h4>
		<div class="table-responsive">
			<table id="dynamic-table" class="table table-bordered table-condensed table-striped table-hover" style="font-size: 9pt">
				<thead>
					<tr>
						<th>Tanggal Masuk</th>
						<th>No Nota</th>
						<th>Nama Customer</th>
						<th>jenis</th>
						<th>Rcp Order</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query = mysqli_query($con, "SELECT * FROM reception WHERE spk=true AND lunas=true AND kembali=false AND ambil=false AND tgl_so='0000-00-00 00:00:00' AND nama_outlet='$outlet' ORDER BY id DESC");
					while($data = mysqli_fetch_array($query)){
						?>
						<tr>
							<td><?php echo date('d/m/Y H:i', strtotime($data['tgl_input'])) ?></td>
							<td><?php echo $data['no_nota'] ?></td>
							<td>
								<?php 
								$customer = mysqli_fetch_row(mysqli_query($con, "SELECT nama_customer FROM customer WHERE id='$data[id_customer]'"))[0];
								echo $customer;
								?>
							</td>
							<td><?php if($data['jenis']=='k') echo 'Kiloan'; else echo 'Potongan'; ?></td>
							<td><?php if($data['nama_reception']!='') echo $data['nama_reception']; else echo '-'; ?></td>
							<td><?php if($data['packing']=='1') echo "Packing"; else if($data['setrika']=='1') echo "Setrika"; else if($data['cuci']=='1') echo "Cuci"; ?></td>
						</tr>

						<?php

					}

					?>
				</tbody>
			</table>
		</div>				
	</div>
</div>


<script type="text/javascript">
	$('#dynamic-table').dataTable({
	     "oLanguage": {
		      "sLengthMenu": "Tampilkan _MENU_",
		      "sSearch": "Pencarian: ",
		      "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
		      "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
		      "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
		      "sInfoFiltered": "(di filter dari _MAX_ total data)",
		      "oPaginate": {
		          "sFirst": "First",
		          "sLast": "Last", 
		          "sPrevious": "<", 
		          "sNext": ">"
	       }
      },
      "sPaginationType":"full_numbers",
      "bJQueryUI":true
    });
</script>