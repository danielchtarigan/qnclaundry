<p align='canter'><strong>FORM QUALITY AUDIT</strong></p>
<?php
$cari = $_GET['cari'];
if ( !empty ( $cari ) ) {
    if($ot="mojokerto") {
        $sql = mysqli_query($con,"SELECT * From reception where no_nota = '$cari' LIMIT 1");
    }
    else {
        $sql = mysqli_query($con,"SELECT * From reception where no_nota = '$cari' and datediff(current_date(),DATE_FORMAT(tgl_ambil, '%Y-%m-%d')) <= 4 LIMIT 1");
    }
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
    var nama_customer   = $('#nama_customer').val();
    var bersih   = $('#bersih').val();
    var harum   = $('#harum').val();
    var rapi   = $('#rapi').val();
    var waktu   = $('#waktu').val();
    var jumlah   = $('#jumlah').val();
    var ket   = $('#ket').val();
    
    if ( no_nota == "" ){
				alert("no nota Masih Kosong");
				$("#no_nota").focus();
				return false;
			}
			else if ( bersih== "" ){
				alert("bersih Masih Kosong");
				$("#bersih").focus();
				return false;
			}
			else if ( harum== "" ){
				alert("harum Masih Kosong");
				$("#harum").focus();
				return false;
			}
			else if ( rapi== "" ){
				alert("rapi Masih Kosong");
				$("#rapi").focus();
				return false;
			}
			else if ( waktu== "" ){
				alert("waktu Masih Kosong");
				$("#waktu").focus();
				return false;
			}
			else if ( jumlah== "" ){
				alert("jumlah Masih Kosong");
				$("#jumlah").focus();
				return false;
			}
			else if ( ket== "" ){
				alert("keterangan Masih Kosong");
				$("#ket").focus();
				return false;
			}
   
    
        
   
    $.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : 'saveqa.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'no_nota='+no_nota+'&ket='+ket+'&nama_customer='+nama_customer+'&bersih='+bersih+'&harum='+harum+'&rapi='+rapi+'&jumlah='+jumlah+'&waktu='+waktu,
        success  : function(respons){
            $('#pesan_kirim').html(respons);
            $("#form-input")[0].reset();
            $("#no_nota").val('');
            $("#nama_customer").val('');
            $("#tgl_ambil").val('');
            
            
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
</div>
</div>
<div class="form-group">
<label class="control-label col-xs-3" for="no_nota">Tanggal Ambil</label>
<div class="col-xs-4">
<input type="text" class="form-control" name="tgl_ambil" id="tgl_ambil" required="true" value="<?php echo $data['tgl_ambil']; ?>" readonly="true" >
</div>
</div>
<div class="form-group" >
  		<label class="control-label col-xs-3" for="nama_customer">Nama Customer</label>
		<div class="col-xs-4">
		<input type="text" class="form-control" name="nama_customer" id="nama_customer" required="true" value="<?php echo $data['nama_customer']; ?>" readonly="true" >
			
		</div>
</div>		
<div class="form-group" >
  		<label class="control-label col-xs-3" for="nama_customer">Kebersihan</label>
		<div class="col-xs-4">
		<input type="number" class="form-control" name="bersih" id="bersih" required="true" >
			
		</div>
</div>
<div class="form-group" >
  		<label class="control-label col-xs-3" for="nama_customer">Keharuman</label>
		<div class="col-xs-4">
		<input type="number" class="form-control" name="harum" id="harum" required="true" >
			
		</div>
</div>
<div class="form-group" >
  		<label class="control-label col-xs-3" for="nama_customer">Kerapian</label>
		<div class="col-xs-4">
		<input type="number" class="form-control" name="rapi" id="rapi" required="true"  >
			
		</div>
</div>
	<div class="form-group"> 
	<label class="control-label col-xs-3" for="waktu">Ketepatan Waktu</label>
	 <div class="col-xs-4" >
	<select class="form-control" name="waktu" id="waktu">
	<option value="">--</option>
        <option value="ya">Ya</option>
        <option value="tidak">Tidak</option>
    	  </select>
</div>
     </div>
     	<div class="form-group"> 
	<label class="control-label col-xs-3" for="Jenis">Ketepatan Jumlah</label>
	 <div class="col-xs-4" >
	<select class="form-control" name="jumlah" id="jumlah">
	<option value="">--</option>
        <option value="ya">Ya</option>
        <option value="tidak">Tidak</option>
    	  </select>
</div>
     </div>
<div class="form-group">
<label class="control-label col-xs-3" for="nama_customer">Kritik dan Saran</label>
<div class="col-xs-4" >
<textarea type="text" class="form-control" name="ket" id="ket"></textarea>
</div>
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
echo "Tanggal Ambil Lebih dari 4 hari. Cari nota lain yang pengambilannya tidak lebih dari 4 hari"; }
 
}
