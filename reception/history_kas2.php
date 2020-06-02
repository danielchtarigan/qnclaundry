<?php
date_default_timezone_set('Asia/Makassar');
$date = date("Y-m-d");

$us = $_SESSION['user_id'];
?>

				<div class="col-lg-12 col-md-offset-0">
					<strong>History Kas Hari Ini</strong>
						<div class="panel panel-default">						
							<div class="panel-body">							
								<div class="table-responsive">
									<table class="table table-condensed table-stripped" id="history">
										<thead>
											<tr>
												<th>Date</th>
												<th>Receptionist</th>
												<th>Kas Order</th>
												<th>Kas Deposit</th>
												<th>Kas Membership</th>												
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$ro= mysqli_query($con, "select DATE_FORMAT(tanggal_input, '%Y-%m-%d') as tanggal, sum(jumlah) as korder,resepsionis from cara_bayar where resepsionis='$us' and DATE_FORMAT(tanggal_input, '%Y-%m-%d')='$date' and (cara_bayar='Cash' or cara_bayar='cash')");
												WHILE($to = mysqli_fetch_array($ro)){
												?>
													<tr>
														<td><?php echo $date;?></td>
														<td><?php echo $to['resepsionis'];?></td>
														<td><?php echo rupiah ($to['korder']);?></td>
														<td><?php
															$rd = mysqli_query($con, "select sum(total) as deposit from faktur_penjualan where (date_format(tgl_transaksi, '%Y-%m-%d'))='$date' and rcp='$to[resepsionis]' and jenis_transaksi='deposit' and cara_bayar='cash'");
															$td = mysqli_fetch_array($rd);
															echo rupiah ($td['deposit']);?>
														</td>
														<td><?php
															$rm = mysqli_query($con, "select sum(total) as membership from faktur_penjualan where (date_format(tgl_transaksi, '%Y-%m-%d'))='$date' and rcp='$to[resepsionis]' and jenis_transaksi='membership' and cara_bayar='cash'");
															$tm = mysqli_fetch_array($rm);
															echo rupiah ($tm['membership']);?>
														</td>
														<td><?php $tot = $to['korder']+$td['deposit']+$tm['membership'];
															echo rupiah ($tot);?>
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