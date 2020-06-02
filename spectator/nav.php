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
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-users">
                        <li><a href="#"><i class="fa fa-location-arrow fa-fw"></i> <?php echo $_SESSION['outlet'] ?></a></li>
                        <li><a href="index.php?act=<?php echo md5('setpasswd'); ?>"><i class="fa fa-user fa-fw"></i> Change Password</a></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li style="text-align:center; background-color:#FFF;">
                        <img src="../logo.png">
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Data<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="quicknclean.php?menu=CariData">Pencarian Data</a>
                                </li>
                                <li>
                                    <a href="quicknclean.php?menu=DaftarProsesCucian">Data Terlambat</a>
                                </li>                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="quicknclean.php?menu=OmsetDanOrder">Omset dan Order</a>
                                </li>
                                <li>
                                    <a href="quicknclean.php?menu=Berlangganan">Member dan Langganan</a>
                                </li>  
                                <li>
                                    <a href="quicknclean.php?menu=TutupKasir">Tutup Kasir</a>
                                </li>                            
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
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <h3 class="page-header">Spectator <?php echo $_SESSION['outlet'] ?></h3>
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <?php
                        if (isset($_GET['act'])){
                         $act = $_GET['act'];
                         if ($act==md5('setpasswd')){
                             include '../setpasswd.php';
                             }
                        }                       
                        else if (isset($_GET['menu'])){
                            $menu = $_GET['menu']; 
                            if ($menu=="OmsetDanOrder"){
                                include "inc/omset.php";
                            } else if ($menu=="Berlangganan"){
                                include "inc/berlangganan.php";
                            } else if ($menu=="TutupKasir"){
                                include "inc/tutup_kasir.php";
                            } else if ($menu=="DaftarProsesCucian"){
                                include "inc/terlambat.php";
                            } else if ($menu=="CariData"){
                                include "inc/cari_data.php";
                            }                                        
                        }
                        else{
?>
            <div class="row">                
                <?php include 'dash/omset.php'; ?>                        
            </div>                
          
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">                 
                            <div class="panel-body">
                                <?php include 'dash/otp.php'; ?>                        
                            </div>
                        </div>
                         <div class="col-md-6 col-sm-6">                 
                            <div class="panel-body">
                                <?php include 'dash/audit.php'; ?>                        
                            </div>
                        </div>
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
    </div>
</div>