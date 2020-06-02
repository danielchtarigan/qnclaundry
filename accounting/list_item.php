<?php 
include 'config.php';
 
$query = mysqli_query($con, "SELECT nama_item.kode_item ,nama_item.nama_item, sub_akun.nama_sub_akun, sub_akun.kode_sub_akun FROM nama_item INNER JOIN sub_akun ON nama_item.kode_nama_sub_akun=sub_akun.kode_sub_akun WHERE sub_akun.kode_nama_akun='$_POST[kode]' ");
$cek_data = mysqli_num_rows($query);

?>

<button type="button" class="btn btn-default" data-toggle="modal" data-target=".tambah">Tambah Item</button>
				<?php 
				if($cek_data>0){
					
				}

				?>
	<div class="" style="overflow-x: auto">
		<table class="table table-condensed table-striped">
			<thead>
				<tr>
					<th>Nomor Item</th>
					<th>Sub Akun</th>
					<th>Nama Item</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($cek_data>0){
					while($row = mysqli_fetch_assoc($query)){
						?>
						<tr>
							<td><?php echo $row['kode_item'] ?></td>
							<td><?php echo $row['nama_sub_akun'] ?></td>
							<td><?php echo $row['nama_item'] ?></td>
							<td>
								<button class="btn btn-xs btn-info edit-data" data-toggle="modal" data-target=".edit" id="<?php echo $row['kode_item'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
								<button class="btn btn-xs btn-danger remove-data" data-toggle="modal" data-target=".removex" id="<?php echo $row['kode_item'] ?>">X</button>
							</td>
						</tr>
						<?php
					}
				} else { ?>
					<tr class="odd gradeX">
                        <td colspan="7" align="center">..Item Tidak Ada..</td>
                    </tr>
				<?php 
				}
				?>	
				
			</tbody>
		</table>
	</div>


	<div class="modal fade tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  	<div class="modal-dialog modal-sm" role="document">
	    	<div class="modal-content">
					<div class="pesan-sukses"></div>					
					<div style="overflow-x: auto">
			      		<table class="table">
			      			<tr>
			      				<td>
				      				<select class="form-control" id="kode_sub_akun">
				      					<option>--Pilih Sub Akun--</option>
				      					<?php 
				      					$query = mysqli_query($con, "SELECT * FROM sub_akun WHERE kode_nama_akun='$_POST[kode]'");
				      					while($row = mysqli_fetch_assoc($query)){
				      						?>
				      						<option><?php echo $row['kode_sub_akun'].' - '.$row['nama_sub_akun'] ?></option>
				      						<?php
				      					}
				      					?>
				      				</select>
				      			</td>
			      			</tr>
				      		<tr>
				      			<td><input class="form-control" type="text" name="item_baru" id="item_baru"></td>
				      		</tr>
				      		<tr>
				      			<td align="left"><input class="btn btn-md btn-success" type="submit" name="submit" id="submit" value="Simpan"></td>
				      		</tr>	      				
			      		</table>
					</div>
				</div>      		
	    	</div>
	  	</div>
	</div>

	<div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  	<div class="modal-dialog modal-sm" role="document">
	    	<div class="modal-content">    		
	    		<div class="edit-item"></div>		
	    	</div>
	  	</div>
	</div>

	<div class="modal fade removex" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  	<div class="modal-dialog modal-sm" role="document">
	    	<div class="modal-content">    		
	    		<div class="hapus-item"></div>		
	    	</div>
	  	</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#submit").click(function(){			
				var kode = $("#kode_sub_akun").val();
				var item_baru = $("#item_baru").val();
				$.ajax({
					type : 'post',
		            url : 'action/tambah_item.php',
		            data :  'kode='+ kode +'&item_baru=' + item_baru,
		            success : function(data){
		            $('.pesan-sukses').html(data);//menampilkan data ke dalam modal
		            }
				})
			});

			$('.edit-data').click(function(){
	            var kode = $(this).attr("id");
				$.ajax({
					type : 'post',
		            url : 'edit_item.php',
		            data :  'kode='+ kode,
		            success : function(data){
		            $('.edit-item').html(data);//menampilkan data ke dalam modal
		            }
				})
			});

			$('.remove-data').click(function(){
	            var kode = $(this).attr("id");
				$.ajax({
					type : 'post',
		            url : 'edit_item.php',
		            data :  'kodex='+ kode,
		            success : function(data){
		            $('.hapus-item').html(data);//menampilkan data ke dalam modal
		            }
				})
			});
		})
	</script>