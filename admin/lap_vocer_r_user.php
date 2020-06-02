<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id'];
$sql="select vu.*,c.nama_customer pengguna_voucher,vl.jenis_voucher,vl.disk,vl.pemilik_voucher from voucher_used vu left join customer c on vu.id_customer = c.id left join (select vlt.*,ct.nama_customer pemilik_voucher from voucher_lucky vlt left join customer ct on vlt.id_customer = ct.id) vl on vu.voucher = vl.no_voucher where vl.jenis_voucher='RV'";
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
        <center><h2>Laporan Pengguna Voucher Referral</h2></center>
    	<table id="voucher" class="display dataTable no-footer">
		<thead>
		<tr>
			<th>Tanggal</th>
			<th>Nomor Voucher</th>
			<th>Jenis Vocher</th>
			<th>Diskon</th>
			<th>Nama Pengguna Voucher</th>
			<th>Nama Pemilik Voucher</th>
			<th>Nama Reception</th>
			<th>Outlet</th>
		</tr>
		</thead>
		<tfoot>
            <tr>
			<th>Tanggal</th>
			<th>Nomor Voucher</th>
			<th>Jenis Vocher</th>
			<th>Diskon</th>
			<th>Nama Pengguna Voucher</th>
			<th>Nama Pemilik Voucher</th>
			<th>Nama Reception</th>
			<th>Outlet</th>
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
                                 <td><?php echo date("d M Y",strtotime($r['created'])) ?></td>
                                    <td><?php echo $r['voucher'] ?></td>
                                    <td><?php echo $jenis ?></td>
                                    <td><?php echo round((float)$r['disk'] * 100) . '%' ?></td>
                                    <td><?php echo $r['pengguna_voucher'] ?></td>
                                    <td><?php echo $r['pemilik_voucher'] ?></td>
                                    <td><?php echo ucfirst($r['creator']) ?></td>
                                    <td><?php echo ucfirst($r['outlet']) ?></td>

                                </tr>

				<?php } ?>
</tbody>	

		
	</table>
    
    
</div>