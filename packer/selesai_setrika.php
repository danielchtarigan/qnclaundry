<?php
//Koneksi database
include '../config.php';
include 'header.php';
$no_nota = $_GET['no_nota'];
$sql=$con->query("select * from reception WHERE no_nota = '$no_nota' LIMIT 1");
$data = $sql->fetch_assoc();
$id_cs=$data['id_customer'];

$sql2=$con->query("select * from setrika_sementara WHERE no_nota = '$no_nota' LIMIT 1");
$data2 = $sql2->fetch_assoc();
$nama=$data2['user_setrika'];
?>
<div  class="container-fluid" style="width:500px;
   margin:0 auto; 
   position:relative; 
   border:3px solid rgba(0,0,0,0); 
   -webkit-border-radius:5px; 
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">
   <marquee behavior=alternate style="font-size: 25px;color: #ff0000"  > <h1>Selesai Di Setrika</h1></marquee>
		<form method="post" action="" id="form-input" class="form-horizontal">
		<div id="pesan_kirim" style="display:none"></div>
		 <input type="hidden" class="form-control" name="id_cs" id="id_cs" required="true" value="<?php echo $id_cs; ?>" readonly="true" >
		
		<div class="form-group">
		<label class="control-label col-xs-3" for="no_nota">No Nota</label> <div class="col-xs-4"> <input type="text" class="form-control" name="no_nota" id="no_nota" required="true" value="<?php echo $no_nota; ?>" readonly="true" >
  		</div>
  		</div>
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
  		
  		<div class="form-group" >
  		<label class="control-label col-xs-3" for="setrika">Setrika</label>
		<div class="col-xs-4">
			 <input type="text" class="form-control" name="setrika" id="setrika" required="true" value="<?php echo $nama; ?>" readonly="true" >
		</div>
		</div>
  		
  		<div class="form-group">
  		<label class="control-label col-xs-3" for="hp">Berat</label>
 <div class="col-xs-4" >
  		<input type="number" step="any" hidden="true" class="form-control" value="<?php echo $data['berat']; ?>" readonly="true" name="berat" id="berat" required>
		</div></div>
		
	
	<div class="form-group">
	<input type="button" value="Simpan" name="add" id="add" onclick="kirim_form();" class="btn btn-primary">
	</div>

	</form>
	</div>
	 <script type="text/javascript">
     function printout() {

    var newWindow = window.open();
    newWindow.document.write(document.getElementById("pesan_kirim").innerHTML);
    newWindow.print()
    newWindow.close();
}
    </script>

<script>
	 
	function kirim_form(){
		
    $('#pesan_kirim').html('Loading ...');
    $('#pesan_kirim').slideDown('slow');

    var id_cs   = $('#id_cs').val();
    var no_nota   = $('#no_nota').val();
    
    
    var setrika = $('#setrika').val();
    var berat = $('#berat').val();
    var jumlah = $('#jumlah').val();
    
	{$.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : 'save_setrika.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'no_nota='+no_nota+'&id_cs='+id_cs+'&setrika='+setrika+'&berat='+berat+'&jumlah='+jumlah,
        success  : function(respons){
            $('#pesan_kirim').html(respons);
printout();
            $("#form-input")[0].reset();
            $("#no_nota").val('');
            $("#nama_customer").val('');
            $("#jumlah").val('');
        },
    })
}
}
     </script>