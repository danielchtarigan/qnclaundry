<html>
<?php
include 'header.php';
include '../config.php';

$ad=$_SESSION['admin'];

?>


 <script>
$(document).ready(function() {
    $('#cari').keyup(function(e) {
        if (e.which == 13) {  // detect the enter key
            $('#cuci').click(); // fire a sample click,  you can do anything
        }
    });

    $('#cuci').click(function(e) {
        var val_cari = $('#cari').val();
 
           //kode 1
           var request = $.ajax ({
               url : "cari_setrika.php",
               data : "cari="+val_cari,
               type : "GET",
               dataType: "html"
           });
 
           //menampilkan pesan Sedang mencari saat aplikasi melakukan proses pencarian
           $('#hasil-cari').html('Sedang Mencari...');
 
           //Jika pencarian selesai
           request.done(function(output) {
               //Tampilkan hasil pencarian pada tag div dengan id hasil-cari
               $('#kotak2').slideDown();
               $('#hasil-cari').html(output);
               $('#cari').val('');
                });
 
    });
});

      
           //membuat variabel val_cari dan mengisinya dengan nilai pada field cari
          
     
   </script>


<head>

</head>
<body>
<div  class="container-fluid"  style="width:500px;
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
   margin-bottom: 10px; background-color: #17e8ce">
<marquee behavior=alternate style="font-size: 25px;color: #5300ff"  > <h1>SETRIKA</h1></marquee>
		<input  placeholder="nomer nota" class="form-control" type="text" name="admin" id="admin" value="<?php echo $ad ?>" readonly="true" >
		<label class="control-label col-xs-3" for="cari">Cari no nota</label><div class="col-xs-4">
  		<input  placeholder="nomer nota" class="form-control" type="text" name="cari" id="cari" ></div><br>
  		<br>
  		
  		<input name="cuci" class="btn btn-sm btn-danger" type="submit" id="cuci" value="Cari">
  		          <button class="btn btn-lg btn-success pull-right" data-id='0' name="lg" id="lg" data-toggle="modal" data-target="#tambah-data1"> <i class="icon-plus"></i>admin</button>
  		       <a href="logout.php">Log Out</a>

</div>
  		
<!-- tempat hasil pencarian ditampilkan -->
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
   margin-bottom: 70px;"><div id="hasil-cari">
</div></div>
<div id="tambah-data1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		
		<div class="modal-content">
<div id="pesan_kirim" style="display:none"></div>
<form  action="" method="post" class="form-horizontal"><br>
<h4  align="center"><strong>Form Login</strong></h4><br> 
            <div class="form-group"><label for="no_nota" class="control-label col-xs-3">Username</label><div class="col-xs-4">
              <input type="text" placeholder="username" id="user_id" name="user_id" class="form-control">
            </div></div>
            <div class="form-group"><label for="no_nota" class="control-label col-xs-3">Password</label><div class="col-xs-4">
              <input type="password" placeholder="Password" class="form-control" id="password" name="password">
            </div></div>
            <div class="modal-footer">
						<button type="submit" onclick="kirim_form();" class="btn btn-success"><i class="fa fa-save"></i> Login</button>
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>		</div>
<input type="button" value="Simpan" name="add" id="add" onclick="kirim_form();" class="btn btn-primary">
				</form>

			</div>
		</div>
		<script>
	 
	function kirim_form(){
		
    $('#pesan_kirim').html('Loading ...');
    $('#pesan_kirim').slideDown('slow');

    var user_id   = $('#user_id').val();
    var password   = $('#password').val();
    
    if(user_id == ''){
		alert("Tolong setrika di isi");
		exit();
	} else 
	{$.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : 'cek.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'user_id='+user_id+'&password='+password,
        success  : function(respons){
            $('#pesan_kirim').html(respons);

            $("#form-input")[0].reset();
            $("#tambah-data1").hide();
            $("#nama_customer").val('');
            $("#jumlah").val('');
        },
    })
}
}
     </script>
	</div>

	<script type="text/javascript">
        $(function() {
            $("#cari").focus();
        });
    </script>

 <script>
 
 //Inisiasi awal penggunaan jQuery
 $(document).ready(function(){
 admin=$('#admin').val();
 if (admin==''){
 	$('#id').click();
 $('#cari').attr("readonly",true)
 	
 }else{
 	$('#cari').attr("readonly",false)
 
 }
 
 
 	
 })
 	</script>
</body>

</html>


