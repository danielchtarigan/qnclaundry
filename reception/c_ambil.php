<?php
//Koneksi database
include '../config.php';
session_start();
$cari = $_GET['cari'];
if ( !empty ( $cari ) ) {
 
//Query sql untuk mencari data
$sql = mysqli_query($con,"SELECT * From reception where no_nota = '$cari' and kembali=true and ambil=false LIMIT 1");
 
//Cek apakah data ditemukan
$row = mysqli_num_rows( $sql );
 
//Jika ditemukan maka tampilkan
if ( $row != 0 ) {
 
		while ( $data = mysqli_fetch_assoc( $sql ) ) 
		{
			?><br/>
	<script>
	 
	function kirim_form(){
		
    $('#pesan_kirim').html('Loading ...');
    $('#pesan_kirim').slideDown('slow');
     
    var no_nota   = $('#no_nota').val();
   
    
        
   
    $.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : 'save_ambil.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'no_nota='+no_nota,
        success  : function(respons){
            $('#pesan_kirim').html(respons);
            $("#form-input")[0].reset();
            $("#no_nota").val('');
             $("#nama_customer").val('');
        },
    })
}
     </script>
     <script type="text/javascript">
        $(function() {
            $("#add").focus();
        });
    </script>
		<form method="post" action="" id="form-input" class="form-horizontal">
		<div id="pesan_kirim" style="display:none"></div>
  		<div class="form-group">
  		
  		<label class="control-label col-xs-3" for="no_nota">No Nota</label> <div class="col-xs-4"> <input type="text" class="form-control" name="no_nota" id="no_nota" required="true" value="<?php echo $data['no_nota']; ?>" readonly="true" >
  		</div></div>
  		
  		<div class="form-group" >
  		<label class="control-label col-xs-3" for="nama_customer">Nama Customer</label>
		<div class="col-xs-4"> <input type="text" class="form-control" name="nama_customer" id="nama_customer" required="true" value="<?php echo $data['nama_customer']; ?>" readonly="true" ></div>
		</div>
		<div class="form-group">
      <div class="col-sm-offset-3 col-sm-10">
	<input type="button" value="Simpan" name="add" id="add" onclick="kirim_form();" class="btn btn-primary">
	</div></div>

	</form>
			<?php 
		}
		}
else 
{ 
echo "Tidak menemukan data"; }
 
}
