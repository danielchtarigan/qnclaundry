<html>
<head>

<?php
include "../config.php";
include "header.php";
include '../laporan_pegawai_functions.php';
include 'manifest_driver.php';

?>
</head>
<body>
<?php
$op=$_SESSION['user_id']; ?>
	<script type="text/javascript">
		$(document).ready(function(){
			oTable = $('#cuci').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 50

			});

			oTable = $('#express').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 50

			});


		});
	</script>

	<?php $data = progres_pegawai($_SESSION['user_id'],'packer'); ?>
	<div class="container" style="width:800px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  color:#000000;margin-bottom:20px">
	<p style="font-size:20px"><strong>POIN HARI INI: <?php echo $data['poin_harian']; ?>/<?php echo $data['target_harian']; ?></strong></p>
	<hr>
	<strong>PROGRES PEGAWAI</strong>
	<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
				<th></th>
				<th>Bulan Ini</th>
				<th>Bulan Lalu</th>
			</tr>
			</thead>
			<tbody>
				<tr>
					<td><strong>Total Poin</strong></td>
					<td><?php echo $data['poin_bulan_ini'];?></td>
					<td><?php echo $data['poin_bulan_lalu'];?></td>
				</tr>
				<tr>
					<td><strong>Target Poin</strong></td>
					<td><?php echo $data['target_bulan_ini'].' ('.$data['jumlah_hari_kerja'].' hari kerja)';?></td>
					<td><?php echo $data['target_bulan_lalu'].' ('.$data['jumlah_hari_kerja_bulan_lalu'].' hari kerja)';?></td>
				</tr>
				<tr>
					<td><strong>Quality Audit</strong></td>
					<td><div align="left" style="background-image:url(../image/star_back.jpg); background-position:left; background-repeat:no-repeat; padding-top:0px; padding-left:0px;display: inline-block; vertical-align: middle;width: 130px;height:25px">
						<?php if ($data['qa_bulan_ini']>5) $data['qa_bulan_ini']=5; $persen = $data['qa_bulan_ini']/5;
						$panjang = $persen*130; ?>
							<table><tr>
								<td style="width:<?php echo $panjang; ?>px; text-align:left; float:left; background-image:url(image/star_show.jpg); height:25px; margin-left:0px;">&nbsp;
								</td>
							</tr></table>
						</div>(<?php echo $data['qa_bulan_ini']; ?>)</td>
					<td><div align="left" style="background-image:url(../image/star_back.jpg); background-position:left; background-repeat:no-repeat; padding-top:0px; padding-left:0px; display: inline-block; vertical-align: middle;width: 130px;height:25px">
						<?php if ($data['qa_bulan_lalu']>5) $data['qa_bulan_lalu']=5; $persen = $data['qa_bulan_lalu']/5;
						if ($data['qa_bulan_lalu']>0){ $panjang = $persen*130; ?>
							<table><tr>
								<td style="width:<?php echo $panjang; ?>px; text-align:left; float:left; background-image:url(image/star_show.jpg); height:25px; margin-left:0px;">&nbsp;
								</td>
							</tr></table>
								<?php } ?>
						</div>&nbsp;(<?php echo $data['qa_bulan_lalu']; ?>)</td>
				</tr>
				<tr>
					<td><strong>OTP</strong></td>
					<td><?php echo $data['otp_bulan_ini']; ?>%</td>
					<td><?php echo $data['otp_bulan_lalu']; ?>%</td>
				</tr>
			</tbody>
		</table>
</div>
</div>
	<div class="container-container" style="width:800px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  color:#000000;">
	<fieldset>
<legend align="center" ><strong>EXPRES Belum Di Packing</strong></legend>
<table id="express" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Tgl Cuci</th>
			<th>Tgl Setrika</th>
			<th>Express</th>

		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM reception  WHERE packing=false and express<>0 and kembali=false ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);

			$no = 1;
			while($data = mysqli_fetch_array($tampil)){?>
				<tr>
						<td><?php echo $no ;?> </td>
						<td><?php echo $data['tgl_input'];?></td>
						<td><?php echo $data['no_nota'];?></td>
						<td><?php echo $data['nama_customer'];?></td>

						<td><?php		       if($data['tgl_cuci']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_cuci'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?>


                                                </td>
                                                <td><?php		       if($data['tgl_setrika']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_setrika'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?></td>
				<td><?php if ($data['express']==1) echo 'Express'; else if ($data['express']==2) echo 'Double Express'; else if ($data['express']==3) echo 'Super Express'; ?></td>

						</tr>

						<?php $no++; }
 ?>

				</tbody>
	</table>
	</fieldset>
</div>



	<div class="container" style="width:600px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:70px; color:#000000;">
<fieldset>
<legend align="center"><strong>Packer Hari Ini</strong></legend>
<table id="cuci" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tanggal cuci</th>
			<th>No Nota</th>
			<th>Nama Customer</th>

		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM reception where user_packing='$op'";
			$tampil = mysqli_query($con, $query);

			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$no</td>
						<td>$data[tgl_packing]</td>
						<td>$data[no_nota]</td>
						<td>$data[nama_customer]</td>
					  </tr>";
			$no++;
			}
			?>
		</tbody>
	</table>
	</fieldset>
</div>
</body>
</html>
