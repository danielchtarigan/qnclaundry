<?php
include "../config.php";
?>
<fieldset>
<legend align="center" ><strong>EXPRESS</strong></legend>
<table id="express" class="display">
		<thead>
		<tr>

			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
<th>Ket</th>
			<th>Tgl Cuci</th>
			<th>Tgl Setrika</th>
			<th>Express</th>

		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT tgl_input,no_nota,nama_customer,tgl_cuci,tgl_setrika,kembali,express,packing,ket FROM reception  WHERE packing=false and express<>0 and kembali=false ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);


			while($data = mysqli_fetch_array($tampil)){?>
				<tr>

						<td><?php echo $data['tgl_input'];?></td>
						<td><?php echo $data['no_nota'];?></td>
						<td><?php echo $data['nama_customer'];?></td>
<td><?php echo $data['ket'];?></td>

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

						<?php  }
 ?>

				</tbody>
	</table>
</fieldset>
<script type="text/javascript">
		$(document).ready(function(){
		$('#express').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 50,
				"scrollY": 300,
				"scrollX": 300,
				"paging": false,
			    "info": false




			});


			});
	</script>
