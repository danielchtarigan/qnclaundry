<style type="text/css">
    .font-icon {
        font-size : 18px;
        color: green;
    }
</style>

<div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color:#6C0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="color:#FFF;">QNC ACCOUNTING</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">                
               <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-users">
                        <li><a href="#"><i class="fa fa-location-arrow fa-fw"></i> <?php echo $_SESSION['user_id'] ?></a></li>
                        <li><a href="index.php?act=<?php echo md5('setpasswd'); ?>"><i class="fa fa-user fa-fw"></i> Change Password</a></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li style="text-align:center; background-color:#FFF;">
                        <!-- <img src="../logo.png"> -->
                        </li>
                        <li><br></li>                        

                        <?php 
                        if($_SESSION['level']=='admin'){ ?>
                        <li>
                            <a href="?"><i class="fa fa-home fa-fw" aria-hidden="true"></i> Home</span></a>                            
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-list fa-fw" aria-hidden="true"></i> AKUN<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?menu=list_akun">Daftar Akun</a>
                                </li>                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-desktop fa-fw"></i> BAHAN BAKU & SUPPLIER<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?menu=List_item_bahan_baku">Daftar Bahan Baku</a>
                                </li>  
                                <li>
                                    <a href="index.php?menu=List_supplier">Daftar Supplier</a>
                                </li>                                                     
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-desktop fa-fw"></i> TRANSAKSI<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?menu=requisition_doc">Requisition</a>
                                </li>
                                <li>
                                    <a href="index.php?menu=purchase_order">Purchase Order</a>
                                </li>
                                <li>
                                    <a href="?menu=goods_received">Goods Received</a>
                                </li>
                                <li>
                                    <a href="index.php?menu=JurnalUmum">Jurnal Umum</a>
                                </li>                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> MASTER TABLE<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                  <li>
                                    <a href="">Bahan Baku</a>
                                </li>                    
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li>
                                    <a href="?menu=rekap_order">Rekap Order Supplier</a>
                                </li> 
                                 <li>
                                    <a href="?menu=daftar_pembayaran">Daftar Pembayaran</a>
                                </li> 
                                <li>
                                    <a href="index.php?menu=buku_besar">Buku Besar</a>
                                </li>
                                <li>
                                    <a href="index.php?menu=cash_flow">Cash Flow</a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li> <?php
                        } else if($_SESSION['level']=='gudang'){ ?>
                        <li>
                            <a href="?"><i class="fa fa-home fa-fw" aria-hidden="true"></i> Home</span></a>                            
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-desktop fa-fw"></i> BAHAN BAKU & supplier<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?menu=List_item_bahan_baku">Daftar Bahan Baku</a>
                                </li>  
                                <li>
                                    <a href="index.php?menu=List_supplier">Daftar Supplier</a>
                                </li>                                                     
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li> 
                            <a href="#"><i class="fa fa-desktop fa-fw"></i> TRANSAKSI<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?menu=requisition_doc">RF</a>
                                </li>
                                <li>
                                    <a href="?menu=goods_received">GR</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> <?php
                        }


                        ?>
                        
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav> 
        
         <div id="page-wrapper">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div><legend></legend></div>
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                   
                        <?php
                        if (isset($_GET['act'])){
                         $act = $_GET['act'];
                         if ($act==md5('setpasswd')){
                             include '../setpasswd.php';
                             }
                        }                       
                        else if (isset($_GET['menu'])){
                            $menu = $_GET['menu']; 
                            if ($menu=="JurnalUmum"){
                                include "jurnal_umum.php";
                            } else if($menu=="list_akun"){
                                include "list_akun.php";
                            } else if($menu=="list_item"){
                                include "list_item.php";
                            } else if($menu=="List_item_bahan_baku"){
                                include "list_item_bahan_baku.php";
                            } else if($menu=="List_supplier"){
                                include "list_suplayer.php";
                            } else if($menu=="Pemesanan"){
                                include "pemesanan.php";
                            } else if($menu=="Penerimaan"){
                                include "penerimaan.php";
                            } else if($menu=="Pembayaran"){
                                include "pembayaran.php";
                            } else if($menu=="Laporan_pembayaran"){
                                include "laporan_pembayaran.php";
                            } else if($menu=="Laporan_pemesanan"){
                                include "laporan/lap_pemesanan.php";
                            } else if($menu=="Pengeluaran"){
                                include "form_pengeluaran_pety_cash.php";
                            } else if($menu=="Laporan_pengeluaran"){
                                include "laporan/lap_pengeluaran.php";
                            } else if($menu=="buku_besar"){
                                include "laporan/buku_besar.php";
                            } else if($menu=="cash_flow"){
                                include "laporan/cash_flow.php";
                            } else if($menu=="requisition_form"){
                                include "rf.php";
                            } else if($menu=="requisition_doc"){
                                include "inc/requisition_doc.php";
                            } else if($menu=="purchase_order"){
                                include "purchase_order.php";
                            } else if($menu=="form_po"){
                                include "f_po.php";
                            } else if($menu=="goods_received"){
                                include "goods_received.php";
                            } else if($menu=="rekap_order"){
                                include "rekap_order_supplier.php";
                            } else if($menu=="daftar_pembayaran"){
                                include "daftar_pembayaran.php";
                            }                              
                        }
                        else{
?>                       
                        <div class="col-md-4 col-xs-6" align="center">
                            <a href="?menu=requisition_doc" class="btn btn-rf" style="background-color : white;" data-toggle="tooltip" data-placement="top" title="Requisition Form"><img src="icon/tulis2.ico"><br><font class="font-icon">RF</font></a> 
                        </div>
                        
                        
                        <div class="col-md-4 col-xs-6" align="center">
                            <a href="?menu=purchase_order" class="btn btn-white" style="background-color : white;" data-toggle="tooltip" data-placement="top" title="Purchase Order"><img src="icon/tulis1.ico"><br><font class="font-icon">PO</font></a>   
                        </div>
                        <div class="col-md-4 col-xs-6" align="center">
                            <a href="?menu=goods_received" class="btn btn-white" style="background-color : white;" data-toggle="tooltip" data-placement="top" title="Goods Received"><img src="icon/tulis3.ico"><br><font class="font-icon">GR</font></a>   
                        </div>
                                    
             
                    
<?php
}
?>
            </div>
        </div>
    </div>
</div>
