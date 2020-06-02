<html>
	<head>
		<?php
		require "header.php";
		include "../config.php";
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
   margin-bottom: 70px;">
			<fieldset>
				<legend align="center">
					<strong>
						Antrian Cuci Potongan
					</strong>
				</legend>
				<table id="cucipotongan" class="display">
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
								Outlet
							</th>


							<th>
								pilih
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT * FROM reception where cuci=false and setrika=false and spk=true and packing=false and kembali=false and ambil=false and jenis='p' and nama_outlet<>'mojokerto' and workshop='$workshop' and cara_bayar<>'Void' and cara_bayar<>'Reject' and rijeck=false AND status_order='' ORDER BY express desc, priority desc, tgl_input asc" ;
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
									<?php echo $data['nama_outlet'];?>
								</td>


								<td align="center">
									<a class="btn btn-sm btn-danger" id="ttt" name="ttt" href="save_cuci2.php?no_nota=<?php echo $data['no_nota']; ?>&&id_cs=<?php echo $data['id_customer']; ?>">
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

				$('#cucipotongan').dataTable();
			});
	</script>

</html>
