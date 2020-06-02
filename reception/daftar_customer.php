<?php
include 'header.php';
include '../config.php';
function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
?>
<button class="btn btn-md  btn-success" data-id='0' data-toggle="modal" data-target="#tambah-customer">Tambah Data</button>
<a class="btn btn-sm btn-danger" href="d_lgn.php">Transaksi Langganan</a>
<a class="btn btn-sm btn-info" href="d_member.php">Transaksi Member</a>
 <br /><br />
<table id="tbl_cst" class="display">
	<thead>
		<tr>
			<th>Nama</th>
			<th>Alamat</th>
			<th>No Telp</th>
			<th>Member</th>
			<th>Langganan</th>
			<th>Pilih</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM customer";
			$tampil = mysqli_query($con, $query);
				while($r = mysqli_fetch_array($tampil)){
				if($r['member']=='1') {
    			$member = $r['jenis_member'];
   				} else {
		      $member = "";
		   }
		   if($r['lgn']=='1') {
    			$lgn = rupiah($r['sisa_kuota']);
   				} else {
		      $lgn = "";
		   }
				?><tr>	<td><?php echo $r['nama_customer']; ?></td>
				<td><?php echo $r['alamat']; ?></td>
				<td><?php echo $r['no_telp']; ?></td>
				<td><?php echo $member ?></td>
				<td><?php echo $lgn ?></td>
				<td style="text-align:center;width:200px">

								<a  class="btn btn-xs btn-danger" href="javascript:;"
									data-id="<?php echo $r['id'] ?>"
									data-nama_customer="<?php echo $r['nama_customer'] ?>"
									data-alamat="<?php echo $r['alamat'] ?>"
									data-no_telp="<?php echo $r['no_telp'] ?>"
									data-toggle="modal" data-target="#tambah-lgn">
			 Langganan

								</a>
								<a  class="btn btn-xs btn-success" href="javascript:;"
									data-idmember="<?php echo $r['id'] ?>"
									data-nama_customer="<?php echo $r['nama_customer'] ?>"
									data-alamat="<?php echo $r['alamat'] ?>"
									data-no_telp="<?php echo $r['no_telp'] ?>"
									data-jenis="<?php echo $r['jenis_member'] ?>"
									data-toggle="modal" data-target="#tambah-mbr">
			 Member

								</a>
				</td>
				</tr>
					<?php } 
					?>
		</tbody>
		</table>
			<!-- Modal tambah langganan-->
		<div id="tambah-lgn" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="" class="contac" name="contact">
				<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Jadikan Langganan</h4>
					</div>

					<div class="modal-body">

						  <fieldset>
							<div class="form-group">
						      <label for="no_telp">No Telp</label>
						      <input type="text" id="no_telp" name="no_telp" class="form-control" placeholder="Masukkan password">
						    </div>
						    <div class="form-group">
						      <label for="nama_customer">nama_customer</label>
						      <input type="text" name="nama_customer" id="nama_customer" class="form-control" placeholder="Masukkan nama_customer">
						    </div>

						    <div class="form-group">
						      <label for="nama">Alamat</label>
						      <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukkan Nama">
						    </div>

						    
						  </fieldset>

						
					</div>

					<div class="modal-footer">
						<button class="btn btn-danger" id="add" class="btn">Langganan</button>
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
		<!-- Modal tambah Member -->
		<div id="tambah-mbr" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="" class="contac" name="contact">
				<input type="hidden" name="idmember" id="idmember">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Jadikan Member</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

<div class="col-xs-8 col-xs-8">
						    <div class="form-group">
						      <label for="nama_customer" class="control-label col-xs-4">nama_customer</label><div class="col-xs-8">
						      <input type="text" name="nama_customer" id="nama_customer" class="form-control" placeholder="Masukkan nama_customer"></div>
						    </div><br>

						    <div class="form-group">
						      <label for="nama" class="control-label col-xs-4">Alamat</label><div class="col-xs-8">
						      <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukkan Nama"></div>
						    </div><br>

						    <div class="form-group">
						      <label for="no_telp" class="control-label col-xs-4">No Telp</label><div class="col-xs-8">
						      <input type="text" id="no_telp" name="no_telp" class="form-control" placeholder="Masukkan password">
						    </div></div><br>
						    <div class="form-group"> 
								<label class="control-label col-xs-4" for="Jenis">Jenis</label>
								 <div class="col-xs-8" >
							<select class="form-control" name="jenis" id="jenis">
							<option value="">Pilih Membership</option>
							 <option value="Blue 3 Bulan">Blue 3 Bulan</option>
							 <option value="Blue 6 Bulan">Blue 6 Bulan</option>
							 <option value="Blue 12 Bulan">Blue 12 Bulan</option>
							 <option value="Red">RED</option>
							    </select>
								</div>
							     </div><br>
							    <div class="form-group">
						      <label for="no_telp" class="control-label col-xs-4">Tgl Join</label><div class="col-xs-8">
						      <input type="text" name="tgl_join" class="form-control" id="tgl_join">
						    </div></div><br>
						    <div class="form-group">
						      <label for="no_telp" class="control-label col-xs-4">Tgl Akhir</label><div class="col-xs-8">
						       <input type="text" name="tgl_akhir" class="form-control" id="tgl_akhir">
						    </div></div>			    
						   
						  </fieldset>

						
					</div>

					<div class="modal-footer">
						<button class="btn btn-success" id="addmember" class="btn">Member</button>
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	
	<!-- Modal tambah data -->
	<div id="tambah-customer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Customer</h4>
					</div>

					<div class="modal-body">

						  <fieldset>
							 <div class="form-group">
						      <label for="Notelp">No Telp</label><span id="pesan"></span>
						      <input type="text" name="no_telp1" id="no_telp1" class="form-control" placeholder="Masukkan no telp">
						     
						    </div>
						     <span id="user-result"></span>
						    <div class="form-group">
						      <label for="nama_customer">Nama Customer</label>
						      <input type="text" name="nama_customer1" id="nama_customer1" class="form-control" placeholder="Masukkan nama customer">
						    </div>

						    <div class="form-group">
						      <label for="alamat">alamat</label>
						      <input type="text" name="alamat1" id="alamat1" class="form-control" placeholder="Masukkan Alamat">
						    </div>

						   
						</fieldset>

						

					</div>

					<div class="modal-footer">
						<button class="btn btn-success" id="addcustomer" class="btn">Tambah</button>
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	
<script> $(document).ready(function() { 
$('#tbl_cst').dataTable();

} );
	</script>
