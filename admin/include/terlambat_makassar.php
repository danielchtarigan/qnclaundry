<ul class="nav nav-tabs">
	<li class="nav-item active" role="presentation"><a class="nav-link active" role="tab" data-toggle="tab" href="#opr">Versi Operasional</a></li>
	<li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-toggle="tab" href="#rcp">Versi Receptionist</a></li>
</ul>

<div class="tab-content">
		
	<div id="opr" role="tabpanel" class="tab-pane active">
		<script type="text/javascript">
				$(document).ready(function(){
					$('#expressopr').dataTable({
						"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
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
		                    },  { "width": "5px", "targets": [0] },{ "width": "5px", "targets": 1 },
		                ],
		                "bAutoWidth": false,


						"bJQueryUI" : true,
						"sPaginationType" : "full_numbers",
						"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
						"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		                     if ( aData[12] >= "24" && aData[1] != "belum" )
		                    {
		                        $('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');

		                    }
		                    if( aData[12] >= "48" && aData[1] != "belum" ){
						 	  $('td', nRow).css('background-color', 'red').css('color', 'white').css('font-weight', 'bold');
				    }
				    if ( aData[1] == "belum" && aData[12] >= "05" )
		                    {
		                        $('td', nRow).css('background-color', '#cc3399').css('color', 'black').css('font-weight', 'bold');

		                    }
		                   }

					}).yadcf([



			    {column_number : 2}


			    ]);
		$('#potongan').dataTable({
						"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
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
		                        "searchable": true,"width":"5%",
		                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets": 1 },
		                ],
		                "bAutoWidth": false,
						"bJQueryUI" : true,
						"sPaginationType" : "full_numbers",
						"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
						"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
    	                    if ( aData[12] >= "24" && aData[1] != "belum" )
        	                    {
        	                        $('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');
        
        	                    }
        	                    if( aData[12] >= "48" && aData[1] != "belum" ){
        					 	  $('td', nRow).css('background-color', 'red').css('color', 'white').css('font-weight', 'bold');
        			            }
    
        				    if ( aData[1] == "belum" && aData[12] >= "05" )
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
		<table id="expressopr" class="display" style="font-size:11px">
				<thead>
				<tr>
					<th>Tgl Masuk</th>
					<th>tgl spk</th>
					<th>Outlet</th>
					<th>Nota</th>
					<th>Total</th>
					<th>Rcp</th>
					<th>Nama</th>
					<th>Express</th>
					<th>Priority</th>			
					<th>Check In</th>
					<th>Cuci</th>
					<th>Setrika</th>
					<th>Time</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
					<?php

					$outlet=$_SESSION['nama_outlet'];

					$query = "SELECT express,workshop,priority,nama_reception,total_bayar,tgl_spk,nama_outlet,tgl_input,no_nota,nama_customer,tgl_workshop,tgl_cuci,tgl_setrika,timediff('$jam',tgl_input) as terlambat FROM reception WHERE packing=false and kembali=false and tgl_so='0000-00-00 00:00:00' and jenis='k' and rijeck=false  and nama_outlet<>'mojokerto' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' ORDER BY tgl_input" ;
					$tampil = mysqli_query($con, $query);


					while($data = mysqli_fetch_array($tampil)){
					    $qoperator = mysqli_query($con, "SELECT op_cuci FROM reception WHERE tgl_cuci LIKE '%$kemarin%' AND jenis='k' AND workshop='$data[workshop]' ");
						$dataop = mysqli_fetch_row($qoperator);
						$op = $dataop[0];

						$qpacker = mysqli_query($con, "SELECT user_packing FROM reception WHERE tgl_packing LIKE '%$kemarin%' AND workshop='$data[workshop]' ");
						$datapk = mysqli_fetch_row($qpacker);
						$pack = $datapk[0];
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
							<td><a href="#" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?php echo $data['no_nota'];?></a></td>
							<td><?php echo $data['total_bayar'];?></td>
							<td><?php echo $data['nama_reception'];?></td>
							<td><?php echo $data['nama_customer'];?></td>
							<td><?php if ($data['express']==1) echo 'Express'; else if ($data['express']==2) echo 'Double Express'; else if ($data['express']==3) echo 'Super Express'; ?>
							</td>
							<td><?php if ($data['priority']==1) echo 'Priority';?></td>	
							<td>
								<?php 
								if($data['tgl_workshop']<>"0000-00-00 00:00:00")
								    {
									echo ''.$data['tgl_workshop'].'';
								    }
								    else
									{
									echo 'belum';
								    };
								?>
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
		                    	if($data['tgl_setrika']<>"0000-00-00 00:00:00")
							       {
								   echo ''.$data['tgl_setrika'].'';
							       }
							       else
								   {
								   echo 'belum';
							       };
					  			?>
					  		</td>
					  		<td><?php 
    						     $waktus = explode(":",$data['terlambat']); 
						        echo $waktus[0].' Jam<br>'.$waktus[1].' Menit ';
    						    ?>
    						</td>
					  		<td><?php
		    					if($_SESSION['user_id']==$superAdmin){?>
		    				  		<a href="act/denda_cucian_telat.php?denda=hilangkanData&no_nota=<?php echo $data['no_nota'] ?>&operator=<?php echo $op ?>&packer=<?php echo $pack; ?>"><i class="fa fa-trash-o fa-2x" aria-hidden="true" style="color: red"></i></a><?php
		    					} else{
		    						if($data['terlambat']>"48:00:00") {?>
		    				  			<a href="act/denda_cucian_telat.php?denda=cucianTelat&no_nota=<?php echo $data['no_nota'] ?>&operator=<?php echo $op ?>&packer=<?php echo $pack; ?>"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a> 
		    				  			<?php 
		    				  		}
		    				  	}
		    				  	?>		  			 
		    				 </td>				  		
						</tr>
						<?php } ?>
				</tbody>
			</table>
			</fieldset>

		<fieldset>
		<legend align="center" ><marquee behavior=alternate  width="800"><strong>Potongan Belum di Packing dan Belum Kembali</strong></marquee></legend>
		<table id="potongan" class="display" style="font-size:11px">
				<thead>
				<tr>

					<th>TglMasuk</th>
					<th>tgl spk</th>
		            <th>Outlet</th>
					<th>Nota</th>
					<th>Total</th>
					<th>Rcp</th>
					<th>Nama</th>
					<th>Express</th>
					<th>Priority</th>
					<th>Check in</th>
					<th>Cuci</th>
					<th>Setrika</th>
					<th>Time</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
					<?php

					$outlet=$_SESSION['nama_outlet'];

					$query = "SELECT express,workshop,priority,total_bayar,nama_reception,tgl_spk,nama_outlet,tgl_input,no_nota,nama_customer,tgl_workshop,tgl_cuci,tgl_setrika,timediff('$jam',tgl_input) as terlambat, datediff('$jam',tgl_input) as terlambat2 FROM reception WHERE packing=false and kembali=false and jenis='p' and tgl_so='0000-00-00 00:00:00' and rijeck=false and nama_outlet<>'mojokerto' AND cara_bayar<>'Void' AND cara_bayar<>'Reject'  ORDER BY tgl_input" ;
					$tampil = mysqli_query($con, $query);


					while($data = mysqli_fetch_array($tampil)){
		                $qoperator = mysqli_query($con, "SELECT op_cuci FROM reception WHERE tgl_cuci LIKE '%$kemarin%' AND jenis='p' AND workshop='$data[workshop]'");
						$dataop = mysqli_fetch_row($qoperator);
						$op = $dataop[0];

						$qpacker = mysqli_query($con, "SELECT user_packing FROM reception WHERE tgl_packing LIKE '%$kemarin%' AND workshop='$data[workshop]'");
						$datapk = mysqli_fetch_row($qpacker);
						$pack = $datapk[0];



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

								<td><a href="#" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?php echo $data['no_nota'];?></a></td>
		<td><?php echo $data['total_bayar'];?></td>
		<td><?php echo $data['nama_reception'];?></td>
								<td><?php echo $data['nama_customer'];?></td>
								<td><?php if ($data['express']==1) echo 'Express'; else if ($data['express']==2) echo 'Double Express'; else if ($data['express']==3) echo 'Super Express'; ?></td>
								<td><?php if ($data['priority']==1) echo 'Priority';?></td>
								<td><?php if($data['tgl_workshop']<>"0000-00-00 00:00:00")     {
					   echo ''.$data['tgl_workshop'].'';
				       }
				       else
					   {
					   echo 'belum';
				       };
					  ?>


		                                                </td>
								<td><?php if($data['tgl_cuci']<>"0000-00-00 00:00:00")     {
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
						<td><?php 
						    $waktus = explode(":",$data['terlambat']); 
						    echo $waktus[0].' Jam<br>'.$waktus[1].' Menit ';
						    if($waktus[0]>"100") {
						        mysqli_query($con, "UPDATE reception SET potong_bonus='50' WHERE no_nota='$data[no_nota]'");
						    } else if($waktus[0]>"168") {
						        mysqli_query($con, "UPDATE reception SET potong_bonus='100' WHERE no_nota='$data[no_nota]'");
						    }
						    ?>
						</td>
					    <td><?php
							if($_SESSION['user_id']==$superAdmin){?>
						  		<a href="act/denda_cucian_telat.php?denda=hilangkanData&no_nota=<?php echo $data['no_nota'] ?>&operator=<?php echo $op ?>&packer=<?php echo $pack; ?>"><i class="fa fa-trash-o fa-2x" aria-hidden="true" style="color: red"></i></a><?php
							} else{
								if($data['terlambat']>"48:00:00") {?>
						  			<a href="act/denda_cucian_telat.php?denda=cucianTelat&no_nota=<?php echo $data['no_nota'] ?>&operator=<?php echo $op ?>&packer=<?php echo $pack; ?>"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a> 
						  			<?php 
						  		}
						  	}
						  	?>		  			 
						 </td>	



					</tr>

				<?php }
		 ?>
				</tbody>
			</table>
		</fieldset>	    

	    
	</div>

	<div id="rcp" role="tabpanel" class="tab-pane">	
		<?php include 'data_terlambat_rcp.php'; ?>
	</div>		
	
</div>

<div class="modal fade" id="rincian_order" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="rincian">
				
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	$('.data-order').click(function(){
		var order = $(this).attr('id');
		$.ajax({
			url 	: 'rincian_order.php',
			data 	: 'order='+order,
			success : function(data){
				$('.rincian').html(data);
			}
		})
	})
</script>