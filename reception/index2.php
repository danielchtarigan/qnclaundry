<?php
session_start();
include '../config.php';
include '../auth.php';

include '../pop.php';
date_default_timezone_set('Asia/Makassar');
$ot = $_SESSION['nama_outlet'];
$tgl = date('Y-m-d');
?>
	    <script src="js/bootstrap.js"></script>
	    <script src="js/jquery.js"></script>
	    <style>
		.datepicker{z-index:1151;}
	    </style>
	    <script>
		$(function(){
		    $("#tanggal1").datepicker({
			format:'yyyy/mm/dd'
		    });
                });

		$(function(){
		    $("#tanggal2").datepicker({
			format:'yyyy/mm/dd'
		    });
                });

		$(function(){
		    $("#tanggal3").datepicker({
			format:'yyyy/mm/dd'
		    });
                });

		$(function(){
		    $("#tanggal4").datepicker({
			format:'yyyy/mm/dd'
		    });
                });

	    </script>
<?php
//$quang = mysqli_query($con, "select * from bukakasir where outlet='$ot' and tgl='$tgl'");
//$nuang = mysqli_num_rows($quang);
/*
if ($nuang<1){
?>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                <div align="center">
                <br>
Selamat datang di Halaman Resepsionis. <br>
<marquee>Halaman ini wajib diisi ketika recepsionis membuka halaman QnC pertama kali tiap harinya.</marquee>               </div>
                
                    <div class="panel-body">
                    Selamat datang <?php echo $_SESSION['level']?>, <?php echo $_SESSION['user_id']."(".$_SESSION['id'].") Outlet : ".$_SESSION['nama_outlet']."jumlah".$nuang.$tgl; ?>

                        <form role="form" action="act/saveuang.php" method="GET">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Masukkan Jumlah Uang Kecil" name="uang" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Masukkan Meteran Listrik" name="meteran" type="text" required>
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Simpan">
                                
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php
}
else{
*/

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');
?>
<!DOCTYPE html>
<html lang="en">

