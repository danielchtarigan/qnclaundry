<?php
include '../config.php';
include 'head.php';

?>	

<script type="text/javascript">
	$(document).ready(function(){
		$('#void').dataTable({
			"order": [[0,"desc"]],
			"columnDefs": [
             	{                 	
                 	"visible": true,
                 	"searchable": true,"width":"5%",
            	 },  { "width": "12%", "targets": 0 }, { "width": "10%", "targets": [1] },{ "width": "10%", "targets": 2 }, { "width": "10%", "targets": 4 },{ "width": "10%", "targets": 5 },{ "width": "8%", "targets": 7 }, { "width": "8%", "targets": 8 }
         	],         	
		})    
		$('#edit').dataTable({
			"order": [[0,"desc"]],
			"columnDefs": [
             	{                 	
                 	"visible": true,
                 	"searchable": true,"width":"5%",
            	 },  { "width": "12%", "targets": [0] }, { "width": "10%", "targets": [1] },{ "width": "10%", "targets": 2 }, { "width": "28%", "targets": 5 }, { "width": "8%", "targets": 6 }, { "width": "8%", "targets": 7 }
         	],
		})
		$('#accord').accordion({
			collapsible: true
		});        
	})									
</script>

<style type="text/css">
	.panel-body{
		background-color: #DCDCDC;
	}
	thead{
		background-color: #F8F8FF;		
	}
</style>
								
					<div class="col-md-12 col-md-offset-0" >
						<div id="accord" class="col-xs-12 col-xs-12 col-xs-offset-0">

							<h3>Void</h3>												
								
										<div class="panel-body">								
											<div class="table table-responsive ">
												<table class="table table-condensed table-hover table-bordered table-striped" id="void" style="font-size:12px;">
													<thead>
													<tr>
														<th>Tanggal</th>
														<th>Resepsionis</th>
														<th>No Nota</th>
														<th>Harga</th>
														<th>No Faktur</th>
														<th>Total Bayar</th>
														<th>Alasan</th>
														<th>Status</th>
														<th>User Void</th>													
													</tr>
													</thead>
													<tbody>
													<tr>
													
														<?php
														
														$qvoid = mysqli_query($con, "SELECT *FROM nota_void ORDER BY tanggal DESC ");
														$nvoid = mysqli_num_rows($qvoid);
														if($nvoid>0){														
														WHILE($void = mysqli_fetch_array($qvoid)){
														$ids = $void['id'];
														?>
														<td><?php echo $void['tanggal'];?></td>
														<td><?php echo $void['resepsionis'];?></td>
														<td><a class="btn btn-default btn-sm active" href="void_nota.php" role="button"><?php echo $void['no_nota'];?></a></td>
														<td><?php echo rupiah($void['harga']);?></td>
														<td><a href="d_faktur_penjualan.php" id="bayar" name="bayar" method="get" style="text-font:weight"><?php echo $void['no_faktur'];?></a></td>
														<td><?php echo rupiah ($void['total']);?></td>
														<td><?php echo $void['alasan'];?></td>
														<td><?php 														
														if ($void['status']==0){                                           
														?>
														<a href="act/verifikasi_void.php?id=<?php echo $ids; ?>" onClick="return confirm('Apakah anda telah hapus notanya dan sesuaikan pembayaran?')" ><button type="button" class="btn btn-primary btn-xs" style="background-color:#F00; border-color:#F00;" id="test" name="test">void</button></a>
														<?php
														}
														else{
															?>
													
														<button type="button" class="btn btn-info btn-circle;"><i class="fa fa-check"></i></button>
														<?php													
														}																									
														?>
														</td>
														<td><?php echo $void['user_verifikasi']; ?></td>
													</tr>
													
														<?php
														}
														}
														?>
													</tbody>


												</table>

								

											</div>
										</div>

										
							<h3>Edit Bayar</h3>								
										<div class="panel-body">								
											<div class="table-responsive">
												<table class="table table-condensed table-hover table-bordered" id="edit">
													<thead>
													<tr>
														<th>Tanggal</th>
														<th>Resepsionis</th>
														<th>No Faktur</th>
														<th>Total Bayar</th>
														<th>Cara Bayar</th>
														<th>Keterangan</th>	
														<th>Status</th>
														<th>User Edit</th>
														
													</tr>
													</thead>
													<tbody>
													<tr>
													
														<?php
														$qedit = mysqli_query($con, "SELECT *FROM edit_faktur ORDER BY tanggal DESC LIMIT 50");
														$nedit = mysqli_num_rows($qedit);
														if($nedit>0){
														WHILE($edit = mysqli_fetch_array($qedit)){
																$ids = $edit['id'];
														?>
														<td><?php echo $edit['tanggal'];?></td>
														<td><?php echo $edit['resepsionis'];?></td>
														<td><a href="d_faktur_penjualan.php" id="bayar" name="bayar" method="get" style="text-font:weight"><?php echo $edit['no_faktur'];?></a></td>
														<td><?php echo rupiah ($edit['total_bayar']);?></td>														
														<td><?php echo $edit['cara_bayar'];?></td>
														<td><?php echo $edit['keterangan'];?></td>
														<td><?php
														if ($edit['status']==0){                                           
														?>
														<a href="act/edit_faktur.php?id=<?php echo $ids; ?>" onClick="return confirm('Apakah anda sesuaikan pembayaran?')" ><button type="button" class="btn btn-primary btn-xs" style="background-color:#F00; border-color:#F00;" id="test" name="test">Edit</button></a>
														<?php
														}
														else{
															?>
													
														<button type="button" class="btn btn-info btn-circle;"><i class="fa fa-check"></i></button>
														<?php													
														}																									
														?>
														</td>
														<td><?php echo $edit['user_edit']; ?></td>
													
													</tr>
													
													<?php
														}
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>

							

