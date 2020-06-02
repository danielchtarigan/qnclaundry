<!DOCTYPE html>
<html lang="en">

<head>
<?php

include '../../../config.php';
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QUICK &' CLEAN ADMIN</title>

    <link href="../../../lib/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../dist/css/metisMenu.css" rel="stylesheet">
	<link href="../../dist/css/timeline.css" rel="stylesheet">
	<link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
         <?php 
             include 'nav.php';
           
           ?>
    
        <div id="page-wrapper">

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




          
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="../../../lib/js/jquery-2.1.4.min.js"></script>
    <script src="../../../lib/js/bootstrap.min.js"></script>
    <script src="../../dist/js/metisMenu.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
 
</body>
<script>
$(document).ready(function() {
	 $(function() {
            $("#no_nota").focus();
        });
   
    $('#cuci').click(function(e) {
        var val_no_nota = $('#no_nota').val();
       
                 //kode 1
           var request = $.ajax ({
               url : "../fungsi/save_wk.php",
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
</html>
