<?php 
include '../../config.php';
include "../zonawaktu.php";
include "../../bar128.php";
$query = mysqli_query($con, "SELECT * FROM reception AS a LEFT JOIN setrika_sementara AS b ON a.no_nota=b.no_nota WHERE a.no_nota='$_GET[nota]'");
$data = mysqli_fetch_array($query);

if($_SESSION['level']!="mitra"){
    $printOut = "window.print()";
} else {
    $printOut = "";
}

?>


<body onload="<?= $printOut ?>">

	<div style="max-width:80mm; margin: 1mm; font-size: 10px; font-family: Arial;">
		<h2 align="center"><u>Rincian SPK</u></h2>
		<table>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?php echo $data['nama_customer'] ?></td>
			</tr>
			<tr>
				<td>No Nota</td>
				<td>:</td>
				<td><?php echo $_GET['nota'] ?></td>
			</tr>
			<tr>
				<td>Setrika</td>
				<td>:</td>
				<td><?php echo $data['user_setrika'] ?></td>
			</tr>
			<tr>
				<td>Jam</td>
				<td>:</td>
				<td><?php echo date('d/m/Y H:i', strtotime($nowDate)) ?></td>
			</tr>
			<tr>
				<td>Dikeringkan</td>
				<td>:</td>
				<td><?php echo date('d/m/Y H:i', strtotime($data['tgl_pengering'])) ?></td>
			</tr>
		</table>
		<?php
			echo '<div align="center" style="margin-top: 5px;">'.bar128(stripslashes($_GET['nota'])).'</div>';
		?>
		
		<table class="print-opr">
			<?php 
			$rincians = mysqli_query($con, "SELECT * FROM detail_spk WHERE no_nota='$_GET[nota]'");
			while($spk = mysqli_fetch_assoc($rincians)){ ?>
			<tr>
				<td><?php echo $spk['jenis_item'] ?></td>
				<td style="text-align: right"><?php echo $spk['jumlah'] ?></td>
			</tr>
			<?php 
			}
			?>
			<tr>
				<?php 
				$jumitem = mysqli_query($con, "SELECT SUM(jumlah) AS jumlah FROM detail_spk WHERE no_nota='$_GET[nota]'");
				$hasil = mysqli_fetch_row($jumitem);
				?>
				<td style="text-align: right">Total</td>
				<td style="text-align: right"><?php echo $hasil[0]; ?></td>
			</tr>			
		</table>
	</div>

	<style type="text/css">
		.print-opr{
			border: 1px inset;
			font : 10pt arial;
			height: 26px;
			width: 240px;
			margin-bottom: 15px;
		}
	</style>

	

</body>
