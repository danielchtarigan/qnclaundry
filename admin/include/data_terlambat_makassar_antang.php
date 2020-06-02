

	<div class="table-responsive" style="margin-top: 25px">
		<legend align="center" ><marquee behavior=alternate  width="800">Kiloan Belum di Packing dan Belum Kembali</marquee></legend>

		<div style="margin-bottom: 20px">
			<!-- ======== -->
		</div>

		<table class="table table-striped" style="font-size: 11px; width: 100%;" id="dataatg">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal Input</th>
					<th>No Order</th>
					<th class="hide"></th>
					<th>Nama Customer</th>
					<th>Total</th>
					<th>Checkin</th>
					<th>Cuci</th>
					<th>Setrika</th>
					<th>Time</th>
					<th class="hide"></th>
				</tr>
			</thead>

			<tbody>
				<?php 
				$i = 1;
				$sql = $con-> query("SELECT tgl_input, spk, no_nota, jenis,nama_customer,total_bayar,tgl_cuci,tgl_setrika,tgl_packing,timediff('$jam',tgl_input) as waktu,tgl_workshop,op_workshop, op_cuci, user_setrika, user_packing, tgl_spk, rcp_spk FROM reception WHERE jenis='k' AND nama_outlet<>'mojokerto' AND workshop='DAYA' AND kembali=false AND ambil=false AND tgl_so='0000-00-00 00:00:00' AND rijeck=false AND packing=false AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND status_order='' ORDER by tgl_input ASC");
				while($data = $sql-> fetch_array()){
					$waktus = explode(":",$data['waktu']); 

					?>
					<tr>
						<td style="vertical-align: middle; text-align: center"><?= $i ?></td>
						<td style="vertical-align: middle"><?= $data['tgl_input'] ?></td>
						<td style="vertical-align: middle;"><a href="#" style="color: black" title="Click to view" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?= $data['no_nota'];?></a></td>
						<td class="hide"><?= $data['spk'] ?></td>
						<td style="vertical-align: middle"><?= $data['nama_customer'] ?></td>
						<td style="vertical-align: middle"><?= number_format($data['total_bayar']) ?></td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_workshop']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">OP : '.$data['op_workshop'].'<br>'.$data['tgl_workshop'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_cuci']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Cuci : '.$data['op_cuci'].'<br>'.$data['tgl_cuci'].'</span>' : 'Belum';
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_setrika']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Setrika : '.$data['user_setrika'].'<br>'.$data['tgl_setrika'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 							
							echo $waktus[0].' Jam<br>'.$waktus[1].' Menit ';
							?>
						</td>
						<td class="hide"><?= $waktus[0]; ?></td>
					</tr>

					<?php $i++;
				}


				?>
			</tbody>
		</table>
	</div>

	<div class="table-responsive" style="margin-top: 25px; border-top: 2px solid black">
		<legend align="center" style="margin-top: 25px"><marquee behavior=alternate  width="800">Potongan Belum di Packing dan Belum Kembali</marquee></legend>

		<div style="margin-bottom: 20px">
			<!-- ====== -->
		</div>

		<table class="table table-striped" style="font-size: 11px; width: 100%;" id="dataatgpotongan">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal Input</th>
					<th>No Order</th>
					<th class="hide"></th>
					<th>Nama Customer</th>
					<th>Total</th>
					<th>Checkin</th>
					<th>Cuci</th>
					<th>Setrika</th>
					<th>Time</th>
					<th class="hide"></th>
				</tr>
			</thead>

			<tbody>
				<?php 
				$i = 1 ;
				$sql = $con-> query("SELECT tgl_input, spk, no_nota, jenis,nama_customer,total_bayar,tgl_cuci,tgl_setrika,tgl_packing,timediff('$jam',tgl_input) as waktu, tgl_workshop,op_workshop, op_cuci, user_setrika, user_packing, tgl_spk, rcp_spk FROM reception WHERE jenis='p' AND nama_outlet<>'mojokerto' AND workshop='DAYA' AND kembali=false AND ambil=false AND tgl_so='0000-00-00 00:00:00' AND rijeck=false AND packing=false AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND status_order='' ORDER by tgl_input ASC");
				while($data = $sql-> fetch_array()){
					$waktus = explode(":",$data['waktu']); 

					?>
					<tr>
						<td style="vertical-align: middle; text-align: center"><?= $i ?></td>
						<td style="vertical-align: middle"><?= $data['tgl_input'] ?></td>
						<td style="vertical-align: middle;"><a href="#" style="color: black" title="Click to view" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?= $data['no_nota'];?></a></td>
						<td class="hide"><?= $data['spk'] ?></td>
						<td style="vertical-align: middle"><?= $data['nama_customer'] ?></td>
						<td style="vertical-align: middle"><?= number_format($data['total_bayar']) ?></td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_workshop']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">OP : '.$data['op_workshop'].'<br>'.$data['tgl_workshop'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_cuci']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Cuci : '.$data['op_cuci'].'<br>'.$data['tgl_cuci'].'</span>' : 'Belum';
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_setrika']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Setrika : '.$data['user_setrika'].'<br>'.$data['tgl_setrika'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 							
							echo $waktus[0].' Jam<br>'.$waktus[1].' Menit ';
							?>
						</td>
						<td class="hide"><?= $waktus[0]; ?></td>
					</tr>

					<?php $i++;
				}


				?>
			</tbody>
		</table>
	</div>
	
	



