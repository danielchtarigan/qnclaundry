<?php
include '../config.php';

session_start();
include 'auth.php';
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}
function rupiah($angka)
{
  $jadi = "Rp.".number_format($angka,0,',','.');
  return $jadi;
}
date_default_timezone_set('Asia/Makassar');
$cabang = "Makassar";

$dateNow = date('Y-m-d');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../Logo bulat 2017.png">
    <title>Halaman Admin</title>
    <link href="../accounting/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../lib/css/jquery-ui.css">
    <link href="css/style2.css" rel="stylesheet" type="text/css">

<!--  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <link href="bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="../accounting/DataTables-1.10.16/css/dataTables.bootstrap.min.css">
    
    <script src="../js/jquery-1.11.0.js"></script>
    <script src="js/highcharts.js"></script>
    <script src="js/data.js"></script>
    <script type="text/javascript" src="../accounting/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../accounting/DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script> 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body>
    <?php require 'nav.php'; ?>
    
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
               else if ($menu=="prioritycontrol") {
                                include "form/priority.php";
                            }
                              else if ($menu=="updateKerjaOperasional") {
                                include "form/update_operasional.php";
                            }
                             else if ($menu=="cucianTelat") {
                                include "act/denda_cucian_telat.php";
                            }
                            else if ($menu=="void_dan_reject") {
                                include "data_void.php";
                            }
                            else if ($menu=="daftar_karyawan") {
                                include "daftar_karyawan.php";
                            }
                            else if ($menu=="deposit_subagen") {
                                include "include/data_deposit_subagen.php";
                            }
                            else if ($menu=="sms_promo") {
                                include "include/control_sms_p.php";
                            }
                            else if ($menu=="Data Terlambat") {
                                include "include/data_terlambat.php";
                            }
                            else if ($menu=="DaftarMembership") {
                                include "include/daftar_membership.php";
                            }
                            else if ($menu=="VoucherPromoSMS") {
                                include "f_voucher_berkala.php";
                            }
                            else if ($menu=="laporan penjualan") {
                                include "include/penjualan_laundry.php";
                            }
                            
            }
            else{
?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Omset Harian</h3>
                </div>
                <div class="panel-body">
                <?php include 'dashboard/omsethari.php' ?>
                <p style="font-size:10px; color:#040106; font-style:oblique; text-align:right">Sumber data: Pembayaran order bukan kuota, membership, dan deposit langganan</p>
                </div>
                
                <div class="panel-footer">
                    <?php require 'dashboard/display_omset.php' ?>
                    <?php include 'dashboard/daftar_buka_outlet.php' ?>
                </div>
                    
            </div>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">                        
                        <div class="panel-heading"><h3 class="panel-title">Ontime Performance</h3></div>
                        <div class="panel-body">
                            <?php 
                                include 'dashboard/otp.php' ;
                                include 'dashboard/otp_rata.php';
                            ?>
                            
                            <p style="font-size:9px; font-style: oblique; font-weight: bold">Sumber: <?= date('d/m/Y', strtotime($startDate)).' - '.date('d/m/Y', strtotime($endDate)) ?></p>
                        </div>
                        <div class="panel-footer">
                            <a class="btn btn-success" href="?menu=Data Terlambat">Info Detail</a>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h3 class="panel-title">Kode Promo 7 hari terakhir</h3>
                        </div>
                        <div class="panel-body">
                         <?php include 'dashboard/kode_promo.php'; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-default">                        
                        <div class="panel-heading"><h3 class="panel-title">Quality Audit</h3></div>
                        <div class="panel-body">
                            <?php include 'dashboard/quality_audit.php' ?>
                        </div>
                        <div class="panel-footer">
                            <a class="btn btn-success" href="laporan.php?menu=QualityAudit">Info Detail</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h3 class="panel-title">Saldo Resepsionis</h3>
                        </div>
                            <?php include 'include/kas_recepsionis.php';?>
                    </div>
                </div> 
            </div>

           
             <div class="col-lg-12 col-md-12">                    
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3 class="panel-title">Top 10 customer 7 hari terakhir</h3>
                    </div>
                    <div class="panel-body">
                       <?php include 'dashboard/top.php' ?>
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
    
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="../js/sb-admin-2.js"></script>

<script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/jquery.raty.min.js"></script>
<script type="text/javascript" src="js/select2.min.js"></script>

<script type="text/javascript">

  jQuery(function($){
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

    $(document).on('click',  '.btn-oms', function(e){
        e.preventDefault();
        $('.disp-omset').slideToggle("slow");
        $('.disp-omset2').toggleClass('hide');
    })
    
    $(document).on('click',  '.btn-display-outlet', function(e){
        e.preventDefault();
        $('.tabel-outlet').slideToggle("slow");
    })
  })

     
</script>

</body>
</html>