<?php 

if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

include '../config.php';
require 'encrypt-url.php';
session_start();
$outlet = $_SESSION['outlet'];

if($_SESSION['cabang']!="makassar"){
  $_SESSION['zonatime'] = date_default_timezone_set('Asia/Jakarta');
} else {
  $_SESSION['zonatime'] = date_default_timezone_set('Asia/Makassar');
}

$cabang = $_SESSION['cabang'];
$outlet = $_SESSION['outlet'];

$nowDate = date('Y-m-d H:i:s');
$date = date('Y-m-d');

if($_SESSION['level']!='admin2'){
  header("location: ../");
}




?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">    
    <title>QNCLAUNDRY</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../Logo bulat 2017.png">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="js/jquery-3.2.1.min.js"></script>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="#">QNCLAUNDRY</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
    
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="new-password"><i class="fa fa-cog fa-lg"></i> Ganti Password</a></li>
        <!--     <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li> -->
            <li><a class="dropdown-item" href="../pages/logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="laki.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?php echo ucwords($_SESSION['user_id']) ?></p>
          <p class="app-sidebar__user-designation"><?php echo ucwords($_SESSION['outlet']). '<br> Kota ' .ucwords($_SESSION['cabang']) ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="?"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Control</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="?r=control&v=daftar-user"><i class="icon fa fa-circle"></i> Daftar User</a></li>
            <!-- <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Hari Selesai</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Kode Promo</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Langganan</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Membership</a></li>   -->
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Data</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu"> 
            <!-- <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Cucian Express</a></li> -->
            <li><a class="treeview-item" href="?r=tabel&v=data-customer"><i class="icon fa fa-circle"></i> Customer</a></li>     
            <li><a class="treeview-item" href="?r=tabel&v=ontime-performance"><i class="icon fa fa-circle"></i> Terlambat/OTP</a></li>
          </ul>
        </li>
       <!--  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Forms</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Form Setoran</a></li>
          </ul>
        </li> -->
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Tables Omset</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!-- <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Saldo Kasir</a></li> -->
            <li><a class="treeview-item" href="?r=tabel&v=omset"><i class="icon fa fa-circle"></i> Tabel Omset</a></li>
            <li><a class="treeview-item" href="?r=tabel&v=order-belum-lunas"><i class="icon fa fa-circle"></i> Order Belum Lunas</a></li>
            <li><a class="treeview-item" href="?r=tabel&v=order-dibatalkan"><i class="icon fa fa-circle"></i> Order Dibatalkan</a></li>
          </ul>
        </li>
       
       
      </ul>
    </aside>
    <main class="app-content">

      <?php 
      if(isset($_GET['r'])){
        $r = $_GET['r'];
        $v = $_GET['v'];

        if($r=="tabel")
        {

          switch ($v) {
            case 'omset':
              include 'tables/omset.php'; break;
            case 'ontime-performance':
              include 'tables/otp.php'; break;
            case 'kode-promo':
              include 'tables/kode-promo.php'; break;
            case 'order-belum-lunas':
              include 'tables/order-belum-lunas.php'; break;
            case 'order-dibatalkan':
              include 'tables/order-dibatalkan.php'; break;
            case 'data-customer':
                include 'tables/data-customer.php'; break;
            case 'riwayat-order':
                include 'tables/riwayat-order.php'; break;
            
          }

        } 
        else if($r=="control")
        {
          switch ($v) {
            case 'daftar-user':
                include 'tables/list-user.php'; break;
            
          }
        }


      }    

      else { ?>

        <div class="app-title">
          <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            <p></p>
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          </ul>
        </div>


        <div class="tile">
          <h3 class="tile-title">Omset</h3>
          <div class="tile-body">
           <?php include 'dashboard/omset.php';  ?>
            <div class="tile-footer"><a class="btn btn-success" href="?r=tabel&v=omset">Info Detail</a></div>
          </div>
            
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="tile">
              <h3 class="tile-title">Ontime Performance</h3>
              <div class="tile-body">
               <?php include 'dashboard/otp.php'; ?> 
              </div>
              <div class="tile-footer"><a class="btn btn-success" href="?r=tabel&v=ontime-performance">Info Detail</a></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="tile">
              <h3 class="tile-title">Voucher dan Kode Promo</h3>
              <div class="tile-body">
                <?php include 'dashboard/kode_promo.php'; ?>             
              </div>
              <div class="tile-footer"><a class="btn btn-success" href="?r=tabel&v=kode-promo">Info Detail</a></div>
            </div>
          </div>
        </div>

    <?php } ?>


    <div class="modal fade" id="rincian_order" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="rincian" style="margin-top: 15px">
            
          </div>
        </div>
      </div>
    </div>

      
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/chart.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script> 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="js/plugins/select2.min.js"></script>
    <script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
      jQuery(function($){

        $('#omsetTable').DataTable();
        $('#voidTable').DataTable({
          "order": [[ 0,"desc" ]]
        });

        $('#otpTable').dataTable({
          "order": [[ 0,"asc" ]],
          "iDisplayLength": 10,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
          "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            if (aData[5] == "0" && aData[10] >= 5)
                {
                    $('td', nRow).css('background-color', '#beaed2').css('color', 'black').css('font-weight', 'bold');
                }
            else if(aData[5] == "1" && aData[10] >= 24 && aData[10] < 48)
                {
                  $('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');
                }
            else if(aData[5] == "1" && aData[10] >= 48)
                {
                  $('td', nRow).css('background-color', 'red').css('color', 'black').css('font-weight', 'bold');
                }
            }

        });

        $('#startDate, #endDate').datepicker({
          format: "yyyy-mm-dd",
          autoclose: true,
          todayHighlight: true
        });

        $(document).on('click', '.data-order', function(){
          var cek_order = "order";
          var order = $(this).attr('id');
          $.ajax({
            url  : '../pages/form/form_operasional.php',
            data  : 'cek_order='+cek_order+'&nota='+order,
            beforeSend : function(){
              $('.rincian').html("<p align='center'>sedang mencari...</p>");
            },
            success : function(data){
              $('.rincian').html(data);
            }
          });
        });

        $(document).on('click', '.riwayat-order', function(){
          id = $(this).attr('id');
          window.open('?r=tabel&v=riwayat-order&customerId='+id);

        })

    })

    </script>
   
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
  </body>
</html>