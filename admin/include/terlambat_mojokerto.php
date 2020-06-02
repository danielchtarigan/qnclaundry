<script type="text/javascript">
		$(document).ready(function(){
			$('#kiloan2').dataTable({
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
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
                     if ( aData[10] >= "24:00:00" && aData[1] != "belum" )
                    {
                        $('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');

                    }
                    if( aData[10] >= "48:00:00" && aData[1] != "belum" ){
				 	  $('td', nRow).css('background-color', 'red').css('color', 'white').css('font-weight', 'bold');
		    }
		    if ( aData[1] == "belum" && aData[10] >= "05:00:00" )
                    {
                        $('td', nRow).css('background-color', '#cc3399').css('color', 'black').css('font-weight', 'bold');

                    }
                   }

			}).yadcf([



	    {column_number : 2}


	    ]);
$('#potongan2').dataTable({
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
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
                        "searchable": true,"width":"5%",
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets": 1 },
                ],
                "bAutoWidth": false,
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                     if ( aData[10] >= "24:00:00" && aData[1] != "belum" )
                    {
                        $('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');

                    }
                    if( aData[10] >= "48:00:00" && aData[1] != "belum" ){
				 	  $('td', nRow).css('background-color', 'red').css('color', 'white').css('font-weight', 'bold');
		    }

		    if ( aData[1] == "belum" && aData[10] >= "05:00:00" )
                    {
                        $('td', nRow).css('background-color', '#cc3399').css('color', 'black').css('font-weight', 'bold');

                    }
                   }

			}).yadcf([


	    {column_number : 2}


	    ]);



		});
	</script>

<fieldset>
<legend align="center" ><marquee behavior=alternate  width="800"><strong>Kiloan Belum di Packing dan Belum Kembali</strong></marquee></legend>
<table id="kiloan2" class="display" style="font-size:12px">
		<thead>
		<tr>
			<th>Tgl Masuk</th>
			<th>Tanggal SPK</th>
			<th>Outlet</th>
			<th>Nota</th>
			<th>Total Harga</th>
			<th>Resepsionis</th>
			<th>Nama Customer</th>
			<th>Express</th>		
			<th>Tgl Cuci</th>
			<th>Tgl Packing</th>
			<th>Time</th>			
		</tr>
		</thead>
		<tbody>
			<?php

			$outlet=$_SESSION['nama_outlet'];

			$query = "SELECT express,nama_reception,total_bayar,tgl_spk,nama_outlet,tgl_input,no_nota,nama_customer,tgl_cuci,tgl_packing,timediff('$jam',tgl_input) as terlambat FROM reception WHERE packing=false and kembali=false and tgl_so='0000-00-00 00:00:00' and jenis='k' and rijeck=false and nama_outlet='mojokerto' ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);


			while($data = mysqli_fetch_array($tampil)){
				?>
				<tr>           
					<td><?php echo $data['tgl_input'];?></td>
					<td>
						<?php		       
						if($data['tgl_spk']<>"0000-00-00 00:00:00")
					       {
						   echo ''.$data['tgl_spk'].'';
					       }
					       else
						   {
						   echo 'belum';
					       };
						  ?>
					</td>
					<td><?php echo $data['nama_outlet'] ;?> </td>
					<td><?php echo $data['no_nota'];?></td>
					<td><?php echo $data['total_bayar'];?></td>
					<td><?php echo $data['nama_reception'];?></td>
					<td><?php echo $data['nama_customer'];?></td>
					<td><?php if ($data['express']==1) echo 'Express'; else if ($data['express']==2) echo 'Double Express'; else if ($data['express']==3) echo 'Super Express'; ?>
					</td>				
					<td><?php		       
						if($data['tgl_cuci']<>"0000-00-00 00:00:00")
					       {
						   echo ''.$data['tgl_cuci'].'';
					       }
					       else
						   {
						   echo 'belum';
					       };
						 ?>
                    </td>
                    <td><?php		       
                    	if($data['tgl_packing']<>"0000-00-00 00:00:00")
					       {
						   echo ''.$data['tgl_packing'].'';
					       }
					       else
						   {
						   echo 'belum';
					       };
			  			?>
			  		</td>
			  		<td><?php echo $data['terlambat'] ?></td>			  			  		
				</tr>
				<?php } ?>
		</tbody>
	</table>
	</fieldset>

<fieldset>
<legend align="center" ><marquee behavior=alternate  width="800"><strong>Potongan Belum di Packing dan Belum Kembali</strong></marquee></legend>
<table id="potongan2" class="display" style="font-size:12px">
		<thead>
		<tr>
			<th>Tgl Masuk</th>
			<th>Tanggal SPK</th>
			<th>Outlet</th>
			<th>Nota</th>
			<th>Total Harga</th>
			<th>Resepsionis</th>
			<th>Nama Customer</th>
			<th>Express</th>		
			<th>Tgl Cuci</th>
			<th>Tgl Packing</th>
			<th>Time</th>			
		</tr>
		</thead>
		<tbody>
			<?php

			$outlet=$_SESSION['nama_outlet'];

			$query = "SELECT express,nama_reception,total_bayar,tgl_spk,nama_outlet,tgl_input,no_nota,nama_customer,tgl_cuci,tgl_packing,timediff('$jam',tgl_input) as terlambat FROM reception WHERE packing=false and kembali=false and tgl_so='0000-00-00 00:00:00' and jenis='p' and rijeck=false and nama_outlet='mojokerto' ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);


			while($data = mysqli_fetch_array($tampil)){
				?>
				<tr>           
					<td><?php echo $data['tgl_input'];?></td>
					<td>
						<?php		       
						if($data['tgl_spk']<>"0000-00-00 00:00:00")
					       {
						   echo ''.$data['tgl_spk'].'';
					       }
					       else
						   {
						   echo 'belum';
					       };
						  ?>
					</td>
					<td><?php echo $data['nama_outlet'] ;?> </td>
					<td><?php echo $data['no_nota'];?></td>
					<td><?php echo $data['total_bayar'];?></td>
					<td><?php echo $data['nama_reception'];?></td>
					<td><?php echo $data['nama_customer'];?></td>
					<td><?php if ($data['express']==1) echo 'Express'; else if ($data['express']==2) echo 'Double Express'; else if ($data['express']==3) echo 'Super Express'; ?>
					</td>				
					<td><?php		       
						if($data['tgl_cuci']<>"0000-00-00 00:00:00")
					       {
						   echo ''.$data['tgl_cuci'].'';
					       }
					       else
						   {
						   echo 'belum';
					       };
						 ?>
                    </td>
                    <td><?php		       
                    	if($data['tgl_packing']<>"0000-00-00 00:00:00")
					       {
						   echo ''.$data['tgl_packing'].'';
					       }
					       else
						   {
						   echo 'belum';
					       };
			  			?>
			  		</td>
			  		<td><?php echo $data['terlambat'] ?></td>			  				  		
				</tr>
				<?php } ?>
		</tbody>
	</table>
	</fieldset>