<?php
//Koneksi database
include '../config.php';
require "header.php";
$_SESSION['no_nota'] = $_POST['no_nota'];
$cari=$_SESSION['no_nota'];
if ( !empty ( $cari ) ) {
 
//Query sql untuk mencari data
$sql = mysqli_query($con,"SELECT * From reception where no_nota = '$cari' and spk=false LIMIT 1");
 
//Cek apakah data ditemukan
$row = mysqli_num_rows( $sql );
 
//Jika ditemukan maka tampilkan
if ( $row != 0 ) {
 
		while ( $data = mysqli_fetch_assoc( $sql ) ) 
		{
			?>
<div class="row">
 <div class="col-md-5 col-md-6 " >
 <form action="print.php" method="post">
<table id="semua" class="display" border="1">
<?php 
$query = "SELECT nama_customer,no_nota FROM reception WHERE no_nota='$cari'" ;
			$tampil = mysqli_query($con, $query);
			while($data = mysqli_fetch_array($tampil)){?>
			
			Nama : <?php echo $data['nama_customer'];?> ||
			No nota : <?php echo $data['no_nota'];
			?>
			<form method="get" action="print.php">
			 <input type="hidden" class="form-control" name="no_nota1" id="no_nota1" required="true" value="<?php echo $data['no_nota']; ?>"  >
			 	
			 </form>
			
			<?php	
				
			}
                       
?>
		<thead>
		<tr>
			<th>Item</th>
			<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM detail_spk WHERE no_nota='$cari'" ;
			$tampil = mysqli_query($con, $query);
			while($data = mysqli_fetch_array($tampil)){
                        ?>
				<tr>
						
						<td><?php echo $data['jenis_item'] ; ?></td>
						<td><?php echo $data['jumlah'] ; ?></td>
						
				 </tr>
				  <?php } 
 ?>   
		</tbody>
		<tfoot>
		<input type="hidden" class="form-control" id="no_nota" name="no_nota" value="<?php echo $cari ?>" />
			<tr>
          <td colspan="1"><div align="right">Total: </div></td>
          <td colspan="2"><div align="left">
		  <?php
		 
		  $query =mysqli_query($con, "SELECT sum(jumlah) as jumlah FROM detail_spk WHERE no_nota='$cari'");

			while($rows = mysqli_fetch_array($query))
			{
			echo $rows['jumlah']; 
		  }
		  ?>
		  
		  
		  </div></td>
        </tr>
		</tfoot>
	</table>
	<div class="form-group">
	 <div class="col-xs-10" align="center" >
	<input type="submit" value="Simpan" name="simpan" class="btn btn-primary">
	
	</div></div>
		</form>
	</div>
	
	
	
<div class="col-md-5 col-md-offset-2 col-md-6 col-md-offset-0" id="kotak2" >
<div>
       	 <div class="text">List Of Product </div>
     		<?php $sql = $con->query("SELECT * FROM item_spk"); ?>
			<?php while ( $r = $sql->fetch_assoc() ) { ?>
					
									<a href="javascript:;"
									data-id="<?php echo $r['id'] ?>"
									data-nama_item1="<?php echo $r['nama_item'] ?>"
									data-toggle="modal" data-target="#edit-data"> <?php echo $r['nama_item'] ?></a>
					
				<?php } ?>

			

	                  
  		</div><!-- /.col-lg-4 -->
  		</div>
		</div>

		  
<!-- Modal edit data -->
<div id="edit-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-input" method="post" action="spk_engine.php?p=update" class="form-horizontal">
				<input type="hidden" name="id" id="id">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Item
					</div>
					<div class="modal-body">

						  <fieldset>
 							<div class="form-group">
						      <label  class="control-label col-xs-3" for="nama_item1">Item</label>
						       <div class="col-xs-4" >
						       <input type="text" id="nama_item1" name="nama_item1" class="form-control" placeholder="item"></div></div>
						    <div class="form-group">
						      <label  class="control-label col-xs-3" for="jumlah">Jumlah</label>
						       <div class="col-xs-4" >
						      <input type="text" id="jumlah" autocomplete="off" name="jumlah" class="form-control jumlah" placeholder="Jumlah">
						      <input type="hidden" id="no_nota1" name="no_nota1" class="form-control" placeholder="no nota">
						    </div></div>
						    </fieldset>
					</div>
					<div class="modal-footer">
						<button class="btn btn-info btn-submit"><i class="fa fa-save"></i> Simpan</button>
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>


	<!-- Modal peringatan jika field belum terisi sempurna -->
	<div id="modal-peringatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm modal-warning">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="title">Peringatan</h4>
				</div>

				<div class="modal-body" style="background: #d9534f; color: #fff;">
					<div id="pesan-required-field"></div>
				</div>

				<div class="modal-footer">

					<center><button type="button" class="btn btn-default" data-dismiss="modal">OK</button></center>

				</div>

			</div>
		</div>
	</div>
<!-- modal konfirmasi-->
	<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Konfirmasi</h4>
				</div>

				<div class="modal-body" style="background:#d9534f;color:#fff">
					Apakah Anda yakin ingin menghapus data ini?
				</div>

				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-danger" id="hapus-true">Ya</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				</div>

			</div>
		</div>
	</div>




	<script>
	// Fungsi untuk pengiriman form baca dokumentasinya di https://github.com/malsup/form/
		function set_ajax(identifier){
		
		var options = {
			beforeSend: function() {
				
				$('#jumlah').focus();
				$(".btn-submit").attr("disabled",""); // Membuat button submit jadi tidak bisa terklik
			 
			},
			success:function(data, textStatus, jqXHR,ui) {

				if ( data.trim() == "Sukses" ) {
					$("#edit-data").modal('hide');
					$("#jumlah").val('');
					$(".btn-submit").removeAttr('disabled','');
					location.reload()
				} else {

					
					$("#pesan-required-field").html(data);
					$("#modal-peringatan").modal('show');
					$(".btn-submit").removeAttr('disabled','');
				}

			},
			error: function(jqXHR, textStatus, errorThrown){

				$(".progress-container").hide();
				$("#pesan-required-field").html('Gagal Memproses data<br/> textStatus='+textStatus+', errorThrown='+errorThrown);
				$("#modal-peringatan").modal('show');
			}
		 
		};
		 
		// kirim form dengan opsi yang telah dibuat diatas
		$("#"+identifier).ajaxForm(options);
	}

	$(function(){
		set_ajax('edit-data');

		// Hapus
		$('#modal-konfirmasi').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
			var id = div.data('id') 
			
			var modal = $(this)

			// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
			modal.find('#hapus-true').attr("href","spk_engine.php?p=hapus&id="+id); 

		});


		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
			var no_nota = $('#no_nota1').val();
 			var jumlah =$('#jumlah').val();
           //kode 1
           
			var id 	= div.data('id');
			var nama_item1 	= div.data('nama_item1');
			
			
			
			var modal 	= $(this)

			// Isi nilai pada field
		
			modal.find('#id').attr("value",id);
			modal.find('#nama_item1').attr("value",nama_item1);
			modal.find('#no_nota1').attr("value",no_nota);
			
			

		});

	});

</script>		
		
		
		
		
			<?php 
		}
		}

else 
{ 
echo "Tidak menemukan data"; }
 
}
