<?php
session_start();
include 'auth.php';
include '../config.php';
function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!--	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <link href="bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    
    <script src="js/highcharts.js"></script>
    <script src="js/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
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
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                        </li>
                        <li class="divider"></li>
                        <li>
                        </li>
                        <li class="divider"></li>
                        <li>
                        </li>
                        <li class="divider"></li>
                        <li>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                        </li>
                        <li class="divider"></li>
                        <li>
                        </li>
                        <li class="divider"></li>
                        <li>
                        </li>
                        <li class="divider"></li>
                        <li>
                        </li>
                        <li class="divider"></li>
                        <li>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                        </li>
                        <li class="divider"></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?act=<?php echo md5('setpasswd'); ?>"><i class="fa fa-user fa-fw"></i> Change Password</a></li>
                        <li><a href="../logout.php"><i class="fa fa-user fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li style="text-align:center; background-color:#FFF;">
                        <img src="../logo.png">
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
                            <a href="#"><i class="fa fa-table fa-fw"></i> Data<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="cari_rincian.php">Pencarian Data</a>
                                </li>
                                <li>
                                    <a href="terlambat.php">Data Terlambat</a>
                                </li>
                                <li>
                                    <a href="express.php">Data Express</a>
                                </li>                                
                                <li>
                                    <a href="index.php?menu=retail">Produk Retail</a>
                                </li>
                                <li>
                                    <a href="index.php?menu=sms">SMS</a>
                                </li>
                                <li>
                                    <a href="upload_info.php">Upload Informasi Gambar</a>
                                </li>
                                <li>
                                    <a href="index.php?menu=footer">Footer Info</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Control<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="index.php?menu=csetrika">Workshop Setrika</a></li>
                                <li><a href="index.php?menu=parkir">Status Free Parkir</a></li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Halaman<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../reception/">Receptionist</a>
                                </li>
                                <li>
                                    <a href="../operator/">Operator</a>
                                </li>
                                <li>
                                    <a href="../packer/">Packer</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Voucher & Promo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li><a href="f_voucher_berkala.php">Voucher Berkala</a></li>
								<li><a href="f_voucher.php">Voucher lucky dip</a></li>
								<li><a href="index.php?menu=recovery">Voucher Recovery</a></li>
								<li><a href="index.php?menu=rupiah">Voucher Rupiah</a></li>
								<li><a href="index.php?menu=promo">Kode Promo</a></li>
								<li><a href="index.php?menu=flat">Promo Flat</a></li>
								<li><a href="index.php?menu=referral">Diskon Referral</a></li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
<!--                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Data</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
-->
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Edit<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
 <li><a href="update_hari.php">Update Hari Selesai</a></li>                  
 <li><a href="user.php">Tambah User</a></li>
 <li><a href="poin_kuota.php">Edit Kuota n Poin</a></li>
<li><a href="tutup_kasir.php">Setor Ke bank</a></li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-info-circle fa-fw"></i> Customer Khusus<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li><a href="customer_khusus.php">Telah Diaktifkan</a></li>
                                 <li><a href="customer_c.php">Type C</a></li>                  
                                 <li><a href="customer_d.php">Type D</a></li>
                                 <li><a href="mahasiswa.php">Mahasiswa</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
