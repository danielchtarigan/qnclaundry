<?php 
include '../config.php';
include 'head.php';

$query = mysqli_query($con, "SELECT * FROM extra_operasional AS a INNER JOIN user AS b ON a.id_user=b.user_id WHERE b.level<>'admin' AND b.level<>'reception' AND b.level<>'delivery' AND a.hadir<>0 ");
$data2 = mysqli_fetch_array($query);


?>

<div class="panel panel-default">
  <div class="panel-body">
	<div class="col-md-4 col-md-offset-8" style="text-align: right ">		 		
			<?php if($data2['verifikasi']=="0") {?>
			<form action="act/verifikasi_kehadiran_operasional.php" method="POST">
				<button type="submit" class="btn btn-danger btn-xs btn-active" name="verifikasi" value="verifikasi"><i class="fa fa-square-o"></i></button><strong> VERIFIKASI</strong>
			</form>					
			<?php } else{ ?>	
			<button class="btn btn-info btn-xs btn-active" name=""><i class="fa fa-check-square-o"></i></button><strong> DATA TERVERIFIKASI</strong><br><br>
			<a href="poin_kpi_operasional.php"><button class="btn btn-default btn-xs btn-active">LIHAT & KUNCI KPI OPERASIONAL</button></a>
			<?php } ?>		
	</div>
	</hr><br>


		<form method="POST" action="index.php?menu=updateKerjaOperasional">
				<div class="">
					<button class="btn btn-primary btn-xs btn-active">UPDATE KEHADIRAN & KASUS OPERASIONAL</button>
				</div>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th><input type="checkbox" value="Check All" id="cb" name="select_invoice" /></th>
						<th>NAMA</th>
						<th>Posisi</th>
						<th>Kehadiran</th>
						<th>Masuk Malam</th>
						<th>Poin Brosur</th>
						<th>Kasus Cucian</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$extraop = mysqli_query($con, "SELECT *FROM extra_operasional AS a INNER JOIN user AS b on a.id_user=b.user_id WHERE (b.level='operator' OR b.level='setrika' OR b.level='packer') AND b.aktif='Ya' ORDER BY level,jenis ASC ");?>
					<tr>
						<?php 
						while($data = mysqli_fetch_array($extraop)){
							$id = (int) $data['id'];					
						?>
					
						<td><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>				
						<td><?php echo $data['name'];  ?></td>
						<td><?php echo $data['level'].' '.$data['jenis'] ?></td>
						<td><?php echo $data['hadir'] ?></td>
						<td><?php echo $data['masuk_malam'] ?></td>
						<td><?php echo $data['poin_brosur'] ?></td>
						<td><?php echo $data['kasus_nota'] ?></td>
					</tr>
					<?php 
					}					 
					?>
					<tr>
						
					</tr>	
				</tbody>
			</table>
		</div>
		</form>

		<script type="text/javascript">
			$(document).ready(function(){
				$('input[value="Check All"]').click(function() { // a button with Check All as its value
			    $(':checkbox').prop('checked', true); // all checkboxes, you can narrow with a better selector
				});
			})
		</script>

	</div>
</div>