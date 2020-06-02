





	<div class="table-responsive" style="margin-top: 25px">
		<legend align="center" ><marquee behavior=alternate  width="800">Kiloan Belum di Packing dan Belum Kembali</marquee></legend>

		<div style="margin-bottom: 20px">
			<!-- ====== -->
		</div>

		<table class="table table-striped" style="font-size: 11px; width: 100%;" id="databwk">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal Input</th>
					<th>No Order</th>
					<th class="hide"></th>
					<th>Nama Customer</th>
					<th>Total</th>
					<th>SPK</th>
					<th>Jemput</th>
					<th>Time</th>
					<th class="hide"></th>
				</tr>
			</thead>

			<tbody>
				<?php 
				$i = 1;
				$sql = $con-> query("SELECT a.tgl_input, a.spk, a.no_nota, a.jenis,a.nama_customer,a.total_bayar,a.tgl_cuci,a.tgl_setrika,a.tgl_packing,timediff('$jam',a.tgl_input) as waktu, a.op_cuci, a.user_setrika, a.user_packing, a.tgl_spk, rcp_spk FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND a.jenis='k' AND a.kembali=false AND a.tgl_so='0000-00-00 00:00:00' AND a.rijeck=false AND a.packing=false AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND b.Kota='Makassar' AND a.workshop='' AND status_order='' ORDER by a.tgl_input ASC LIMIT 200");
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
							$cuci = ($data['tgl_spk']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">SPK : '.$data['rcp_spk'].'<br>'.$data['tgl_spk'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$driverJs = $con->query("SELECT b.driver, b.tgl FROM manifest a, man_serah b WHERE a.kd_serah=b.kode_serah AND a.no_nota='$data[no_nota]'");
							$countDriverJs = mysqli_num_rows($driverJs);
							$driverJ = $driverJs->fetch_row();
							$driver = $driverJ[0];
							$tglJemput = $driverJ[1];
							
							$cuci = ($countDriverJs>0) ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Driver : '.$driver.'<br>'.$tglJemput.'</span>' : 'Belum';
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
			<button id="cekbwk2" type="button" class="btn btn-white btn-xs hide" style="background-color: white" title="Trash">
				<i class="fa fa-trash-o fa-2x" aria-hidden="true" style="color: red"></i>
			</button>
			<span id="nbwk2"></span>
		</div>

		<table class="table table-striped" style="font-size: 11px; width: 100%;" id="databwkpotongan">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal Input</th>
					<th>No Order</th>
					<th class="hide"></th>
					<th>Nama Customer</th>
					<th>Total</th>
					<th>SPK</th>
					<th>Jemput</th>
					<th>Time</th>
					<th class="hide"></th>
				</tr>
			</thead>

			<tbody>
				<?php 
				$i=1;
				$sql = $con-> query("SELECT a.tgl_input, a.spk, a.no_nota, a.jenis,a.nama_customer,a.total_bayar,a.tgl_cuci,a.tgl_setrika,a.tgl_packing,timediff('$jam',a.tgl_input) as waktu, a.op_cuci, a.user_setrika, a.user_packing, a.tgl_spk, rcp_spk FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND a.jenis='p' AND a.kembali=false AND a.tgl_so='0000-00-00 00:00:00' AND a.rijeck=false AND a.packing=false AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND b.Kota='Makassar' AND a.workshop='' AND status_order='' ORDER by a.tgl_input ASC");
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
							$cuci = ($data['tgl_spk']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">SPK : '.$data['rcp_spk'].'<br>'.$data['tgl_spk'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$driverJs = $con->query("SELECT b.driver, b.tgl FROM manifest a, man_serah b WHERE a.kd_serah=b.kode_serah AND a.no_nota='$data[no_nota]'");
							$countDriverJs = mysqli_num_rows($driverJs);
							$driverJ = $driverJs->fetch_row();
							$driver = $driverJ[0];
							$tglJemput = $driverJ[1];
							
							$cuci = ($countDriverJs>0) ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Driver : '.$driver.'<br>'.$tglJemput.'</span>' : 'Belum';
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
	
	



