<?php
include 'header.php';
include '../config.php';
$tgl=$_POST['tgl'];
	   $date = new DateTime($tgl);
	   $newDate = $date->format('Y-m-d');
	   
$tgl2=$_POST['tgl2'];
	   $date2= new DateTime($tgl2);
	   $newDate2 = $date2->format('Y-m-d');
?>
dari tanggal <?php echo $newDate ;?> sampai <?php echo $newDate2; ?>
<table id="tbl_cst" class="display">
	<thead>
		<tr>
		<th>Tgl Masuk</th>
			<th>No Nota</th>
			<th>Nama</th>
			<th>Tgl SPK</th>
			<th>RCP</th>
			<th>Pilih</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM reception WHERE spk='1' and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')";
			$tampil = mysqli_query($con, $query);
				while($r = mysqli_fetch_array($tampil)){
				?><tr >
				<td><?php echo $r['tgl_input']; ?></td>	
				<td><?php echo $r['no_nota']; ?></td>
				<td><?php echo $r['nama_customer']; ?></td>
				<td><?php echo $r['tgl_spk']; ?></td>
				<td><?php echo $r['rcp_spk']; ?></td>
				<td style="text-align:center;width:200px">
				<a class="btn btn-sm btn-danger" href="edit_spk.php?no_nota=<?php echo $r['no_nota']; ?>">pilih</a>
				</td>
				</tr>
					<?php } 
					?>
		</tbody>
		</table>
	
	
<script> 
$(document).ready(function() { 
$('#tbl_cst').dataTable();

} );
</script>
