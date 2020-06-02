<html>
<?php
session_start();
include 'header.php';
include '../config.php';

if($_SESSION['nama_outlet']!='Toddopuli' AND $_SESSION['nama_outlet']!='Antang' AND $_SESSION['nama_outlet']!='support') {
    ?>
    <script>alert("Sekarang sudah menggunakan Form Driver");  window.location = "index.php"; </script>    
    <?php
}

?>
<script>
$(document).ready(function() {
	 $(function() {
            $("#no_nota").focus();
        });
   
    $('#cuci').click(function(e) {
        var val_no_nota = $('#no_nota').val();
       
                 //kode 1
           var request = $.ajax ({
               url : "save_wk.php",
               data : "no_nota="+val_no_nota,
               type : "POST",
               dataType: "html"
           });
 
           //menampilkan pesan Sedang menno_nota saat aplikasi melakukan proses pencarian
          
 
           //Jika pencarian selesai
           request.done(function(output) {
               $('#hasil-cari').html(output);
               $('#no_nota').val('');
               $('#no_nota').focus();
               
               
                });
 
    });
});

      
           //membuat variabel val_no_nota dan mengisinya dengan nilai pada field no_nota
          
     
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
   margin-bottom: 10px;">
<marquee behavior=alternate style="font-size: 25px;color: #1c03fc"  ><h1>Dari Workshop</h1></marquee>
<div><strong> Cucian yang datang dari wokshop inputnya di sini.<br></strong>
Lihat lagi no notanya. Jika ada no nota yang salah2 di input ulang. di scan beberapa kali gak masalah. Setelah selesai klik Simpan. Usahakan setelah nota terakhir jangan di enter lagi. tapi di klik simpan</div>
		<div id="hasil-cari"></div>
		<div class="col-xs-4">
		<textarea  placeholder="scan nomer nota" class="form-control" rows="100" type="text" name="no_nota" autocomplete="off" id="no_nota" ></textarea></div>
  		<input name="cuci" class="btn btn-sm btn-danger" type="submit" id="cuci" value="Simpan">  		
</div>
</body>
</html>
