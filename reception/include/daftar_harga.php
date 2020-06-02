<div class="row">

	<div class="col-md-6">
		<legend align="center">Kiloan</legend>
		<table class="table table-bordered table-condensed" style="font-size: 10pt">
			<thead>
				<tr>	
					<th>No</th>
					<th>Nama Item</th>
					<th>Harga</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				$query = mysqli_query($con, "SELECT * FROM item_spk WHERE jenis_item='k' AND harga<>'0' ORDER BY berat ASC");
				while($data = mysqli_fetch_array($query)){ ?>

				<tr>
					<td style="text-align: center"><?php echo $no++ ?></td>
					<td><?php echo $data['nama_item'] ?></td>
					<td style="text-align: right"><?php echo rupiah($data['harga']) ?></td>
				</tr>

				<?php
				}

				?>
			</tbody>
		</table>
	</div>
	
	<div class="col-md-6">
		<legend align="center">Potongan</legend>
		<table class="table table-bordered table-condensed" style="font-size: 10pt">
			<thead>
				<tr>	
					<th>No</th>
					<th>Nama Item</th>
					<th>Harga</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				$query = mysqli_query($con, "SELECT * FROM item_spk WHERE jenis_item='p' AND harga<>'0' ");
				while($data = mysqli_fetch_array($query)){ ?>

				<tr>
					<td style="text-align: center"><?php echo $no++ ?></td>
					<td><?php echo $data['nama_item'] ?></td>
					<td style="text-align: right"><?php echo rupiah($data['harga']) ?></td>
				</tr>

				<?php
				}

				?>
			</tbody>
		</table>
	</div>

</div>

<style type="text/css">
	th{
		text-align: center;
	}
	legend{
		font-size: 12pt;
		font-weight: bold
	}
</style>



	