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
   margin-bottom: 10px;
   ">
<marquee behavior=alternate style="font-size: 25px;color: #ff0000"  > <h1>Pengering</h1></marquee>
		
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
    $('#cari').keyup(function(e) {
        if (e.which == 13) {  // detect the enter key
            $('#cuci').click(); // fire a sample click,  you can do anything
        }
    });

    $('#cuci').click(function(e) {
        var val_cari = $('#cari').val();
 
           //kode 1
           var request = $.ajax ({
               url : "../fungsi/cari_pengering.php",
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
</html>
