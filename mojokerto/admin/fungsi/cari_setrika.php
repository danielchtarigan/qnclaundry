<?php
//Koneksi database
include '../../../config.php';
session_start();
$cari = $_GET['cari'];





if ( !empty ( $cari ) ) {
 
//Query sql untuk mencari data
$sql = mysqli_query($con,"SELECT * From reception where no_nota = '$cari' and setrika=false LIMIT 1");
 
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
    var jumlah1 = $('#jumlah1').val();
    var jumlah = $('#jumlah').val();
    
    var ket = $('#ket').val();
    var no_mesin = $('#no_mesin').val();
    if(jumlah1 == '' || no_mesin == ''){
		alert("Tolong Jumlah ama no mesin di isi");
		exit();
	}
	if(jumlah1 != jumlah ){
		alert("jumlah tidak ama no mesin di isi");
		exit();
	} else 
	{
		
		
    
   
    $.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : '../fungsi/save_setrika.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'no_nota='+no_nota+'&jumlah1='+jumlah1+'&ket='+ket+'&no_mesin='+no_mesin,
        success  : function(respons){
            $('#pesan_kirim').html(respons);
            $("#form-input")[0].reset();
            $("#no_nota").val('');
            $("#nama_customer").val('');
            $("#jumlah").val('');
        },
    })
}
}
     </script>
     <script type="text/javascript">
        $(function() {
            $("#jumlah1").focus();
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
  	<label class="control-label col-xs-3" for="nama">Jumlah</label><div class="col-xs-4">
  	<input type="text" class="form-control" name="jumlah" id="jumlah" required="true" value="<?php echo $data['jumlah']; ?>" readonly="true" ></div>
  		</div>
  		<div class="form-group">
  		<label class="control-label col-xs-3" for="ket">Keterangan</label>
  		<div class="col-xs-5">
  		<textarea type="text" class="form-control" name="ket" id="ket" required="true" value="<?php echo $data['ket']; ?>" readonly="true" ></textarea></div>
  		</div>
		<div class="form-group">
		<label  class="control-label col-xs-3 col-xs-3" for="jumlah1">Jumlah</label>
  		<div class="col-xs-4"><input type="number" class="form-control" name="jumlah1" id="jumlah1" required="true" ></div>
		</div>
		<div class="form-group">
		<label  class="control-label col-xs-3 col-xs-3" for="berat">Berat</label>
  		<div class="col-xs-4"><input type="number" type="any" class="form-control" name="berat" id="berat" required="true" ></div>
		</div>
		
		<div class="form-group"> 
     	<label class="control-label col-xs-3" for="setrika">Setrika</label>
	 <div class="col-xs-4" >
	<select class="form-control" name="setrika" id="setrika" required=true>
        <option value="">--</option>';				

			<?php
			
			$query = "select * from user where level='setrika'";
			$hasil = mysqli_query($con,$query);
			while ($qtabel = mysqli_fetch_assoc($hasil))
			{
                              
				echo '<option value="'.$qtabel['name'].'">'.$qtabel['name'].'</option>';				
			}
			?>


    </select>
</div>
     </div>
		
		
		
		
		<div class="form-group">
  		<label class="control-label col-xs-3" for="ket">Keterangan</label>
  		<div class="col-xs-4">
  		<textarea type="text" class="form-control" name="ket" id="ket"></textarea>
		</div>
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
echo 'setrika :'.$data1['op_setrika']."<br>";
echo 'tgl setrika :'.$data1['tgl_setrika'];


}
 
}
