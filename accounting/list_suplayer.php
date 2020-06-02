
<div class=" panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Daftar Supplier</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-12" style="overflow-x: auto">
			<button class="btn btn-default tambah-spl" data-toggle="modal" data-target=".tambah">Supplier Baru</button>
			<div class="hapus-data"></div>
			<div class="pesan-data"></div>
			<table class="table table-bordered table-condensed table-striped table-hover">
				<thead>
					<tr>
						<th>Nomor</th>
						<th width="">Nama Supplier</th>
						<th width="30%">Alamat</th>
						<th>Telepon</th>
						<th>Nama Kontak</th>
						<th>PPN (%)</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query = mysqli_query($con, "SELECT * FROM supplier ORDER BY id DESC");
					while($row = mysqli_fetch_assoc($query)){
						$date = date('Y-m-d');
						$th = substr(date('Y'), 2) ;
						$bl = date('m');
						$no = 'SP'.$th.$bl.'-'.sprintf('%03s', $row['id']);
						?>
						<tr>
							<td align="left"><?php echo $no ?></td>
							<td><?php echo ucwords($row['nama_supplier']) ?></td>
							<td><?php echo $row['alamat'] ?></td>
							<td><?php echo $row['phone'] ?></td>
							<td><?php echo $row['contact'] ?></td>
							<td><?php echo $row['ppn']; ?></td>
							<td align="center">
								<button class="btn btn-xs btn-danger remove-data" id="<?php echo $row['id'] ?>">X</button>
								<button class="btn btn-xs btn-warning sunting-data" data-id="<?= $row['id'] ?>">Sunting</button>	
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
	    		<h4 align="center">Tambah Vendor/Supplier</h4>
	    		<div class="pesan"></div>
					<div>
			      		<table class="table">			      			
				      		<tr>
				      			<td style="border-style: none"><input class="form-control" type="text" name="supplier_baru" id="supplier_baru" placeholder="Nama supplier"></td>
				      		</tr>
				      		<tr>
				      			<td style="border-style: none"><input class="form-control" type="text" name="alamat_spl" id="alamat_spl" placeholder="Alamat"></td>
				      		</tr>
				      		<tr>
				      			<td style="border-style: none"><input class="form-control" type="text" name="phone" id="phone" placeholder="Telepon"></td>
				      		</tr>
				      		<tr>
				      			<td style="border-style: none"><input class="form-control" type="text" name="contact_name" id="contact_name" placeholder="Nama Kontak"></td>
				      		</tr>
				      		<tr>
				      			<td style="border-style: none"><input class="form-control" type="text" name="ppn" id="ppn" placeholder="PPN"></td>
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
				var tambah = 'tambah';
				var spl = $("#supplier_baru").val();
				var alamat = $('#alamat_spl').val();
				var phone = $('#phone').val();
				var cont = $('#contact_name').val();
				var ppn = $('#ppn').val();

				if(spl=="" || ppn=="" || alamat=="" || phone=="" || cont==""){
					$('.pesan').html("inputan tidak boleh kosong!").css({"color": "red", "text-align": "center"});
				}
				else {
					$.ajax({
						type	: 'POST',
						url		: 'action/tambah_supplier.php',
						data 	: {tambah:tambah, spl:spl, alamat:alamat, phone:phone, cont:cont, ppn:ppn},
						success : function(data){
							$('.pesan').html(data).css({"color": "green", "text-align": "center"});
							window.location = "";
						}
					});
				}

					
			});

			$('td').on('click', '.remove-data', function(){
				var hapus = 'hapus';
	            var kode = $(this).attr("id");
				$.ajax({
					type : 'post',
		            url : 'action/tambah_supplier.php',
		            data :  'hapus=' + hapus + '&kode=' + kode,
		            success : function(data){
		            $('.hapus-data').html(data);//menampilkan data ke dalam modal
		            }
				})
			});

			$('table').on('keypress', '#phone, #ppn', function(e){       
		        var phone = $(this).val();       
		        if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
		           $('.pesan').html("isi dengan angka!").css({"color": "red", "text-align": "center"});
		             return false;
		        }       
		    });

		    $('.sunting-data').on('click', function(e){
		    	var id = $(this).data('id');
		    	
		    	$.ajax({
		    		url 	: 'sunting_supplier.php',
		    		method 	: 'POST',
		    		data 	: 'id='+id,
		    		success : function(data){
		    			$('tbody').html(data);
		    			$('.tambah-spl').addClass('hidden');
		    		}
		    	})
		    });


		})
	</script>