<script>
$(function() {
    $( "#tgl_join" ).datepicker({ dateFormat: 'yy-mm-dd' });
     $( "#tgl_akhir" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
</script>	
<script>
$(function(){

		$('#tambah-lgn').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			
			var id 	= div.data('id');
			var nama_customer 	= div.data('nama_customer');
			var no_telp 	= div.data('no_telp');
			var alamat 	= div.data('alamat');

			var modal 	= $(this)

			// Isi nilai pada field
		
			modal.find('#id').attr("value",id);
			modal.find('#nama_customer').attr("value",nama_customer);
			modal.find('#alamat').attr("value",alamat);
			modal.find('#no_telp').attr("value",no_telp);


		});
		$('#tambah-mbr').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			
			var id 	= div.data('idmember');
			var nama_customer 	= div.data('nama_customer');
			var jenis 	= div.data('jenis');
			var no_telp = div.data('no_telp');
			var alamat 	= div.data('alamat');

			var modal 	= $(this)

			// Isi nilai pada field
		
			modal.find('#idmember').attr("value",id);
			modal.find('#nama_customer').attr("value",nama_customer);
			modal.find('#alamat').attr("value",alamat);
			modal.find('#no_telp').attr("value",no_telp);
			modal.find('#jenis option').each(function(){
				  if ($(this).val() == jenis )
				    $(this).attr("selected","selected");
			});

		});

	});

</script>

<script>
		        var id;
                var nama_customer;
                var jenis;
                var tgl_join;
                var tgl_akhir;
                var alamat1;
                var no_telp1;
                 var nama_customer1;
                  $("#no_telp1").change(function(){
                        var no_telp=$("#no_telp1").val();
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=telp&no_telp="+no_telp,
                            success:function(data){
                                if(data==0){
                                    $("#pesan").html('no telp Bisa digunakan');
                                    $("#no_telp1").css('border','3px #090 solid');
                                    $("#addcustomer").removeAttr('disabled','');
                                  
                                }else{
                                    $("#pesan").html('no telp sudah ada');
                                    $("#no_telp1").css('border','3px #c33 solid');
                                    $("#addcustomer").attr("disabled","");
                                    
                                
                                }
                            }
                        });
                    })
              
$(function(){
    	
     	$("#add").click(function()
     	{
  					   
                        id=$("#id").val();
                       
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=up_cst_lgn&id="+id,
                           	success:function(msg)
                            {
                            	

                            	
                            	$("#tambah-lgn").modal('hide');
                       			
     
                            }
                          
                        })
                    location.reload(); })
              	$("#addmember").click(function()
     	{
  					   
                        id=$("#idmember").val();
                      
                        jenis=$("#jenis").val();
                        tgl_join=$("#tgl_join").val();
                        tgl_akhir=$("#tgl_akhir").val();
                        
                        
                         if ( tgl_join == "" ){
				alert("tgl join Masih Kosong");
				$("#tgl_join").focus();
				return false;
			} else if ( tgl_akhir == "" ){
				alert("tgl akhir Masih Kosong");
				$("#tgl_akhir").focus();
				return false;
			}
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=up_cst_member&id="+id+"&jenis="+jenis+"&tgl_join="+tgl_join+"&tgl_akhir="+tgl_akhir,
                           
                            success:function(msg)
                            {
                            	$("#tambah-mbr").modal('hide');
                       			
                            }
                        })
                    location.reload();   
      })
                    $("#addcustomer").click(function()
     	{
  					   
                      
                        nama_customer1=$("#nama_customer1").val();
                        alamat1=$("#alamat1").val();
                        no_telp1=$("#no_telp1").val();
                       
                        
                        
			                 if ( nama_customer1 == "" ){
							alert("Nama Masih Kosong");
							$("#nama_customer1").focus();
							return false;
							} else if ( alamat1 == "" ){
							alert("alamat Masih Kosong");
							$("#alamat1").focus();
							return false;
						}else if ( no_telp1 == "" ){
							alert("no telp Masih Kosong");
							$("#no_telp1").focus();
							return false;
						}
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=tambah_customer&nama_customer1="+nama_customer1+"&alamat1="+alamat1+"&no_telp1="+no_telp1,
                          
                            success:function(msg)
                            {
                            	$("#tambah-customer").modal('hide');
                       			 
     
                            }
                        })
                        location.reload();
                    })

 });
                    
     	
     </script>		
		