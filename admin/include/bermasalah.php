
	

	<div class="table-responsive" style="margin-top: 25px">
		<legend align="center" ><marquee behavior=alternate  width="800">Cucian Bermasalah Kiloan</marquee></legend>

		<div style="margin-bottom: 20px">
			<!-- ===== -->
		</div>

		<table class="table table-striped" style="font-size: 11px; width: 100%;" id="dspam">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal Input</th>
					<th>No Order</th>
					<th class="hide"></th>
					<th>Nama Customer</th>
					<th>Total</th>
					<th>Posisi Terakhir</th>
					<th>Waktu Terakhir</th>
					<th>Time</th>
					<th class="hide"></th>
				</tr>
			</thead>

			<tbody>
				<?php 
				$i=1;
				$sql = $con-> query("SELECT a.tgl_input, a.spk, a.no_nota, a.jenis,a.nama_customer,a.total_bayar,a.tgl_cuci,a.tgl_setrika,a.tgl_packing,timediff('$jam',a.tgl_input) as waktu, a.op_cuci, a.user_setrika, a.user_packing, a.tgl_spk, a.rcp_spk, a.tgl_pengering, a.tgl_workshop, a.workshop FROM reception a, outlet b WHERE a.jenis='k' AND a.nama_outlet=b.nama_outlet AND a.kembali=false AND a.tgl_so='0000-00-00 00:00:00' AND a.packing=false AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND b.Kota='Makassar' AND status_order='spam' ORDER by a.tgl_input ASC");
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
							if($data['tgl_packing']<>'0000-00-00 00:00:00'){
								$stat = "Packing";
							} else if($data['tgl_setrika']<>'0000-00-00 00:00:00'){
								$stat = "Setrika";
							} else if($data['tgl_pengering']<>"0000-00-00 00:00:00"){
								$stat = "Pengering";
							} else if($data['tgl_cuci']<>"0000-00-00 00:00:00"){
								$stat = "Cuci";
							} else if($data['tgl_workshop']<>"0000-00-00 00:00:00"){
								$stat = "Checkin ".$data['workshop'];
							} else if($data['tgl_spk']<>"0000-00-00 00:00:00"){
								$stat = "SPK";
							} else {
								$stat = "Belum SPK";
							}

							echo $stat;

							?>
						</td>
						<td style="vertical-align: middle;">
							<?php 
							if($data['tgl_packing']<>'0000-00-00 00:00:00'){
								$stat = $data['tgl_packing'];
							} else if($data['tgl_setrika']<>'0000-00-00 00:00:00'){
								$stat = $data['tgl_setrika'];
							} else if($data['tgl_pengering']<>"0000-00-00 00:00:00"){
								$stat = $data['tgl_pengering'];
							} else if($data['tgl_cuci']<>"0000-00-00 00:00:00"){
								$stat = $data['tgl_cuci'];
							} else if($data['tgl_workshop']<>"0000-00-00 00:00:00"){
								$stat = $data['tgl_workshop'];
							} else if($data['tgl_spk']<>"0000-00-00 00:00:00"){
								$stat = $data['tgl_spk'];
							} else {
								$stat = "Belum SPK";
							}

							echo $stat;

							?>
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


	<div class="table-responsive" style="margin-top: 25px">
		<legend align="center" ><marquee behavior=alternate  width="800">Cucian Bermasalah Potongan</marquee></legend>

		<div style="margin-bottom: 20px">
			<!-- ===== -->
		</div>

		<table class="table table-striped" style="font-size: 11px; width: 100%;" id="dspamp">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal Input</th>
					<th>No Order</th>
					<th class="hide"></th>
					<th>Nama Customer</th>
					<th>Total</th>
					<th>Posisi Terakhir</th>
					<th>Waktu terakhir</th>
					<th>Time</th>
					<th class="hide"></th>
				</tr>
			</thead>

			<tbody>
				<?php 
				$i=1;
				$sql = $con-> query("SELECT a.tgl_input, a.spk, a.no_nota, a.jenis,a.nama_customer,a.total_bayar,a.tgl_cuci,a.tgl_setrika,a.tgl_packing,timediff('$jam',a.tgl_input) as waktu, a.op_cuci, a.user_setrika, a.user_packing, a.tgl_spk, a.rcp_spk, a.tgl_pengering, a.tgl_workshop, a.workshop FROM reception a, outlet b WHERE a.jenis='p' AND a.nama_outlet=b.nama_outlet AND a.kembali=false AND a.tgl_so='0000-00-00 00:00:00' AND a.packing=false AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND b.Kota='Makassar' AND status_order='spam' ORDER by a.tgl_input ASC");
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
							if($data['tgl_packing']<>'0000-00-00 00:00:00'){
								$stat = "Packing";
							} else if($data['tgl_setrika']<>'0000-00-00 00:00:00'){
								$stat = "Setrika";
							} else if($data['tgl_pengering']<>"0000-00-00 00:00:00"){
								$stat = "Pengering";
							} else if($data['tgl_cuci']<>"0000-00-00 00:00:00"){
								$stat = "Cuci";
							} else if($data['tgl_workshop']<>"0000-00-00 00:00:00"){
								$stat = "Checkin ".$data['workshop'];
							} else if($data['tgl_spk']<>"0000-00-00 00:00:00"){
								$stat = "SPK";
							} else {
								$stat = "Belum SPK";
							}

							echo $stat;

							?>
						</td>
						<td style="vertical-align: middle;">
							<?php 
							if($data['tgl_packing']<>'0000-00-00 00:00:00'){
								$stat = $data['tgl_packing'];
							} else if($data['tgl_setrika']<>'0000-00-00 00:00:00'){
								$stat = $data['tgl_setrika'];
							} else if($data['tgl_pengering']<>"0000-00-00 00:00:00"){
								$stat = $data['tgl_pengering'];
							} else if($data['tgl_cuci']<>"0000-00-00 00:00:00"){
								$stat = $data['tgl_cuci'];
							} else if($data['tgl_workshop']<>"0000-00-00 00:00:00"){
								$stat = $data['tgl_workshop'];
							} else if($data['tgl_spk']<>"0000-00-00 00:00:00"){
								$stat = $data['tgl_spk'];
							} else {
								$stat = "Belum SPK";
							}

							echo $stat;

							?>
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

