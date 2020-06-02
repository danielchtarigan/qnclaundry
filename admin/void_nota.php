<?php
include '../config.php';
include 'head.php';
?>
<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#voidnota td a.delete').click(function()
		{
			if (confirm("Are you sure you want to delete this row?"))
			{
				var id = $(this).parent().parent().attr('id');
				var data = 'id=' + id ;
				var parent = $(this).parent().parent();

				$.ajax(
				{
					   type: "POST",
					   url: "del_order_rcp.php",
					   data: data,
					   cache: false,
					
					   success: function()
					   {
							parent.fadeOut('slow', function() {$(this).remove();});
					   }
				 });				
			}
		});
		
		// style the table with alternate colors
		// sets specified color for every odd row
		$('table#voidnota tr:odd').css('background',' #FFFFE0');
	});
	
</script>										
										
										<a class="btn btn-info btn-sm active" href="report_void.php" role="button">Kembali untuk verifikasi</a>												
											<div id="konfirm-box"> Apakah Anda yakin akan menghapus ini?</div>										
												<div class="table-responsive" style="overflow-x:auto;">
													<table class="table table-border table-hover" id="voidnota" style="font-size: 10px">
														<thead>
														<tr>
															
															<th>Tgl Masuk</th>
															<th>No Nota</th>
															<th>Nama Customer</th>
															<th>total</th>
															<th>RCP</th>
															<th>Lunas</th>
															<th>No faktur</th>
															<th>Tgl Cuci</th>															
															<th>Tgl Packing</th>
															<th>Tgl Kembali</th>
															<th>Reject</th>
															<th>VOID</th>

														</tr>
														</thead>
														<tbody>
															<?php
															$qvoid = mysqli_query($con, "SELECT *FROM nota_void WHERE status=0 ORDER BY tanggal");																													
															WHILE($void = mysqli_fetch_array($qvoid)){
															$nota = $void['no_nota'];
															$query = "SELECT total_bayar,nama_reception,lunas,no_faktur,id,tgl_input,no_nota,nama_customer,tgl_cuci,tgl_packing,tgl_kembali,rijeck FROM reception where no_nota='$nota' AND cara_bayar='Void' ORDER BY tgl_input LIMIT 5" ;
															$tampil = mysqli_query($con, $query);
															
															while($data = mysqli_fetch_array($tampil)){
																	 ?>
																<tr id="<?php echo $data['id'] ; ?>">
																		<td><?php echo $data['tgl_input'] ; ?></td>
																		<td><?php echo $data['no_nota']; ?></td>
																		<td><?php echo $data['nama_customer']; ?></td>
                        												<td><?php echo $data['total_bayar']; ?></td>
                        												<td><?php echo $data['nama_reception']; ?></td>
                        												<td><?php echo $data['lunas']; ?></td>
                        												<td><?php echo $data['no_faktur']; ?></a></td>
																		<td><?php		       if($data['tgl_cuci']<>"0000-00-00 00:00:00")
															   {
															   echo ''.$data['tgl_cuci'].'';
															   }
															   else
															   {
															   echo '-';
															   };
															  ?>
															   
															  
																								</td>
																		
																		
																		
																		<td><?php		       if($data['tgl_packing']<>"0000-00-00 00:00:00")
															   {
															   echo ''.$data['tgl_packing'].'';
															   }
															   else
															   {
															   echo '-';
															   };
															  ?></td>
																		
															
															<td><?php		       if($data['tgl_kembali']<>"0000-00-00 00:00:00")
															   {
															   echo ''.$data['tgl_kembali'].'';
															   }
															   else
															   {
															   echo '-';
															   };
															  ?></td>
															  <td><?php if($data['rijeck']==1) echo "Reject"; else echo "-" ?></td>
																<td>
																<a href="#" class="delete" style="color:#FF0000;"><img alt="" align="absmiddle" border="0"  />hapus</a>
																</td>
																
																		 </tr>
																			<?php }
															}																			
												 ?>   
														</tbody>
													</table>
	    <script>
	 $(function () {
//Box Konfirmasi Hapus
            $('#konfirm-box').dialog({
                modal: true,
                autoOpen: false,
                show: "Bounce",
                hide: "explode",
                title: "Konfirmasi",
                buttons: {
  
                    "Ya": function () {
  jQuery.ajax({
  type: "POST",
  url: "del_order_rcp.php",
  data: 'id=' +id,
  success: function(){
  $('#'+id).animate({ backgroundColor: "#fbc7c7" }, "fast")
  .animate({ opacity: "hide" }, "slow");
  }
  });
                    $(this).dialog("close");
                    },
 
                    "Batal": function () {
  //jika memilih tombol batal
                    $(this).dialog("close");
   
                    }
                }
            });
 
//Tombol hapus diklik
            $('.hapus').click(function () {
                $('#konfirm-box').dialog("open");
 //ambil nomor id
                id = $(this).attr('id');
            });
        });
</script>
												</div>
											</div>
										</div>


	


<script type="text/javascript">
		$(document).ready(function(){
			oTable = $('#voidnota').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    }

	    
	    ]);
	    
	    
	    
			
		});
	</script>
	
