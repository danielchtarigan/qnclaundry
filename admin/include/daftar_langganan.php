


<legend align="center"><strong>Daftar Langganan</strong></legend>
<form method="POST" action="act/saldo_hangus.php">
	<button type="submit" class="btn btn-md btn-danger" style="margin-bottom: 25px">Matikan</button>
	<br>
	
<div style="overflow-x: auto">
	<table class="table table-hover table-bordered table-striped" id="tampil" style="font-size:9pt">
		<thead>
			<th></th>
			<th>ID</th>
			<th>Nama Customer</th>
			<th>Tanggal Join</th>
			<th>Tanggal Akhir</th>
			<th>Kuota Kiloan</th>
			<th>Kuota Potongan</th>
			<th>Status</th>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$query = mysqli_query($con, "SELECT *FROM customer AS a INNER JOIN langganan AS b ON a.id=b.id_customer");
			while($data = mysqli_fetch_array($query)){
				$id = (int) $data['id_customer'];
				?>
			<tr>
				<td align="center"><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>	
				<td><?php echo $id ?></td>
				<td><?php echo $data['nama_customer'] ?></td>
				<td><?php echo $data['tgl_join'] ?></td>
				<td><?php if($data['tgl_expire']==NULL) echo '<center>-</center>' ; else echo $data['tgl_expire']; ?></td>
				<td><?php echo $data['kilo_cks'] ?></td>
				<td><?php echo $data['potongan'] ?></td>
				<td><?php if($data['lgn']==1) echo "Aktif"; else echo "Berhenti"; ?></td><!-- 
				<td style="color:red; text-align: center">
				<?php 
				echo '<a href="act/daftar_langganan.php?menu=hapus&id='.$data['id_customer'].'" class="btn btn-danger btn-block">X</a>'
				?>					
				</td> -->
			</tr>
			<?php }
			?>
		</tbody>
	</table>
</div>
</form>
<script type="text/javascript">
		$(document).ready(function(){
			$('input[value="Check All"]').change(function() { // a button with Check All as its value
			    $(':checkbox').prop('checked', true); // all checkboxes, you can narrow with a better selector
			});
			$('#tampil').dataTable({
			"order": [[ 1,"asc" ]],
				dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [ 'copy',
                        {
                            'sExtends': 'xls',
                            'sFileName': 'Daftar Langganan.xls',
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
				}).yadcf([
        	        {column_number : 7}
        	    ]);
        	    

		});
	</script>

	