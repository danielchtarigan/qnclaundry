<html>
<?php
include 'header.php';
include '../config.php';
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
               url : "c_rincian.php",
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



<div class="row featurette"> 

<div class="col-md-4 col-md-offset-0" >

</div>

<div class="col-md-4 col-md-offset-0" >
		<label class="control-label col-xs-3" for="cari">Cari no nota</label>
		<div class="col-xs-4">
  		<input  placeholder="nomer nota" class="form-control" type="text" name="cari" id="cari" >
  		</div><br>
  		<input name="cuci" class="btn btn-sm btn-danger" type="submit" id="cuci" value="Cari"><br>
<div id="hasil-cari">

</div>
</div>



<div class="col-md-4 col-md-offset-0" >
</div>

</div>


<div class="row featurette"> 
<div class="col-md-8 col-md-offset-2" >
</div>
</div>











	<script type="text/javascript">
        $(function() {
            $("#cari").focus();
        });
    </script>

<script type="text/javascript">
		$(document).ready(function(){
			 $('#dataexpress').load('daftar_express.php');
		 $('#belum').load('daftar_belum.php');
		$('#rincianpacking1').load('d_packing.php');	
			
			});
	</script>
</body>
</html>


