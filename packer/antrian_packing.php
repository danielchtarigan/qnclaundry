<html>
	<head>
		<?php
		require "header.php";
		include "../config.php";
               $ws=$_SESSION['workshop'];
		?>
	</head>
	<body>
		<div  class="container-fluid" style="width:1200px;
   margin:0 auto;
   position:relative;
   border:3px solid rgba(0,0,0,0);
   -webkit-border-radius:5px;
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">
			<fieldset>
				<legend align="center">
					<strong>
						Antrian Packing Kiloan
					</strong>
				</legend>
				<table id="packingkiloan" class="display">
					<thead>
						<tr>
							<th>
								No
							</th>
							<th>
								Tanggal Masuk
							</th>
							<th>
								No Nota
							</th>
							<th>
								Nama Customer
							</th>
							<th>
								Express
							</th>
							<th>
								Priority
							</th>
							<th>
								Tgl Setrika
							</th>
							<th>
								Setrika
							</th>

							<th>
								pilih
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT * FROM reception natural join control where setrika=true and packing=false and kembali=false and ambil=false and jenis='k' and nama_outlet<>'mojokerto' AND workshop='$ws' AND status_order='' ORDER BY express desc, priority desc, tgl_input asc" ;
						$tampil= mysqli_query($con, $query);

						$no    = 1;
						while($data = mysqli_fetch_array($tampil))
						{
							?>
							<tr>
								<td>
									<?php echo $no ;?>
								</td>
								<td>
									<?php echo $data['tgl_input'];?>
								</td>
								<td>
									<?php echo $data['no_nota'];?>
								</td>
								<td>
									<?php echo $data['nama_customer'];?>
								</td>
								<td>
									<?php if ($data['express']==1) echo 'Express'; else if ($data['express']==2) echo 'Double Express'; else if ($data['express']==3) echo 'Super Express';				?>
								</td>

								<td>
									<?php if ($data['priority']==1) echo 'Priority'; ?>
								</td>
								<td>
									<?php
									if($data['tgl_setrika'] <> "0000-00-00 00:00:00"){
										echo ''.$data['tgl_setrika'].'';
									}
									else
									{
										echo 'belum';
									};
									?>
								</td>
								<td>
									<?php echo $data['user_setrika'];?>
								</td>

								<td align="center">
									<a class="btn btn-sm btn-danger" id="ttt" name="ttt" href="save_packing.php?no_nota=<?php echo $data['no_nota']; ?>&&id_cs=<?php echo $data['id_customer']; ?>">
										pilih
									</a>
								</td>

							</tr>

							<?php $no++;
						}
						?>
					</tbody>
				</table>





			</fieldset>
		</div>

		<div  class="container-fluid" style="width:1200px;
   margin:0 auto;
   position:relative;
   border:3px solid rgba(0,0,0,0);
   -webkit-border-radius:5px;
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">
			<fieldset>
				<legend align="center" style="background-color: #99ff00">
					<strong>
						Antrian Packing Potongan
					</strong>
				</legend>
				<table id="packingpotongan" class="display">
					<thead>
						<tr>
							<th>
								No
							</th>
							<th>
								Tanggal Masuk
							</th>
							<th>
								No Nota
							</th>
							<th>
								Nama Customer
							</th>
							<th>
								Express
							</th>
							<th>
								Priority
							</th>
							<th>
								Tgl Cuci
							</th>
							<th>
								Operator
							</th>
							<th>
								Tgl Setrika
							</th>
							<th>
								Setrika
							</th>

							<th>
								pilih
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT * FROM reception natural join control where cuci=true and packing=false and kembali=false and ambil=false and jenis='p' and nama_outlet<>'mojokerto' AND workshop='$ws' AND status_order='' ORDER BY express desc, priority desc, tgl_input asc" ;
						$tampil= mysqli_query($con, $query);

						$no    = 1;
						while($data = mysqli_fetch_array($tampil))
						{
							?>
							<tr>
								<td>
									<?php echo $no ;?>
								</td>
								<td>
									<?php echo $data['tgl_input'];?>
								</td>
								<td>
									<?php echo $data['no_nota'];?>
								</td>
								<td>
									<?php echo $data['nama_customer'];?>
								</td>
								<td>
									<?php if ($data['express']==1) echo 'Express'; else if ($data['express']==2) echo 'Double Express'; else if ($data['express']==3) echo 'Super Express';				?>
								</td>
								<td>
									<?php if ($data['priority']==1) echo 'Priority'; ?>
								</td>
								<td>
									<?php
									if($data['tgl_cuci'] <> "0000-00-00 00:00:00"){
										echo ''.$data['tgl_cuci'].'';
									}
									else
									{
										echo 'belum';
									};
									?>
								</td>
								<td>
									<?php echo $data['op_cuci'];?>
								</td>
								<td>
									<?php
									if($data['tgl_setrika'] <> "0000-00-00 00:00:00"){
										echo ''.$data['tgl_setrika'].'';
									}
									else
									{
										echo 'belum';
									};
									?>
								</td>
								<td>
									<?php echo $data['user_setrika'];?>
								</td>

								<td align="center">
									<a class="btn btn-sm btn-danger" id="ttt" name="ttt" href="save_packing.php?no_nota=<?php echo $data['no_nota']; ?>&&id_cs=<?php echo $data['id_customer']; ?>">
										pilih
									</a>
								</td>

							</tr>

							<?php $no++;
						}
						?>
					</tbody>
				</table>





			</fieldset>
		</div>
	</body>


	<script type="text/javascript">
		$(document).ready(function()
			{
				$('#packingpotongan').dataTable();
				$('#packingkiloan').dataTable();
			});
	</script>

</html>
