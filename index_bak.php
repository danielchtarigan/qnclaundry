<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.png">
    <title>QnC Laundry</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <!-- <link href="css/modern-business.css" rel="stylesheet"> -->
     <!-- Custom styles for this template -->
   <!--  <link href="jumbotron-narrow.css" rel="stylesheet"> -->

   <style type="text/css">
     body {
        padding-top: 54px;
      }

      @media (min-width: 992px) {
        body {
          padding-top: 56px;
        }
      }

      .carousel-item {  
        height: 70vh;
        min-height: 580px;
        background: no-repeat center center scroll;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }

      .portfolio-item {
        margin-bottom: 30px;
      }

      .menu-profil {
        padding-right: 5px;
        color: #6C0;
      }
      
      @media only screen and (max-width: 768px) {
        .carousel-item {  
          height: 10vh;   
          min-height: 190px;
        }
      }

   </style>
  </head>

  <body>

    <?php 
    include 'navbar.php'; 
    
    ?>

    

    <!-- Page Content -->
    <div class="container">

      <?php 
      if(isset($_GET['about'])){
        $id = $_GET['about'];
        if($id=="profil") {
          include 'profil_utama.php';
          ?>
          <!-- Page Heading/Breadcrumbs -->
          <h1 class="mt-4 mb-3">Laundry
            <small>Profil</small>
          </h1>


        <!-- Blog Post -->
        <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <a href="#">
                <img class="img-fluid rounded" src="presentasi/Slide1.JPG" alt="">
              </a>
            </div>
            <div class="col-lg-6">
              <h2 class="card-title">Tentang</h2>
              <p class="card-text" align="justify">Quick &' Clean menawarkan laundry kiloan dan Dry Cleaning yang handal, tidak tertukar, rapi dan bersih dengan menerapkan sistem IT yang canggih</p>
              <p align="justify">Quick &’ Clean adalah sebuah konsep laundry baru yang menawarkan laundry kiloan yang berkualitas dan Dry Clean yang bersaing. Laundry kiloan kami diproses dengan satu nota satu mesin cuci, sehingga cucian Anda tidak dicampur dengan pelanggan lain. Kami menggunakan chemical yang berkualitas dan setrika uap yang tidak akan merusak cucian Anda, serta asuransi yang menjamin penggantian akan setiap cucian yang rusak dan hilang.

              Dry Clean kami diproses dengan metode yang sama dengan laundry profesional lainnya, namun dengan accessories yang lebih sederhana untuk menjaga harga jual kami tetap murah namun berkualitas.

              Kami hanya fokus pada cucian sehari-hari saja untuk menjaga sistem kerja kami sederhana agar dapat menawarkan kepada Anda hasil cucian yang memuaskan dengan harga yang masuk akal</p>             
            </div>
          </div>
        </div>
        <div class="card-footer text-muted">
          Posted on March 27, 2018 by
          <a href="#">QnC Laundry</a>
        </div>
      <!--</div>-->
          
          <?php
        }         
      } 
      else if(isset($_GET['submenu'])) {
        $sub = $_GET['submenu'];
        if($sub=="location"){
          include 'location.php';
        }
        else if($sub=="tourids=pickup_point"){
          include 'pickup_point.php';
        }
        else if($sub=="tourids=outlet_portable"){
          include 'portable_outlet.php';
        }
        else if($sub=="tourids=system_dashboard"){
          include 'system_dashboard.php';
        }
        else if($sub=="contactUs"){
          include 'contact.php';
        }
      }

      else {        
        include 'header.php';
        include 'home.php';
      }

      ?>

      
    </div>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-3 bg-secondary navbar-default navbar-fixed-bottom">
      <div class="container">
        <p class="m-0 text-center text-white">&copy; QnC Laundry 2018 &nbsp; <a href="https://web.facebook.com/quicknclean.indonesia/" data-toggle="tooltip" title="Facebook" data-placement="top" style="color: #fff;"><i class="fa fa-facebook-square bigger-150"></i></a></p>
      </div>
      <!-- /.container -->
    </footer>

   

   <!--  <script src="lib/js/jquery-2.1.3.min.js"></script>
    <script src="lib/js/bootstrap.min.js"></script> -->
    <script src="admin/js/jquery.form.js"></script>
    <script>
       function cari(){
           //membuat variabel val_cari dan mengisinya dengan nilai pada field cari
           var val_cari = $('#cari').val(); 
           //kode 1
           var request = $.ajax ({
               url : "cari.php",
               data : "cari="+val_cari,
               type : "GET",
               dataType: "html"
           });
           //menampilkan pesan Sedang mencari saat aplikasi melakukan proses pencarian
           $('#hasil-cari').html('Sedang Mencari...');
           //Jika pencarian selesai
           request.done(function(output) {
               //Tampilkan hasil pencarian pada tag div dengan id hasil-cari
               $('#hasil-cari').html(output);
           });
       }
    </script>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
