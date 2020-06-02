
<div class=" panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Daftar Item</h3>
	</div>
	<div class="panel-body">
		<div class="" style="overflow-x: auto">
			<table class="table table-condensed table-striped table-hover">
				<thead>
					<tr>
						<th>Nomor</th>
						<th>Jenis Akun</th>
						<th>kelompok_akun</th>
						<th>Nama Akun</th>
						<th>List Item</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query = mysqli_query($con, "SELECT nama_akun.kode_nama_akun, nama_akun.nama_akun, kelompok_akun.nama_kelompok_akun, jenis_akun.jenis_akun FROM ((nama_akun INNER JOIN kelompok_akun ON nama_akun.kode_kelompok_akun=kelompok_akun.kode_kelompok_akun) INNER JOIN jenis_akun ON kelompok_akun.id_jenis=jenis_akun.id_jenis) ");
					while($row = mysqli_fetch_assoc($query)){
						?>
						<tr>
							<td><?php echo $row['kode_nama_akun'] ?></td>
							<td><?php echo $row['jenis_akun'] ?></td>
							<td><?php echo $row['nama_kelompok_akun'] ?></td>
							<td><?php echo $row['nama_akun'] ?></td>
							<td>
								<button type="button" class="btn btn-default lihat-data" data-toggle="modal" data-target=".list_item" id="<?php echo $row['kode_nama_akun'] ?>"><i class="fa fa-list" aria-hidden="true"></i></button>
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

<div class="modal fade list_item" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">    	
        	<div class=" panel panel-success">
				<div class="panel-heading">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="panel-title">Daftar Item</h3>
				</div>
				<div class="panel-body list-data">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm">Tambah Item</button>	
				</div>
			</div>
    	</div>
  	</div>
</div>	



<script type="text/javascript">
	$(document).ready(function(){
		$('.lihat-data').click(function(){
            var kode = $(this).attr("id");
			$.ajax({
				type : 'post',
	            url : 'list_item.php',
	            data :  'kode='+ kode,
	            success : function(data){
	            $('.list-data').html(data);//menampilkan data ke dalam modal
	            }
			})
		})
	})
</script>