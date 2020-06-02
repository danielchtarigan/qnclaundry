<?php 
include '../config.php';

$no_nota = $_GET['no_nota'];
$sql = mysqli_query($con, "SELECT * FROM detail_spk WHERE no_nota='$no_nota'");
$nrows = mysqli_num_rows($sql);
if($nrows>0) { 
	$customers = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$no_nota'");
	$rcus = mysqli_fetch_array($customers);


	?>

	<body onload="window.print()">
		<div align="center">
			<table align="center">
				<?php 
				$no = 1;
				while($rrow = mysqli_fetch_array($sql)){
					$item = substr($rrow['jenis_item'], 11);
					echo '<tr>';
					echo '<td style="text-align: center">&nbsp; <p style="font-size: 20px; font-weight: text-align: center;">'.$rrow['no_nota'].' | '.$no.' / '.$nrows.'</p><br><p style="margin-bottom: -10px; margin-top: -35px; font-size: 12px;">'.$item.'</p><p align="right" style="font-size: 12px"><em>Customer : '.$rcus['nama_customer'].'</em></p>';	
					if($nrows-$no>0) {
						echo '<div style="page-break-before:always;">';		
					}
					
					echo '</td>';

					echo '</tr>';
					
					$no++;
				}
				
				?>
			</table>
		</div>
	</body>

<?php
} else {
	echo $no_nota." Belum DiSPK atau Belum Ada";
}

?>

<p style="padding-bottom: "></p>