
<div class=" panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Daftar Item Bahan Baku</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-8" style="overflow-x: auto">
			<button class="btn btn-default" data-toggle="modal" data-target=".tambah">Tambah Item</button>
			<div class="hapus-data"></div>
			<table class="table table-bordered table-condensed table-striped table-hover">
				<thead>
					<tr>
						<th>Nomor</th>
						<th>Kategori</th>
						<th style="text-align: center">Nama Item</th>
						<th style="text-align: center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query = mysqli_query($con, "SELECT * FROM item_bahan_baku ORDER BY kategori");
					while($row = mysqli_fetch_assoc($query)){
						$no = 'ID'.sprintf('%04s', $row['id']);
						?>
						<tr>
							<td align="left"><?php echo $no ?></td>
							<td><?php if($row['kategori']==1) echo "Chemical"; else if($row['kategori']==2) echo "Pengemasan"; else if($row['kategori']==3) echo "Perlengkapan"; else if($row['kategori']==4) echo "Lain-Lain" ?></td>
							<td><?php echo $row['nama_item'] ?></td>
							<td align="center">
								<button class="btn btn-xs btn-danger remove-data" id="<?php echo $row['id'] ?>">X</button>				
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="modal fade tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  	<div class="modal-dialog modal-sm" role="document">
	    	<div class="modal-content">   		
	    		<div class="pesan"></div>
					<div style="overflow-x: ">
			      		<table class="table">
			      			<tr>
			      				<td>
				      				<select class="form-control" id="kategori">
				      					<option>--Pilih Kategori--</option>
				      					<?php 
				      					$query = mysqli_query($con, "SELECT DISTINCT kategori FROM item_bahan_baku ORDER BY kategori");
				      					while($row = mysqli_fetch_assoc($query)){
				      						if($row['kategori']==1) $kat="Chemical"; else if($row['kategori']==2) $kat="Pengemasan"; else if($row['kategori']==3) $kat="Perlengkapan"; else if($row['kategori']==4) $kat="Lain-Lain" ?>
				      						?>
				      						<option><?php echo $kat ?></option>
				      						<?php
				      					}
				      					?>
				      				</select>
				      			</td>
			      			</tr>
				      		<tr>
				      			<td><input class="form-control" type="text" name="item_baru" id="item_baru" placeholder="Nama Item Baru"></td>
				      		</tr>
				      		<tr>
				      			<td align="left"><input class="btn btn-md btn-success" type="submit" name="submit" id="submit" value="Simpan"></td>
				      		</tr>	      				
			      		</table>
					</div>	
			</div>
	  	</div>
	</div>


	<script type="text/javascript">
		$(document).ready(function(){
			$("#submit").click(function(){
				var kategori = $("#kategori").val();
				var item = $("#item_baru").val();
				$.ajax({
					type	: 'POST',
					url		: 'action/tambah_bahan_baku.php',
					data 	: 'kategori='+kategori+'&item='+item,
					success : function(data){
						$('.pesan').html(data);
					}
				})
			});

			$('.remove-data').click(function(){
				var hapus = 'hapus';
	            var kode = $(this).attr("id");
				$.ajax({
					type : 'post',
		            url : 'action/tambah_bahan_baku.php',
		            data :  'hapus=' + hapus + '&kode=' + kode,
		            success : function(data){
		            $('.hapus-data').html(data);//menampilkan data ke dalam modal
		            }
				})
			});
		})
	</script>