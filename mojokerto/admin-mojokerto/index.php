<?php
session_start();
//include 'auth.php';
include '../../config.php';
function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Halaman Admin</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../../css/sb-admin-2.css" rel="stylesheet">
    <link href="../../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!--	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <link href="bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color:#6C0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="color:#FFF;">Welcome to QnC Aplication</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw">
                        </i>
						<?php echo $_SESSION['user'];?> (<?php echo $_SESSION['nama_outlet'];?> )
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?act=<?php echo md5('setpasswd'); ?>"><i class="fa fa-gear fa-fw"></i> Change Password</a></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li style="text-align:center; background-color:#FFF;">
                        <img src="../../logo.png">
                        </li>
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						<li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Control<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="index.php?menu=referral">Set Voucher Referral</a></li>
                                <li><a href="index.php?menu=parkir">Status Free Parkir</a></li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Voucher & Promo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li><a href="index.php?menu=add_berkala">Voucher Berkala</a></li>
								<li><a href="index.php?menu=promo">Kode Promo</a></li>
								<li><a href="index.php?menu=flat">Promo Flat</a></li>
                            </ul>
							
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Halaman Admin</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <?php
						if (isset($_GET['act'])){
						 $act = $_GET['act'];
						 if ($act==md5('setpasswd')){
							 include '../setpasswd.php';
							 }
						}
						else if (isset($_GET['id'])){
                        include "form/customer.php";
						}
						else if (isset($_GET['menu'])){
                         $menu = $_GET['menu'];
						 if ($menu=="promo"){
							 include "include/daftar_promo.php";
							 }
						 else if ($menu=="add_promo"){
							 include "include/promo.php";
							 }
						 else if ($menu=="flat"){
							 include "include/daftar_flat.php";
							 }
						 else if ($menu=="add_flat"){
							 include "include/flat.php";
							 }
						 else if ($menu=="add_berkala"){
							 include "include/berkala.php";
							 }
						  else if ($menu=="referral"){
							 include "include/voucher_referral.php";
							 }
						}
						else{
}
?>
                    </div>
                </div>
            </div>
        </div>
    </div></div>
    <script src="../../js/jquery-1.11.0.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="../../js/sb-admin-2.js"></script>

<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
 $('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  minView: 2,
  forceParse: 0
    });
</script>

</body>
</html>
