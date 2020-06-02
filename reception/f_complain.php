<?php
//Koneksi database
include '../config.php';
session_start();
$cari = $_GET['cari'];
if ( !empty ( $cari ) ) {
 
//Query sql untuk mencari data
$sql = mysqli_query($con,"SELECT * From reception where no_nota = '$cari' and datediff(current_date(),DATE_FORMAT(tgl_ambil, '%Y-%m-%d')) <= 3 LIMIT 1");
 
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
    var jenis_komplain   = $('#jenis_komplain').val();
    var ket   = $('#ket').val();
    var nama_customer   = $('#nama_customer').val();
    
    
    if ( no_nota == "" ){
				alert("no nota Masih Kosong");
				$("#no_nota").focus();
				return false;
			}
			else if ( jenis_komplain== "" ){
				alert("jenis komplain Masih Kosong");
				$("#jenis_komplain").focus();
				return false;
			}
			else if ( ket== "" ){
				alert("keterangan Masih Kosong");
				$("#ket").focus();
				return false;
			}
   
    
        
   
    $.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : 'savekomplain.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'no_nota='+no_nota+'&jenis_komplain='+jenis_komplain+'&ket='+ket+'&nama_customer='+nama_customer,
        success  : function(respons){
            $('#pesan_kirim').html(respons);
            $("#form-input")[0].reset();
            $("#no_nota").val('');
            $("#nama_customer").val('');
            $("#tgl_ambil").val('');
            $('#pesan_kirim').hide();
            printout()
        },
    })
}
     </script>
     <script type="text/javascript">
        $(function() {
            $("#add").focus();
        });
    </script>
      <script type="text/javascript">
     function printout() {

    var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("pesan_kirim").innerHTML);
    newWindow.print();
}
    </script>

		<form method="post" action="" id="form-input" class="form-horizontal">
		<div id="pesan_kirim" style="display:none"></div>
  		<div class="form-group">
  		
  		<label class="control-label col-xs-3" for="no_nota">No Nota</label> <div class="col-xs-4"> <input type="text" class="form-control" name="no_nota" id="no_nota" required="true" value="<?php echo $data['no_nota']; ?>" readonly="true" >
  		</div></div>
  		<div class="form-group">
  		
  		<label class="control-label col-xs-3" for="no_nota">Tanggal Ambil</label> <div class="col-xs-4">
  		 <input type="text" class="form-control" name="tgl_ambil" id="tgl_ambil" required="true" value="<?php echo $data['tgl_ambil']; ?>" readonly="true" >
  		</div></div>
  		
  		<div class="form-group" >
  		<label class="control-label col-xs-3" for="nama_customer">Nama Customer</label>
		<div class="col-xs-4"> <input type="text" class="form-control" name="nama_customer" id="nama_customer" required="true" value="<?php echo $data['nama_customer']; ?>" readonly="true" ></div>
		</div>
		
		 <div class="form-group"> 
     	<label class="control-label col-xs-3" for="jenis_komplain">Jenis Komplain</label>
	 <div class="col-xs-4" >
	<select class="form-control" name="jenis_komplain" id="jenis_komplain">
        <option value="">--</option>
        <option value="kebersihan">Kebersihan</option>
        <option value="kerapian">Kerapian</option>
        <option value="keharuman">Keharuman</option>
        <option value="kehilangan">Kehilangan</option>
        <option value="lain">Lain-lain</option>

    </select>
</div>
     </div>
     <div class="form-group">
  		<label class="control-label col-xs-3" for="nama_customer">Keterangan</label>
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
echo "Tanggal Ambil Lebih dari 3 hari"; }
 
}
