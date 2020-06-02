
		    
<script type="text/javascript">
	$(document).ready(function(){
		$('#expressrcp').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
            tableTools: {
                "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                "aButtons": [
                    {
                        "sExtends": "copy",
                        "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11],
                        "oSelectorOpts": { filter: "applied", order: "current" }
                    },
                    {
                        'sExtends': 'xls',
                        "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11],
                        "oSelectorOpts": { filter: 'applied', order: 'current' }
                    },
                    
                    {
                        'sExtends': 'print',
                        "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11],
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
                 if ( aData[11] >= "24:00:00" )
                {
                    $('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');
                    
                }
                if( aData[11] >= "48:00:00" ){
			 	  $('td', nRow).css('background-color', 'red').css('color', 'white').css('font-weight', 'bold');
				} 
               }
			
		}).yadcf([
    

   
    {column_number : 2}
    
    
    ]);
$('#potonganrcp').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
            tableTools: {
                "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                "aButtons": [
                    {
                        "sExtends": "copy",
                        "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11],
                        "oSelectorOpts": { filter: "applied", order: "current" }
                    },
                    {
                        'sExtends': 'xls',
                        "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11],
                        "oSelectorOpts": { filter: 'applied', order: 'current' }
                    },
                    
                    {
                        'sExtends': 'print',
                        "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11],
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
                 if ( aData[11] >= "24:00:00" )
                {
                    $('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');
                    
                }
                if( aData[11] >= "48:00:00" ){
			 	  $('td', nRow).css('background-color', 'red').css('color', 'white').css('font-weight', 'bold');
				}
               }
			
		}).yadcf([
   
   
    {column_number : 2}
    
    
    ]);
		
		
		
	});
</script>

<fieldset>
<legend align="center" ><marquee behavior=alternate  width="800"><strong>Kiloan Belum Kembali dan Belum SO</strong></marquee></legend> 
<table id="expressrcp" class="display" style="font-size: 11px">
	<thead>
	<tr>
		
		<th>Tgl Masuk</th>
		<th>tgl spk</th>
<th>Outlet</th>
		<th>Nota</th>
<th>Total</th>
<th>Rcp</th>
		<th>Nama</th>
		<th>Cuci</th>
		<th>Setrika</th>
		<th>Packing</th>
		<th>tglSo</th>
		<th>Time</th>
		
		
		
	</tr>
	</thead>
	<tbody>
		<?php

		

		$query = "SELECT nama_reception,total_bayar,tgl_spk,tgl_so,nama_outlet,tgl_input,tgl_packing,no_nota,nama_customer,tgl_cuci,tgl_setrika,timediff('$jam', tgl_input) as terlambat FROM reception where kembali=false and jenis='k' and nama_outlet <> 'mojokerto' and rijeck=false and tgl_so='0000-00-00 00:00:00' ORDER BY tgl_input" ;
		$tampil = mysqli_query($con, $query);
		
		
		while($data = mysqli_fetch_array($tampil)){
			
			
			
			
			?>
			<tr>           <td><?php echo $data['tgl_input'];?></td>
			<td><?php		       if($data['tgl_spk']<>"0000-00-00 00:00:00")
	       {
		   echo ''.$data['tgl_spk'].'';
	       }
	       else
		   {
		   echo 'belum';
	       };
		  ?></td>
					<td><?php echo $data['nama_outlet'] ;?> </td>
					
					<td><?php echo $data['no_nota'];?></td>
<td><?php echo $data['total_bayar'];?></td>
<td><?php echo $data['nama_reception'];?></td>
					<td><?php echo $data['nama_customer'];?></td>
					<td><?php		       if($data['tgl_cuci']<>"0000-00-00 00:00:00")
	       {
		   echo ''.$data['tgl_cuci'].'';
	       }
	       else
		   {
		   echo 'belum';
	       };
		  ?>
	       
	      
                                            </td>
                                            <td><?php		       if($data['tgl_setrika']<>"0000-00-00 00:00:00")
	       {
		   echo ''.$data['tgl_setrika'].'';
	       }
	       else
		   {
		   echo 'belum';
	       };
		  ?></td>
		  			<td><?php		       if($data['tgl_packing']<>"0000-00-00 00:00:00")
	       {
		   echo ''.$data['tgl_packing'].'';
	       }
	       else
		   {
		   echo 'belum';
	       };
		  ?></td>
		   <td><?php		       if($data['tgl_so']<>"0000-00-00 00:00:00")
	       {
		   echo ''.$data['tgl_so'].'';
	       }
	       else
		   {
		   echo 'belum';
	       };
		  ?></td>
		  <td><?php echo $data['terlambat']; ?></td>
		
		  
		    
					
					</tr>
		
					<?php } 
