<html>
	<head>
		<?php
		require "header.php";
		include "../config.php";
		?>
	</head>
	<body>
	
    <div  class="container" style="
   margin:0 auto;padding:20px;
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
                            <center>
                            <strong style="color:#85B92E;font-weight: bold;font-size:20px;">Customer Daftar Referall</strong>
                            </center>
                            <br>
			  <table id="cucipotongan" class="display">
			  <thead>
						<tr>
							<th>
								No
							</th>
							<th>
								Nama Customer
							</th>
							<th>
								Alamat
							</th>
							<th>
								No Telephon
							</th>
							

							<th>
								pilih
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT * FROM customer WHERE member='1'" ;
						$tampil = mysqli_query($con, $query);
                                                $no=1;
						while($data= mysqli_fetch_array($tampil)){
						
							?>
							<tr>
								<td>
									<?php echo $no ;?>
								</td>
								<td>
									<?php echo $data['nama_customer'];?>
								</td>
								<td><?php echo $data['alamat'];?></td>
<td>
									<?php echo $data['no_telp'];?>
								</td>
								

								<td align="center">
									<a class="btn btn-sm btn-success" id="ttt" name="ttt" href="save_vocher.php?id_cs=<?php echo $data['id']; ?>">
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
			
				$('#cucipotongan').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 50
				
			});
			});
	</script>

</html>