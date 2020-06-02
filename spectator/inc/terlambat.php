<script type="text/javascript">
		$(document).ready(function(){
			$('#terlambat').dataTable({
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
			dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../admin/swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },

                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }

                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"4px",
                    },  { "width": "5px", "targets": [0] },{ "width": "5px", "targets": 1 },
                ],
                "bAutoWidth": false,


				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                     if ( aData[9] >= 1)
                    {
                        $('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');

                    }
                    if( aData[9] >= 2){
				 	  $('td', nRow).css('background-color', 'red').css('color', 'white').css('font-weight', 'bold');
		    }
                   }

			}).yadcf([



	    {column_number : 2}


	    ]);
	});
</script>

<div class="col-md-6 col-xs-12 col-md-offset-3">
<legend align="center"><marquee behavior="alternate" width="100%"><strong>Antrian Cucian Belum Selesai</strong></marquee></legend>
</div>

<div class="table-responsive">
	<table class="table table-bordered table-hover table-striped" id="terlambat" style="font-size: 10px">
		<thead>
			<tr>
				<th>Tgl Masuk</th>				
				<th>Nomor Nota</th>
				<th>Jenis</th>
				<th>Nama Customer</th>
				<th>SPK</th>
				<th>Check-in</th>
				<th>Cuci</th>
				<th>Setrika</th>
				<th>Packing</th>
				<th>Hari</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$jam = date('Y-m-d H:i:s');
		$query = mysqli_query($con, "SELECT tgl_input,tgl_spk,tgl_workshop,tgl_cuci,tgl_setrika,tgl_packing,no_nota,nama_customer,jenis,datediff('$jam',tgl_input) AS terlambat FROM reception WHERE kembali=false AND tgl_so='0000-00-00 00:00:00' AND rijeck=false AND nama_outlet='$_SESSION[outlet]' AND cara_bayar<>'Void' GROUP BY tgl_input,no_nota ORDER BY tgl_input");
		while($data = mysqli_fetch_array($query)){
			?>		
			<tr>

				<td><?php echo $data['tgl_input'] ?></td>
				<td><?php echo $data['no_nota'] ?></td>
				<td><?php if($data['jenis']=='k') echo "Kiloan"; else echo "Potongan"; ?></td>
				<td><?php echo $data['nama_customer'] ?></td>
				<td><?php if($data['tgl_spk']=='0000-00-00 00:00:00') echo "Belum"; else echo $data['tgl_spk']; ?></td>
				<td><?php if($data['tgl_workshop']=='0000-00-00 00:00:00') echo "Belum"; else echo $data['tgl_workshop']; ?></td>
				<td><?php if($data['tgl_cuci']=='0000-00-00 00:00:00') echo "Belum"; else echo $data['tgl_cuci']; ?></td>
				<td><?php if($data['tgl_setrika']=='0000-00-00 00:00:00') echo "Belum"; else echo $data['tgl_setrika']; ?></td>
				<td><?php if($data['tgl_packing']=='0000-00-00 00:00:00') echo "Belum"; else echo $data['tgl_packing']; ?></td>
				<td><?php echo $data['terlambat'] ?></td>
			</tr>
		<?php
		}
		?>
		</tbody>
	</table>
</div>