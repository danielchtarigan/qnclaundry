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
               url : "cari_rijeck.php",
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
   margin-bottom: 10px;
   ">
<marquee behavior=alternate style="font-size: 25px;color: #ff0000"  > <h1>FORM RIJECK</h1></marquee>
		
		<label class="control-label col-xs-3" for="cari">Cari no nota</label><div class="col-xs-4">
  		<input  placeholder="nomer nota" class="form-control" type="text" name="cari" id="cari" ></div><br>
  		<input name="cuci" class="btn btn-sm btn-danger" type="submit" id="cuci" value="Cari">
  		
</div>
  		
<!-- tempat hasil pencarian ditampilkan -->
<div class="container-fluid" style="
   width:500px;
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
   margin-bottom: 70px;	"><div id="hasil-cari">
</div></div>

	<script type="text/javascript">
        $(function() {
            $("#cari").focus();
        });
    </script>


</body>
</html>