?> 
	</tbody>
</table>
</fieldset>

<fieldset>
<legend align="center" ><marquee behavior=alternate  width="800"><strong>Potongan Belum di Packing dan Belum Kembali</strong></marquee></legend> 
<table id="potonganrcp" class="display">
	<thead>
	<tr>
		
		<th>TglMasuk</th>
		<th>tgl spk</th>
                     <th>Outlet</th>
		<th>Nota</th>
<th>Total</th>
<th>Rcp</th>

		<th>Nama</th>
		<th>Cuci</th>
		<th>Setrika</th>
		<th>Packing</th>
		<th>tglSo</th>
		<th>Time</th>
		
		
		
	</tr>
	</thead>
	<tbody>
		<?php

	

		$query = "SELECT total_bayar,nama_reception,tgl_spk,tgl_so,nama_outlet,tgl_input,tgl_packing,no_nota,nama_customer,tgl_cuci,tgl_setrika,timediff('$jam', tgl_input) as terlambat FROM reception where kembali=false and jenis='p' and nama_outlet <> 'mojokerto' and rijeck=false and tgl_so='0000-00-00 00:00:00'  ORDER BY tgl_input" ;
		$tampil = mysqli_query($con, $query);
		
		
		while($data = mysqli_fetch_array($tampil)){
			
			
			
			
			?>
			<tr>           <td><?php echo $data['tgl_input'];?></td>
			<td><?php		       if($data['tgl_spk']<>"0000-00-00 00:00:00")
	       {
		   echo ''.$data['tgl_spk'].'';
	       }
	       else
		   {
		   echo 'belum';
	       };
		  ?></td>
					<td><?php echo $data['nama_outlet'] ;?> </td>
					
					<td><?php echo $data['no_nota'];?></td>
<td><?php echo $data['total_bayar'];?></td>
<td><?php echo $data['nama_reception'];?></td>
					<td><?php echo $data['nama_customer'];?></td>
					<td><?php		       if($data['tgl_cuci']<>"0000-00-00 00:00:00")
	       {
		   echo ''.$data['tgl_cuci'].'';
	       }
	       else
		   {
		   echo 'belum';
	       };
		  ?>
	       
	      
                                            </td>
                                            <td><?php		       if($data['tgl_setrika']<>"0000-00-00 00:00:00")
	       {
		   echo ''.$data['tgl_setrika'].'';
	       }
	       else
		   {
		   echo 'belum';
	       };
		  ?></td>
		  			<td><?php		       if($data['tgl_packing']<>"0000-00-00 00:00:00")
	       {
		   echo ''.$data['tgl_packing'].'';
	       }
	       else
		   {
		   echo 'belum';
	       };
		  ?></td>
		   <td><?php		       if($data['tgl_so']<>"0000-00-00 00:00:00")
	       {
		   echo ''.$data['tgl_so'].'';
	       }
	       else
		   {
		   echo 'belum';
	       };
		  ?></td>
		  <td><?php echo $data['terlambat'] ?></td>
		
		  
		    
					
					</tr>
		
					<?php } 
?> 
	</tbody>
</table>
</fieldset>