	

<div class="col-md-6">
<button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#petunjuk">Pilih Tanggal</button>

<div class="modal fade" id="petunjuk" tabindex="-1" role="dialog" aria-labelledby="isi petunjuk">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-tittle"  id="isiPetunjuk">Corporate</h3>
					</div>
					<div class="modal-body">
						<h4>Pencarian Tanggal</h4>
							<form class="form-inline" method="post" action="order_corporate.php">
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
$tl = date("Y/m/d");
?>

				<div class="col-lg-12 col-md-offset-0">
					<div class="panel panel-default">
						<div class="panel-heading"><strong>Order Corporate Hari ini</strong></div>
							<div class="panel-body">							
								<div class="table-responsive">
									<table class="table table-condensed table-stripped" id="order">
										<thead>
											<tr>
												<th>Tanggal Masuk</th>
												<th>Nama Hotel</th>
												<th>Order Oleh</th>
												<th>Nomor Order</th>
												<th style="text-align:right">Jumlah Item</th>
												<th style="text-align:right">Total Bayar</th>
											</tr>
										</thead>
										<tbody>
										
										<?php
														$q1 = mysqli_query($con, "select * from corp_hotel_table");
														while($rq1 = mysqli_fetch_array($q1)){
														$opr = mysqli_query($con, "select * from corp_user");													
														while ($ropr = mysqli_fetch_array($opr)){
																
																
												$ord = mysqli_query($con, "select DATE_FORMAT(created, '%Y/%m/%d') as tgl,order_number,id,total_payment,id_hotel,creator_id from corp_order_list where id_hotel='$rq1[id]' and creator_id='$ropr[id]' and DATE_FORMAT(created, '%Y/%m/%d')='$tl' order by created limit 10 ");							
																					
												while($nord = mysqli_fetch_array($ord)){
												$hotel = $rq1['name'];
												$user = $ropr['username'];
												$tanggal =$nord['tgl'];
												$numb = $nord['order_number'];
												$tot = $nord['total_payment'];										
												
											?>
											 <tr>
												<td><?php echo $tanggal;?></td>
												<td><?php echo $hotel;?></td>										
												<td><?php echo $user;?></td>
												<td><?php echo $numb;?></td>
												<td style="text-align:right"><?php 
												$jitem = mysqli_fetch_array(mysqli_query($con, "select sum(quantity) as jumlah from corp_order_item where id_order_list='$nord[id]'"));										
												echo $jitem['jumlah'];?></td>
												<td style="text-align:right"><?php echo rupiah($tot);?></td>
										
											</tr>
											<?php
																
															}
														
														}
														}												
														
												
												?>
															
										</tbody>
									</table>
								</div>
							</div>
						<div class="panel-footer"></em><i>&copy; corp.qnclaundry.com</i></em></div>
					</div>
				</div>

