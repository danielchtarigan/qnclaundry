<form method="POST" action="index.php?menu=updateKerjaOperasional">
	<div class="row">
		<div class="col-md-6">
			<button class="btn btn-primary btn-xs btn-active">UPDATE KEHADIRAN & KASUS OPERASIONAL</button>
		</div>			
		<div class="col-md-6" style="text-align: right">
			<a href="kpi2.php"><button class="btn btn-danger btn-xs btn-active">LIHAT & KUNCI KPI OPERASIONAL</button></a>
		</div>	
	</div>


	<table class="table table-bordered table-striped table-hover table-condensed">
		<thead>
			<tr>
				<th><input type="checkbox" value="Check All" id="cb" name="select_invoice" /></th>
				<th>NAMA</th>
				<th>Posisi</th>
				<th>Kehadiran</th>
				<th>Masuk Malam</th>
				<th>12 Jam</th>
				<th>Kasus Cucian</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$extraop = mysqli_query($con, "SELECT *FROM extra_operasional AS a INNER JOIN user AS b on a.id_user=b.user_id WHERE b.level<>'admin' AND b.level<>'reception' AND b.level<>'delivery' ");?>
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
				<td><?php echo $data['duabelasjam'] ?></td>
				<td><?php echo $data['kasus_nota'] ?></td>
			</tr>
			<?php 
			}
			?>		
		</tbody>
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('input[value="Check All"]').click(function() { // a button with Check All as its value
	    $(':checkbox').prop('checked', true); // all checkboxes, you can narrow with a better selector
		});
	})
</script>