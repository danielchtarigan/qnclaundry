<?php 
include '../config.php';
session_start();
	   $no_nota=$_POST['no_nota'];
	   $workshop=$_POST['workshop'];
       $setrika=$_POST['setrika'];
       $id_cs=$_POST['id_cs'];
       
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");

$sql5=$con->query("SELECT sum(jumlah) as total FROM detail_spk WHERE no_nota= '$no_nota'");
$r = $sql5->fetch_assoc();
$t=$r['total']; 
$edit = mysqli_query($con,"SELECT * FROM reception WHERE no_nota='$no_nota' limit 1");
$rc   = mysqli_fetch_array($edit);   

$q=mysqli_query($con,"insert into setrika_sementara (tgl_setrika,user_setrika,no_nota,workshop) VALUES('$jam','$setrika','$no_nota','$workshop')");
if($q){
	 	$edit = mysqli_query($con,"SELECT * FROM setrika_sementara WHERE no_nota='$no_nota'");
    	$r    = mysqli_fetch_array($edit);
	 	
	    	?>
 <div style="font-size: 12px; font-family: Arial" >
<div align="center" class="style1 style4">SPK</div>
 <div>
<?php
echo 'Nama : '.$rc['nama_customer'].'<br>';
echo 'No Faktur : '.$no_nota.'<br>';
echo 'Setrika : '.$setrika.'<br>';
echo 'Tgl Pengering :'.$rc['tgl_pengering'].'<br>';
echo 'Jam :'.$jam.'<br>';
include"../reception/bar128.php";
echo bar128(stripslashes($no_nota));

?>
</div>
<table id="resultTable" data-responsive="table" style="text-align: left; font-size: 12px;font-family: arial">
	<thead>
		<tr>
			<th></th>
			
			<th></th>
			
		</tr>
	</thead>
	<tbody>
	<?php
			$sql2=mysqli_query($con,"SELECT * FROM detail_spk WHERE no_nota= '$no_nota'");
 			while($s = mysqli_fetch_array($sql2)){
				?>
				<tr>

						<td colspan="2"><?php echo $s['jenis_item'];?></td><td></td>
						<td colspan="4"><?php echo $s['jumlah'];?></td>
				
				</tr>
			
						<?php  
						}
					?>
					<tr>
				<td colspan="2">Total:</td><td></td>
				<td colspan="4">
				<?php
				$sql3=mysqli_query($con,"SELECT sum(jumlah) as total FROM detail_spk WHERE no_nota= '$no_nota'");
$s1=mysqli_fetch_array($sql3);
$hr=$s1['total'];
echo $hr ;
				?>
				</td>
			</tr>
	
		
	</tbody>
</table>
</div>
<?php

    }
	else {
	 echo '<font color="red">Error, Data Sudah Ada</font>';
	 }


?>