<li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Manifest<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">													
				<li><a href="kotor_manifest.php">Cucian Kotor</a></li>
				<li><a href="bersih_manifest.php">Cucian Bersih</a></li>
				<li><a href="setrika_manifest.php">Transfer Setrika</a></li>				
                                </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Chart<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">             
                                <li><a href="voucher.php">Voucher Mingguan</a></li>
                                <li><a href="omset_mg.php">Omset Mingguan</a></li>                      
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Accounting<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li><a href="laporan_pegawai.php">Laporan Poin & Gaji Pegawai</a></li>
                                 <li><a href="cari_lap_omset.php">Laporan Omset/Order</a></li>
                                 <li><a href="cari_lap_member.php">Member/Lgn</a></li>
                                 <li><a href="cbayar_ritel.php">Cara Bayar Retail</a></li>
                                 <li><a href="cari_lap_cash.php">Laporan Pemasukan</a></li>
                                 <li><a href="lap_tutup_kasir.php">Lap Tutup Kasir</a></li>
				                 <li><a href="cari_tidak_tk.php">Tidak Tutup Kasir</a></li>
				                  <li><a href="reject.php">Lap Reject</a></li>
				                 <li><a href="index.php?menu=tagihan">Tagihan Order</a></li>
				                 <li><a href="d_piutang.php">Update Lunas</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Report Corporate<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="index.php?menu=order_corp">Order Corporate</a></li>
								<li><a href="index.php?menu=pack_corp">Packing Corporate</a></li>                           
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> 
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Report<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
				<li><a href="index.php?menu=referensi">Customer Referensi</a></li>
				<li><a href="d_customer.php">Daftar Customer</a></li>
				<li><a href="index.php?menu=setoran_bank">Setoran Bank</a></li>
				<li><a href="index.php?menu=quality_audit">Laporan Quality Audit</a></li>
				<li><a href="cari_so_rcp.php">Stock Opname Reception</a></li>
				<li><a href="absen_rcp.php">Data Absensi Reception</a></li>
				<li><a href="log_workshop.php">Data Absensi Workshop</a></li>
				<li><a href="cari_lap_operator.php">Laporan Operator</a></li>
				<li><a href="report_void.php">Report Void & Edit</a></li>
				<li><a href="cari_lap_cuci.php">Laporan Cuci</a></li>
                                <li><a href="lap_cuci_hotel.php">Laporan Cuci Hotel</a></li>
                                <li><a href="laporan_delivery.php">Laporan Delivery</a></li>
                                <li><a href="cari_lap_pengering.php">Laporan Pengering</a></li>
                                <li><a href="cari_lap_setrika.php">Laporan Setrika</a></li>
                                <li><a href="lap_setrika_hotel.php">Laporan Setrika Hotel</a></li>
                                <li><a href="cari_lap_packing.php">Laporan Packing</a></li>
                                <li><a href="lap_packing_hotel.php">Laporan Packing Hotel</a></li>
				<li><a href="lap_otp_operasional_cari.php">Lap OTP</a></li>
				<li><a href="lap_spk.php">Lap SPK</a></li>
				<!--<li><a href="lap_vocer.php">Lap Pemilik Voucher Diskon</a></li>-->
				<li><a href="lap_vocer_r.php">Lap Pemilik Voucher Referral</a></li>
				<li><a href="lap_vocer_user.php">Lap Pengguna Voucher</a></li>
				<!--<li><a href="lap_vocer_r_user.php">Lap Pengguna Voucher Referral</a></li>-->
				<li><a href="inventory.php">Inventory</a></li>
				<li><a href="cari_lap_customer.php">Lap Customer</a></li>
                                <li><a href="index.php?menu=log_rcp">Laporan Log Reception</a></li>
                                </ul>
                            <!-- /.nav-second-level -->
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
						 if ($menu=="retail"){
							 include "include/product.php";
							 }
						 else if ($menu=="footer"){
							 include "include/add-footer.php";
							 }
						 else if ($menu=="add-product"){
							 include "include/add-product.php";
							 }
						 else if ($menu=="promo"){
							 include "include/daftar_promo.php";
							 }
						 else if ($menu=="add_promo"){
							 include "include/promo.php";
							 }
						 else if ($menu=="rupiah"){
							 include "include/daftar_rupiah.php";
							 }
						 else if ($menu=="recovery"){
							 include "include/daftar_recovery.php";
							 }
						 else if ($menu=="add_rupiah"){
							 include "include/rupiah.php";
							 }
						 else if ($menu=="add_recovery"){
							 include "include/recovery.php";
							 }
						 else if ($menu=="penyesuaian"){
					                 include "form/penyesuaian.php";
							 }
						 else if ($menu=="flat"){
							 include "include/daftar_flat.php";
							 }
						 else if ($menu=="add_flat"){
							 include "include/flat.php";
							 }
						 else if ($menu=="sms"){
							 include "include/sms.php";
							 }
							 else if ($menu=="referral") {
								 include "include/referral.php";
							 }
						 else if ($menu=="smsselesai"){
							 include "include/smsselesai.php";
							 }
						 else if ($menu=="quality_audit"){
							 include "include/laporan_quality_audit.php";
							 }
						 else if ($menu=="setoran_bank"){
							 include "include/set_bank.php";
							 }
						 else if ($menu=="referensi"){
							 include "include/laporan_referensi.php";
							 }
                                                 else if ($menu=="log_rcp"){
							 include "include/report_ping.php";
							 }
                                                 else if ($menu=="parkir"){
							 include "include/parkir.php";
							 }
                                                 else if ($menu=="change"){
							 include "act/changestat.php";
							 }
                                                 else if ($menu=="csetrika"){
                                                         include "include/con_setrika.php";
                                                         }
                                                 else if ($menu=="change2"){
                                                         include "act/changestat2.php";
                                                         }
						 else if ($menu=="ticket"){
							 include "include/ticket.php";
							 }
						 else if ($menu=="order_corp"){
							include "cari/order_corporate.php";
							}
							else if ($menu=="pack_corp"){
							include "cari/pack_corporate.php";
							}
							 else if ($menu=="void_edit"){
							include "report_void.php";
							}
							 else if ($menu=="tagihan"){
							include "cari/tagihan.php";
						 	}
						}
						else{
?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">                    
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Omset Harian</h3>
                      </div>
                      <div class="panel-body">
                        <?php include 'dashboard/omsethari.php' ?>
                        <p style="font-size:10px; color:#040106; font-style:oblique; text-align:right">Sumber data: Pembayaran order bukan kuota, membership, dan deposit langganan</p>
                      </div>
                    </div>
                </div>

            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12" >                    
                    <div class="panel panel-default">                      
                        <div class="panel-body">
                            <?php include 'dashboard/audit.php' ?>                        
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">                    
                    <div class="panel panel-default" style="background-color: #e1ecdb">                                
                        <div class="panel-body">
                            <p style="font-family: cambria; color: #9dceec">10 komentar terakhir</p>
                            <table class="table table-hover"  style="font-size: 9px; font-family: cambria">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Kritik dan saran</th>
                                        <th>Waktu</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                        $qa = mysqli_query($con, "select *from quality_audit order by tgl_input DESC LIMIT 10");
                                        while($hasilqa = mysqli_fetch_array($qa)){?>
                                            <td><?php echo $hasilqa['nama_customer'] ?></td>
                                            <td><?php echo $hasilqa['ket'] ?></td>
                                            <td><?php if($hasilqa['waktu']=='ya' or $hasilqa['waktu']=='Ya' ) echo "OK"; else echo "Telat"; ?></td>
                                            <td><?php if($hasilqa['jumlah']=='ya' or $hasilqa['jumlah']=='Ya') echo "OK"; else echo "Tidak"; ?></td>        
                                    </tr>
                                        <?php
                                        }
                                        ?>      
                                </tbody>
                            </table>
                         </div>
                    </div>
                </div>
            </div>


            <div class="row">
                 <div class="col-lg-6 col-md-6">                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h3 class="panel-title">Top 10 customer 7 hari Terakhir</h3>
                        </div>
                        <div class="panel-body">
                         <?php include 'dashboard/top.php'; ?>
                        </div>
                    </div>

                        <div class="panel panel-default">
                        <div class="panel-heading">
                        <h3 class="panel-title">Voucher dan Promo 7 hari Terakhir</h3>
                        </div>
                        <div class="panel-body">
                           <?php include 'dashboard/voucher.php' ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h3 class="panel-title">Kas Resepsionis</h3>
                        </div>
                            <?php include 'include/kas_recepsionis.php';?>
                    </div>
                </div>               
            </div>
<?php
}
?>
                    </div>
                </div>
            </div>
        </div>
    </div></div>
    <script src="../js/jquery-1.11.0.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="../js/sb-admin-2.js"></script>

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