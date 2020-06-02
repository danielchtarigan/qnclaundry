<?php
include '../../config.php';
session_start();

if (isset($_GET['faktur'])) {
	$no_faktur = $_GET['faktur'];
	$query = mysqli_query($con,"SELECT no_nota,spk,cuci,pengering,setrika,packing,sms_sent FROM reception WHERE no_faktur='$no_faktur'");
	while ($data = mysqli_fetch_array($query)) { 
		?>
		<tr>
			<td><?php echo $data['no_nota'] ?></td>
			<td>
			<?php if ($data['spk']==0) echo 'Order';
			else if ($data['cuci']==0) echo 'SPK';
			else if ($data['pengering']==0 && $data['setrika']==0) echo 'Cuci';
			else if ($data['pengering']==1 && $data['setrika']==0) echo 'Kering';
			else if ($data['packing']==0) echo 'Setrika';
			else if ($data['sms_sent']==0) echo 'Packed';
			else if ($data['sms_sent']==1) echo 'Ready'; ?>
			</td>
		</tr>
	<?php }
} ?>