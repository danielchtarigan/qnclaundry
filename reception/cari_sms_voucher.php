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
   <marquee behavior=alternate style="font-size: 25px;color: #ff0000"  > <h1>sms voucher</h1></marquee>
		<form method="post" action="" id="form-input" class="form-horizontal">
			<div class="form-group">
	<input type="button" value="cari" name="add" id="add" onclick="kirim_form();" class="btn btn-primary">
	</div>

	</form>
	
<textarea id="pesan_kirim" rows="20" cols="50"></textarea>
	</div>
<script type="text/javascript">
function printout() {

   	 var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("pesan_kirim").innerHTML);
    newWindow.print();
    }
    </script>

<script>
	 
	function kirim_form(){
		
    $('#pesan_kirim').html('Loading ...');
    $('#pesan_kirim').slideDown('slow');

 
	{$.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : 'sms_voucher.php',
        type     : 'POST',
        dataType : 'html',
        success  : function(respons){
            $('#pesan_kirim').html(respons);

            $("#form-input")[0].reset();
         
        },
    })
}
}
     </script>
	<?php

?>