<?php
if ($_SESSION['nama_outlet']=='')
{
	header('location:../index.php');
}		
else
{
	?>

<head>
    <title>QnC Aplication</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color:#6C0; position: fixed; width : 100%;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://www.qnclaundry.com/" style="color:#FFF;">Welcome to QnC Aplication</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li>
					<a href="index.php"><i class="fa fa-bar-chart-o fa-fw"></i> Home</a>
                </li>
                <li>
					<a href="index.php?menu=customer"><i class="fa fa-table fa-fw"></i> Data Customer</a>
                </li>
				<li>
                            <a href="terlambat.php"><i class="fa fa-bar-chart-o fa-fw"></i> Data Terlambat</a>
                </li>
                <li>
                    <a data-toggle="dropdown" href="#"><i class="fa fa-edit fa-fw"></i>Form</a>
                    <ul class="dropdown-menu dropdown-user">
					<li><a href="index.php?menu=voucher">Voucher Rupiah</a></li> 
					<li><a href="index.php?menu=recovery">Voucher Recovery</a></li> 
					<li><a href="belum_spk.php">SPK</a></li> 
					<li><a href="index.php?menu=pengeluaran">Pengeluaran</a></li> 
					<li><a href="dari_workshop.php">Workshop</a></li> 
					<!--<li><a href="cari_ambil.php">Pengambilan</a></li>-->
					<li><a href="index.php?menu=ambil">Pengambilan</a></li>
					<li><a href="f_so.php">Stok Opname</a></li>
					<li><a href="f_order_void.php">Order Void</a></li>
					<li><a href="cari_complain.php">Komplain</a></li>
					<!--<li><a href="index.php?menu=complain">Komplain</a></li>-->
					<li><a href="f_tutup_kasir.php">Tutup Kasir</a></li>
					<li><a href="index.php?menu=setoran_bank">Setoran Bank</a></li>
<!--					<li><a href="f_setoran_bank.php">Setoran Bank</a></li>
-->
					<li><a href="index.php?menu=audit">Quality Audit</a></li>
					<!--
					<li><a href="c_quality_audit.php">Quality Audit</a></li>
					-->
					<li><a href="cetak_label_box.php">Cetak Label box</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-edit fa-fw"></i>SMS</a>
                    <ul class="dropdown-menu dropdown-user">
					<li><a href="index.php?sms=selesai">SMS Cucian Selesai</a></li>
					<li><a href="daftar_kembalikeoutlet.php">Sms Customer</a></li>
					<li><a href="sms_so2.php">Sms SO</a></li>
					<li><a href="sms_tgl_masuk.php">Sms Tanggal Masuk</a></li>
					<li><a href="cari_sms_voucher.php">Sms Voucher</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <li>
                <?php
                $qcustomer = mysqli_query($con, "select * from ticket where outlet='$ot' and status='Aktif'");
                $ncus = mysqli_num_rows($qcustomer);
                ?>
                    <a href="index.php?menu=ticket"><i class="fa fa-edit fa-fw"></i>Ticket (<?php echo $ncus; ?>)</a>
                    <!-- /.dropdown-user -->
                </li>
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-files-o fa-fw"></i>Laporan</a>
                    <ul class="dropdown-menu dropdown-user">
					<li><a href="lap_riject.php">Reject</a></li>
					<li><a href="d_lgn.php">Langganan</a></li>
					<li><a href="d_member.php">Member</a></li>
                    <li><a href="cari_lap_so.php">Stok Opname</a></li>
                    <li><a href="barhil.php">Barhil</a></li>
					<li><a href="cari_rincian.php">Cari Data</a></li>
                    <li><a href="cari_view_outlet.php">Cari</a></li>
					<li><a href="cari_view_all.php">Cari semua outlet</a></li>
					<li><a href="daftar_komplain.php">Data Komplain</a></li>
					<li><a href="cari_daftar_ambil.php">Data Pengambilan</a></li>
					<li><a href="daftar_qa.php">Data Quality Audit</a></li>
					<li><a href="cari_lap_spk.php">cari Data spk</a></li>
					<li><a href="cari_lap_order.php">Lap Order</a></li>
					<li><a href="cari_data_spk.php">Hitung Spk</a></li>
					<li><a href="lap_setoran_bank.php">Lap setoran bank</a></li>          
					<li><a href="sms_so.php">data SO</a></li>
					<li><a href="lap_tutup_kasir.php">Lap Tutup Kasir</a></li>
					<li><a href="lap_piutang.php">Lap Piutang</a></li>
					<li><a href="cari_lap_cs.php">Customer baru</a></li>
					<li><a href="cari_tidak_tk.php">Tidak Tutup Kasir</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-files-o fa-fw"></i>Account
                    <ul class="dropdown-menu dropdown-user">
					<li><a href="index.php?act=<?php echo md5('setpasswd'); ?>"><i class="fa fa-user fa-fw"></i> Change Password</a></li>
                    <li><a href="../logout.php"><i class="fa fa-user fa-fw"></i> Logout</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
			</ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                        <?php
							include "headnews.html";						
						?>						
						</li>                                                                        
				    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <br><br><br>
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
						else if (isset($_GET['sms'])){
							$sms = $_GET['sms'];
							if ($sms=='selesai'){
 	 	                       include "include/sms-selesai.php";
								}
						}
						else if (isset($_GET['form'])){
							$form = $_GET['form'];
							if ($form=="customer"){
								include "form/add-customer.php";
								}
						}
						else if (isset($_GET['menu'])){
							$menu = $_GET['menu'];
							if ($menu=="customer"){
					                        include "include/customer.php";
								}
							if ($menu=="ticket"){
					                        include "include/ticket.php";
								}
							if ($menu=="add_ticket"){
					                        include "form/ticket.php";
								}
							if ($menu=="voucher"){
		                        			include "form/voucher.php";
								}
							if ($menu=="recovery"){
		                        			include "form/recovery.php";
								}
							if ($menu=="complain"){
								include "include/complain.php";
								}
							if ($menu=="pengeluaran"){
					                        include "include/pengeluaran.php";
								}
							if ($menu=="tutupkasir"){
								include "include/tutupkasir.php";
								}
							if ($menu=="setoran_bank"){
								include "include/setoran_bank.php";
								}
							if ($menu=="audit"){
								?>
								<div id="q_audit">
								 <?php
									include "include/audit.php";
								 ?>
								</div>
								<script>
									var auto_refresh = setInterval(
									function () {
									$("#q_audit").load("include/audit2.php").fadeIn("slow");       	   
									}, 60000); // refresh setiap 10 milliseconds
								</script>
								<?php
								}
							if ($menu=="audithariini"){
								?>
								<div id="quality_audit">
								 <?php
								  include "include/audithariini.php";
								 ?>
								</div>
								<script>
									var auto_refresh = setInterval(
									function () {
									$("#quality_audit").load("include/audithariini2.php").fadeIn("slow");       	   
									}, 10); // refresh setiap 10 milliseconds
								</script>
								<?php
								}
							if ($menu=="qualityaudit"){
								include "f_quality_audit_new.php";
								}
						
						}
						else if (isset($_GET['key'])){
							$key = $_GET['key'];
		                        include "include/customer.php";
						}
						else{
	                        include "include/dashboard2.php";
							}
						?>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<script type="text/javascript" src="../md5.js"></script>
														
<script type="text/javascript">
$("#pop100").click(function()
{ 
key100=$("#key100").val();
code100=$("#code100").val();
key = md5("QnC"+key100+"QnC");
	if (code100==key){
			$.ajax(
				{
					url:"../pop_act.php",
					data:"status=hadir",
					cache:false,
					success:function(msg)
					{
					}
				})
	  history.back();
	}
	else{
	alert("Respon code tidak sesuai!!");
		}
	})
</script>



    <!-- jQuery Version 1.11.0 -->
    <script src="../js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
    

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>
    

</body>

</html>
<?php
}
//}
?>

<script src="js/bootstrap-modal.js"></script>
            <script src="js/bootstrap-transition.js"></script>
            <script src="js/bootstrap-datepicker.js"></script>



								