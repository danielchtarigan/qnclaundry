<?php
//Koneksi database
include '../config.php';
session_start();
$cari = $_GET['cari'];





if ( !empty ( $cari ) ) {
 
//Query sql untuk mencari data
$sql = mysqli_query($con,"SELECT * From reception where no_nota = '$cari' and cuci=false LIMIT 1");
 
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
    var nama_customer = $('#nama_customer').val();
    var alasan = $('#alasan').val();
    var no_mesin = $('#no_mesin').val();
   if(no_nota == '' || alasan == '')
					{
						alert("Tolong alasan di isi");
						exit();
					}
					 else
					{
		
		
    
   
    $.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : 'saverijeck.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'no_nota='+no_nota+'&nama_customer='+nama_customer+'&alasan='+alasan,
        success  : function(respons){
            $('#pesan_kirim').html(respons);
            $("#form-input")[0].reset();
            $("#no_nota").val('');
            $("#nama_customer").val('');
            $("#alasan").val('');
        },
    })
}
}
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
  		<label class="control-label col-xs-3" for="ket">Alasan</label>
  		<div class="col-xs-5">
  		<textarea type="text" class="form-control" name="alasan" id="alasan" required="true" ></textarea></div>
  		</div>
	


	<div class="form-group">
	<input type="button" value="Simpan" name="add" id="add" onclick="kirim_form();" class="btn btn-primary">
	</div>

	</form>
			<?php 
		}
		}
else 
{ 
$sql1 = mysqli_query($con,"SELECT * From reception where no_nota = '$cari' LIMIT 1");
$data1 = mysqli_fetch_assoc( $sql1 );
echo "Tidak menemukan data bu <br>"; 
echo 'cuci :'.$data1['op_cuci']."<br>";
echo 'tgl Cuci :'.$data1['tgl_cuci'];


}
 
}
