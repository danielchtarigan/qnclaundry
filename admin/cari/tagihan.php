

<div class="col-md-6">
<button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#petunjuk">Pilih Tanggal</button>

<div class="modal fade" id="petunjuk" tabindex="-1" role="dialog" aria-labelledby="isi petunjuk">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-tittle"  id="isiPetunjuk">Tagihan</h3>
					</div>
					<div class="modal-body">
						<h4>Pencarian Tanggal</h4>
							<form class="form-inline" method="post" action="tagihan_order.php">
								<div class="form-group">
									<label for="date">Dari</label>
									<input type="date" class="form-control" name="tgl" id="tgl" placeholder="tanggal" required="true">
								</div>							
								<div class="form-group">
									<label for="date2">Sd</label>
									<input type="date" class="form-control" name="tgl2" id="tgl2" placeholder="tanggal" required="true">
								</div>
								<button type="submit" class="btn btn-succes" value="cari">Cari</button>
							</form>
					</div>
			</div>
		</div>
</div>
</div>

<br>

<?php
date_default_timezone_set('Asia/Makassar');
$date = date("Y-m-d");
?>

	

				<div class="col-lg-12 col-md-offset-0">
					<div class="panel panel-default">
						<div class="panel-heading"><strong>Order Piutang Hari ini!</strong></div>
							<div class="panel-body">								
								<div class="table-responsive">
									<table class="table table-bordered table-hover table-condensed table-stripped" id="order">
										<thead>
											<tr>
												<th>Tanggal Masuk</th>												
												<th>Nama Customer</th>
												<th>Alamat</th>
												<th>Nota Order</th>												
												<th style="text-align:right">Total Harga</th>
												<th>Order Oleh</th>
												<th>Outlet</th>
												<th>Pilih Cetak</th>
											</tr>
										</thead>
										<tbody>
										
										<?php
																												
																
												$qtgh = mysqli_query($con, "SELECT * FROM reception WHERE tgl_input like '%$date%' and lunas=0 and nama_outlet<>'mojokerto'");																	
												while($ntgh = mysqli_fetch_array($qtgh)){													
													
												
											?>
											 <tr class="odd gradeX">
												<td><?php echo $date;?></td>
												<td><?php echo $ntgh['nama_customer'];?></td>										
												<td><?php 
													$qcust = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM customer WHERE id='$ntgh[id_customer]'"));
													echo $qcust['alamat'];?></td>
												<td><?php echo $ntgh['no_nota'];?></td>												
												<td style="text-align:right"><?php echo rupiah($ntgh['total_bayar']);?></td>
												<td><?php echo $ntgh['nama_reception'];?></td>
												<td><?php echo $ntgh['nama_outlet'];?></td>
												<td>												
													<a href="struk/struk.php?no_nota=<?php echo $ntgh['no_nota'];?>" target="_blank">cetak
												</td>
										
											</tr>
											<?php																
																													
														}													
																									
												?>
															
										</tbody>
									</table>
								</div>
								
								

							</div>						
					</div>
				</div>	


