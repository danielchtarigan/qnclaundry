<?php
include '../config.php';
include 'head.php';

?>

<div class="col-lg-12 col-md-offset-0">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-xs-12 col-xs-12">
			   <h4>Daftar Customer yang telah Aktif Harga Khusus</h4><br>
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<tr>
							    <th>ID Customer</th>
								<th>Nama Customer</th>
								<th>Nomor Telepon</th>
								<th>Type Customer</th>
								<th>Matikan</th>
								<th>Transaksi 30 Hari Terakhir</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<?php
			$qkhusus = mysqli_query($con, "select * from customer where `type_c`= '1' OR `type_d` = '1' ");
			

			
			while($hk = mysqli_fetch_array($qkhusus)){
				if(($hk['type_c']==1)||($hk['type_d']==1)){	
				        $userId = $hk['id'];
	        			$query = mysqli_query($con, "select count(`id`) from `reception` where `id_customer` = $userId AND `tgl_input` BETWEEN NOW() - INTERVAL 30 DAY AND NOW()");
			            $transaksi = mysqli_fetch_array($query);

								?>
								<td><?php echo $hk['id'];?></td>
								<td><?php echo $hk['nama_customer'];?></td>
								<td><?php echo $hk['no_telp'];?></td>
								<td><?php if(($hk['type_c']==1)&&($hk['type_d']==0)) echo "Type C"; elseif(($hk['type_c']==0)&&($hk['type_d']==1)) echo "Type D"?></td>
								<td><?php 
									if(($hk['type_c']==1)&&($hk['type_d']==0)){
										?>
										<a href="act/customerc.php?id=<?php echo $hk['id']; ?>&type_c=<?php echo $hk['type_c']; ?>" ><button type="button" class="btn btn-default btn-xs;">OFF</button></a>
										<?php
										}
									elseif(($hk['type_c']==0)&&($hk['type_d']==1)){
										?>
										<a href="act/customerd.php?id=<?php echo $hk['id']; ?>&type_d=<?php echo $hk['type_d']; ?>" ><button type="button" class="btn btn-default btn-xs;">OFF</button></a>
										<?php
										}
										?>
								</td>
								<td><?php echo $transaksi[0]?></td>
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
	</div>
</div>
			