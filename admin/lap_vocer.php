<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id'];
$sql="SELECT vl.*,c.nama_customer nama FROM voucher_lucky vl left join customer c on vl.id_customer = c.id where vl.aktif=0 and id_customer<>false and vl.kali<=10 and vl.jenis_voucher='mb';";
?>
<script>
	$(document).ready(function()
		{
			$('#voucher').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 50
				
			});

		});
</script>
<div class="container" style="padding:20px; margin:100px auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
        <center><h2>Laporan Pemilik Voucher Diskon</h2></center>
    	<table id="voucher" class="display dataTable no-footer">
		<thead>
		<tr>
			<th>Nomor Vocher</th>
			<th>Jenis Vocher</th>
			<th>Diskon</th>
			<th>Nama</th>
			<th>Keterangan</th>
		</tr>
		</thead>
		<tfoot>
            <tr>
			<th>Nomor Vocher</th>
			<th>Jenis Vocher</th>
			<th>Diskon</th>
			<th>Nama</th>
			<th>Keterangan</th>
		</tr>
        </tfoot>
						<tbody>
				<?php
				$user_query = mysqli_query($con,$sql )or die(mysqli_error());
				while($r = mysqli_fetch_array($user_query)){
                                if ($r['jenis_voucher']=='RV'){
					$jenis="Referral";
				} else{
					$jenis="Diskon";
				}

                                ?>
                             <tr>
                                    <td><?php echo $r['no_voucher'] ?></td>
                                    <td><?php echo $jenis ?></td>
                                    <td><?php echo round((float)$r['disk'] * 100) . '%' ?></td>
                                    <td><?php echo $r['nama'] ?></td>
                                    <td><?php echo $r['kali']==0 ? "Belum pernah digunakan":"Telah digunakan sebanyak ".$r['kali']." kali"; ?></td>

                                </tr>

				<?php } ?>
</tbody>	

		
	</table>
    
    
</div>