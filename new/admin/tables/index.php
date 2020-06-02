<?php 
include '../../config.php';
session_start();
$outlet = $_SESSION['outlet'];

if($_SESSION['cabang']!="makassar"){
  $_SESSION['zonatime'] = date_default_timezone_set('Asia/Jakarta');
} else {
  $_SESSION['zonatime'] = date_default_timezone_set('Asia/Makassar');
}

$nowDate = date('Y-m-d H:i:s');
$date = date('Y-m-d');
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
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>QNCLAUNDRY</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">QNCLAUNDRY</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
    
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="page-login.html"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <?php require '../app-sidebar_user.php'; ?>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="?"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Control</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Diskon Referral</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Free Parkir</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Hari Selesai</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Kode Promo</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Label Priority</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Promo Flat</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> SMS</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Upload Gambar</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> User</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Workshop Setrika</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Data</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu"> 
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Customer</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Langganan</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Membership</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Subagen</a></li>           
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Terlambat</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Forms</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Form Setoran</a></li>
            <li><a class="treeview-item" href="form-custom.html"><i class="icon fa fa-circle"></i> Custom Components</a></li>
            <li><a class="treeview-item" href="form-samples.html"><i class="icon fa fa-circle"></i> Form Samples</a></li>
            <li><a class="treeview-item" href="form-notifications.html"><i class="icon fa fa-circle"></i> Form Notifications</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Tables 1</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Tabel Order</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Saldo Resepsionis</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Saldo Delivery</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Saldo Subagen</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-circle"></i> Tagihan Order</a></li>
          </ul>
        </li>
       
       
      </ul>
    </aside>
    <main class="app-content">

      <?php 
      if(isset($_GET['r'])){
        $r = $_GET['r'];
        if($r=="omset"){
          include 'omset.php';
        }
      }


      ?>

    </main>
    <!-- Essential javascripts for application to work-->
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/plugins/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="../js/plugins/select2.min.js"></script>
    <script type="text/javascript" src="../js/plugins/bootstrap-datepicker.min.js"></script>



    <script type="text/javascript">

      $('#sampleTable').DataTable();

      $('#startDate, #endDate').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
      });


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