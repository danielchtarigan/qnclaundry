<?php 
include '../../config.php';
include '../zonawaktu.php';


$date = date('Y-m-d', strtotime($nowDate));

?>

<body onload="window.print()">
	<div style="margin: 3mm; width: 80mm">
		<div align="center">
			<h4>Stock Opname Hari ini</h4>
		</div>

		<div align="center">
			<table width="80%">
				<tr>
	               <td>
	                   <span style="float:left;font-size: 9pt;"><?= date('D, d M y G:i'); ?></span>
	               </td>
	               <td>
	                   <span style="float:right; font-size: 9pt;">Nama : <?= $_SESSION['user_id'] ?></span>
	               </td>
	           </tr>
			</table>

			<table style="border: 1px dotted; font-size: 9pt; width: 80%">
				<?php 
				$query = mysqli_query($con, "SELECT * FROM detail_so WHERE tgl_so LIKE '%$date%' AND rcp_so='$_SESSION[user_id]' AND outlet='$_SESSION[outlet]'");
				while($res = mysqli_fetch_assoc($query)) {
					?>
					<tr>
						<td>
							<?php 
							$customer = mysqli_query($con, "SELECT * FROM reception a, customer b WHERE a.id_customer=b.id AND a.no_nota='$res[no_nota]' ");
							$cust = mysqli_fetch_assoc($customer)['nama_customer'];
							echo $cust;

							?>
						</td>
						<td colspan="2" style="text-align: right"><?php echo $res['no_nota']; ?></td>
					</tr>
					<?php
				}

				?>
			</table>
			<div style="font-size: 9pt; margin-top: 5px">
				<span style="text-align: right">Jumlah :</span>
				<span style="text-align: right"> <?php echo mysqli_num_rows($query); ?></span>
			</div>
				
		</div>
	</div>

</body>