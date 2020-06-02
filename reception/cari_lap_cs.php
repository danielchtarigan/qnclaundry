<?php
//Koneksi database

include 'header.php';

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
   <marquee behavior=alternate style="font-size: 25px;color: #ff0000"  > <h1>Cari Customer baru</h1></marquee>
		<form method="post" action="lap_cs_baru.php" target="_blank" id="form-input" class="form-horizontal">
		
	
		<div class="form-group"> 
     	<label class="control-label col-xs-5" for="setrika">Pilih Tanggal masuk</label>
     	</div>
	 <div class="col-xs-5" >
		<input type="date" class="form-control" name="tgl" id="tgl" required="true" >sd
</div> 
 <div class="col-xs-5" >
		<input type="date" class="form-control" name="tgl2" id="tgl2" required="true" >
</div>
	<div class="form-group">
	<input type="submit" value="cari" name="add" id="add"  class="btn btn-primary">
	</div>

	</form>
	
	</div>

<script>
	 
	function kirim_form(){
		
    $('#pesan_kirim').html('Loading ...');
    $('#pesan_kirim').slideDown('slow');

    var tgl  = $('#tgl').val();
     var tgl2  = $('#tgl2').val();
  
    if(tgl == ''){
		alert("Tolong tanggal di isi");
		exit();
	} else 
	{$.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : 'lap_otp_operasional.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'tgl='+tgl+'&tgl2='+tgl2,
        success  : function(respons){
            $('#pesan_kirim').html(respons);

            $("#form-input")[0].reset();
            $("#tgl").val('');
         
        },
    })
}
}
     </script>
	<?php

?>

