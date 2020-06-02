<?php 
include '../config.php';
include 'head.php';
$date = date('Y/m/d');

if(isset($_POST['cari'])){
	$startDate = $_POST['tanggal1'];
	$endDate = $_POST['tanggal2'];
} else{
	$startDate = date('Y/m', strtotime('-1 months', strtotime($date))).'/26';
	$endDate = date('Y/m').'/25';
}



?>
<div class="panel panel-default">
	<div class="panel-body">
		<form action="" method="POST">
			<label>dari</label>
			<input type="text" name="tanggal1" id="tanggal1" value="<?php echo $startDate ?>">
			<label>sampai</label>
			<input type="text" name="tanggal2" id="tanggal2" value="<?php echo $endDate ?>">
			<button type="submit" class="btn btn-default btn-md" name="cari" value="Cari">Cari</button>
		</form><hr>

		<h4><center>OTP ALL OUTLET</center></h4><hr>

		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th style="text-align: center">Nama Outlet</th>
						<th style="text-align: center">Jumlah Nota</th>
						<th style="text-align: center">OTP Umum</th>
						<th style="text-align: center">OTP Outlet</th>
						<th style="text-align: center">OTP Operasional</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$qoutlet = mysqli_query($con, "SELECT nama_outlet FROM outlet WHERE nama_outlet<>'mojokerto' AND nama_outlet<>'support' AND nama_outlet<>'Nipa-Nipa' AND nama_outlet<>'Cendrawasih' ");
					while($outlet = mysqli_fetch_row($qoutlet)){
						$ot = $outlet[0];		
					?>
					<tr>
						<td><?php echo $ot ; ?></td>
						<td align="right">
							<?php 
							$qnota = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM reception WHERE nama_outlet='$ot' AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$datnota = mysqli_fetch_row($qnota);
							echo $datnota[0];
							?>
						</td>
						<td align="right">
							<?php 
							$qotp1 = mysqli_query($con, "SELECT COUNT(*) AS otp FROM reception WHERE nama_outlet='$ot' AND DATEDIFF(tgl_kembali, tgl_input)<=2.5 AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$datotp1 = mysqli_fetch_row($qotp1);
							echo ROUND(($datotp1[0]/$datnota[0])*100,2).'&nbsp; %';
							?>
						</td>
						<td align="right">
							<?php 
							$qotp2 = mysqli_query($con, "SELECT COUNT(*) AS otp FROM reception WHERE nama_outlet='$ot' AND DATEDIFF(tgl_spk, tgl_input)<=0.5 AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$datotp2 = mysqli_fetch_row($qotp2);
							echo ROUND(($datotp2[0]/$datnota[0])*100,2).'&nbsp; %';
							?>
						</td>
						<td align="right">
							<?php 
							$qotp3 = mysqli_query($con, "SELECT COUNT(*) AS otp FROM reception WHERE nama_outlet='$ot' AND DATEDIFF(tgl_packing, tgl_spk)<=1.5 AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$datotp3 = mysqli_fetch_row($qotp3);
							echo ROUND(($datotp3[0]/$datnota[0])*100,2).'&nbsp; %';
							?>
						</td>
					</tr>
					<?php } ?>
					<tr style="font-weight: bold; text-align: right">
						<td>Total OTP All Outlet</td>
						<td>
							<?php 
							$qnota = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM reception WHERE nama_outlet<>'mojokerto' AND nama_outlet<>'support' AND nama_outlet<>'Nipa-Nipa' AND nama_outlet<>'Cendrawasih' AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$datnota = mysqli_fetch_row($qnota);
							echo $datnota[0];
							?>
						</td>
						<td>
							<?php 
							$qotp1 = mysqli_query($con, "SELECT COUNT(*) AS otp FROM reception WHERE nama_outlet<>'mojokerto' AND nama_outlet<>'support' AND nama_outlet<>'Nipa-Nipa' AND nama_outlet<>'Cendrawasih' AND DATEDIFF(tgl_kembali, tgl_input)<=2.5 AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$datotp1 = mysqli_fetch_row($qotp1);
							echo ROUND(($datotp1[0]/$datnota[0])*100,2).'&nbsp; %';
							?>
						</td>
						<td>
							<?php 
							$qotp2 = mysqli_query($con, "SELECT COUNT(*) AS otp FROM reception WHERE nama_outlet<>'mojokerto' AND nama_outlet<>'support' AND nama_outlet<>'Nipa-Nipa' AND nama_outlet<>'Cendrawasih' AND DATEDIFF(tgl_spk, tgl_input)<=0.5 AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$datotp2 = mysqli_fetch_row($qotp2);
							echo ROUND(($datotp2[0]/$datnota[0])*100,2).'&nbsp; %';
							?>
						</td>
						<td>
							<?php 
							$qotp3 = mysqli_query($con, "SELECT COUNT(*) AS otp FROM reception WHERE nama_outlet<>'mojokerto' AND nama_outlet<>'support' AND nama_outlet<>'Nipa-Nipa' AND nama_outlet<>'Cendrawasih' AND DATEDIFF(tgl_packing, tgl_spk)<=2 AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$datotp3 = mysqli_fetch_row($qotp3);
							echo ROUND(($datotp3[0]/$datnota[0])*100,2).'&nbsp; %';
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(function(){
        $("#tanggal1").datepicker({
            dateFormat:'yy/mm/dd',
        });

        $("#tanggal2").datepicker({
            dateFormat:'yy/mm/dd'
        });
    });
</script>