<?php
session_start();
include '../config.php';
include '../laporan_pegawai_functions.php';

	$user_id= $_SESSION['user_id'];
			$workshop = $_SESSION['workshop'];

if (isset($_SESSION['level']))
{
	// jika level admin
	if ($_SESSION['level'] == "operator")
   {

   }
    else if ($_SESSION['level'] == "reception")
   {
       header('location:../reception/index.php');
   }
   else if ($_SESSION['level'] == "packer")
   {
       header('location:../packer/index.php');
   }
   else if ($_SESSION['level'] == "spectator")
   {
       header('location:../spectator/index.php');
   }
   else if ($_SESSION['level'] == "delivery")
   {
       header('location:../delivery/index.php');
   }
}
if (!isset($_SESSION['user_id']) and !isset($_SESSION['level']) and !isset($_SESSION['nama_outlet']))
{
	header('location:../index.php');
}
date_default_timezone_set('Asia/Makassar');
$endate = date("Y-m-d");
$qhit = mysqli_query($con, "select avg(bersih) as avg_bersih, count(bersih) as c_bersih, sum(bersih) as t_bersih from (select bersih from quality_audit a, reception b where a.no_nota=b.no_nota and a.tgl_input between '2016-04-01' and '$endate' and b.op_cuci='$_SESSION[user_id]' order by a.id desc limit 100) as subt");
											$rhit = mysqli_fetch_array($qhit);
											$poin = round($rhit['avg_bersih'],2);

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');
$tanggal = date("Y-m-d");
include '../cek_session.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Anthony Poluan">
    <title>Halaman Operator</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!--	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <link href="../admin/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

</head>
<body>
    <div id="wrapper">
        <?php include 'manifest_driver.php'; ?>
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
						<li><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['user_id'].' ('.$poin.' poin) ';
						if ($rhit['c_bersih']<100) echo '--P--';
						?>
						                    <div align="left" style="background-image:url(image/star_back.jpg); background-position:left; background-repeat:no-repeat; padding-top:0px; padding-left:0px;" width="130px;" heigh="25px;">
                                            <?php
											if ($poin>5) $poin=5;
												$persen = $poin/5;

											if ($poin>0){
												$panjang = $persen*130;
												?>
												<table><tr>
                                                <td style="width:<?php echo $panjang; ?>px; text-align:left; float:left; background-image:url(image/star_show.jpg); height:25px; margin-left:0px;">&nbsp;
                                                </td>
												</tr></table>
                                                <?php
											}
                                            ?>
                                            </div>

						</li>
                        <li><a href="index.php?act=<?php echo md5('setpasswd'); ?>"><i class="fa fa-user fa-fw"></i> Change Password</a></li>
                         <li><a href="act_log_pulang.php"><i class="fa fa-user fa-fw"></i> Logout</a></li>
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
                            <a href="#"><i class="fa fa-table fa-fw"></i> Workshop<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?menu=check_in_workshop" >Check in Workshop</a>
                                </li>
                                <li>
                                    <a href="index.php?menu=daftar_workshop" >Daftar Workshop</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Shortir & Label<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?menu=label" > Label</a>
                                </li>                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Cuci<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="antrian_cuci_kiloan.php" > Antri Kiloan</a>
                                </li>
                                <li>
                                    <a href="antrian_cuci_potongan.php" > Antri Potongan</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="cari_nota_pengering.php" ><i class="fa fa-edit fa-fw"></i> Kering</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Hotel<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li><a href="../corporate/index.php" >Hotel</a></li>
								<li><a href="setrika_hotel.php" >Setrika Hotel</a></li>
								<li><a href="packing_hotel.php" >Packing Hotel</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Form<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="index.php?menu=tutupShift" > Tutup Shift</a></li>
                                <li><a href="cari_rincian.php" > Cek Data</a></li>
                  	            <li><a href="f_rijeck.php" > Form Rijeck</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="lap_operator.php" ><i class="fa fa-bar-chart-o fa-fw"></i> Laporan<span class="fa arrow"></span></a>

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
                    <h3 class="page-header">Halaman Operator <?php echo $_SESSION['workshop'] ?></h3>
                    <div id="info_pesan1"></div>             
                </div>
                
                <!-- <script type="text/javascript">-->
                <!--    $(function(){-->
                <!--       function info_pesan1() {-->
                <!--            $('#info_pesan1').load('info_pesan1.php');-->
                <!--        }-->

                <!--        setTimeout(function(){info_pesan1()},6000);-->

                <!--    })-->
                <!--</script>-->
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <?php
						if (isset($_GET['menu'])){
							if ($_GET['menu']=='check_in_workshop'){ $menu="form_checkin.php"; }
                            else if ($_GET['menu']=='mterima'){$menu="mterima.php";}
                            else if ($_GET['menu']=='am'){$menu="../act/act_manifest.php";}
                            else if ($_GET['menu']=='daftar_workshop'){$menu="daftar_checkin.php";}
                            else if ($_GET['menu']=='mserah'){$menu="mserah.php";}
                            else if ($_GET['menu']=='dmserah'){$menu="d_mserah.php";}
                            else if ($_GET['menu']=='mterima2'){$menu="mterima2.php";} 
                            else if ($_GET['menu']=='tutupShift'){$menu="tutup_shift.php";}  
                           else if ($_GET['menu']=='label'){$menu="f_label.php";} 
                            else $menu="nothing.php"
								?>
								<div id="check_in">
								 <?php include "include/$menu"; ?>
								</div>
                                                       <?php
						}
						else{
?>
<?php $data = progres_pegawai($_SESSION['user_id'],'operator'); ?>

<p style="font-size:20px"><strong>POIN HARI INI: <?php echo $data['poin_harian']; ?>/<?php echo $data['target_harian']; ?></strong></p>
<hr>
<strong>PROGRES PEGAWAI</strong>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
		<thead>
		<tr>
			<th></th>
			<th>Bulan Ini</th>
			<th>Bulan Lalu</th>
		</tr>
		</thead>
		<tbody>
			<tr>
				<td><strong>Total Poin</strong></td>
				<td><?php echo $data['poin_bulan_ini'];?></td>
				<td><?php echo $data['poin_bulan_lalu'];?></td>
			</tr>
			<tr>
				<td><strong>Target Poin</strong></td>
				<td><?php echo $data['target_bulan_ini'].' ('.$data['jumlah_hari_kerja'].' hari kerja)';?></td>
				<td><?php echo $data['target_bulan_lalu'].' ('.$data['jumlah_hari_kerja_bulan_lalu'].' hari kerja)';?></td>
			</tr>
			<tr>
				<td><strong>Quality Audit</strong></td>
				<td><div align="left" style="background-image:url(image/star_back.jpg); background-position:left; background-repeat:no-repeat; padding-top:0px; padding-left:0px;display: inline-block; vertical-align: middle;width: 130px;height:25px">
					<?php if ($data['qa_bulan_ini']>5) $data['qa_bulan_ini']=5; $persen = $data['qa_bulan_ini']/5;
					$panjang = $persen*130; ?>
						<table><tr>
							<td style="width:<?php echo $panjang; ?>px; text-align:left; float:left; background-image:url(image/star_show.jpg); height:25px; margin-left:0px;">&nbsp;
							</td>
						</tr></table>
					</div>(<?php echo $data['qa_bulan_ini']; ?>)</td>
				<td><div align="left" style="background-image:url(image/star_back.jpg); background-position:left; background-repeat:no-repeat; padding-top:0px; padding-left:0px; display: inline-block; vertical-align: middle;width: 130px;height:25px">
					<?php if ($data['qa_bulan_lalu']>5) $data['qa_bulan_lalu']=5; $persen = $data['qa_bulan_lalu']/5;
					if ($data['qa_bulan_lalu']>0){ $panjang = $persen*130; ?>
						<table><tr>
							<td style="width:<?php echo $panjang; ?>px; text-align:left; float:left; background-image:url(image/star_show.jpg); height:25px; margin-left:0px;">&nbsp;
							</td>
						</tr></table>
							<?php } ?>
					</div>&nbsp;(<?php echo $data['qa_bulan_lalu']; ?>)</td>
			</tr>
			<tr>
				<td><strong>OTP</strong></td>
				<td><?php echo $data['otp_bulan_ini']; ?>%</td>
				<td><?php echo $data['otp_bulan_lalu']; ?>%</td>
			</tr>
		</tbody>
	</table>
</div>
<strong>DATA EXPRESS</strong>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
		<tr>
			<th>No</th>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Express</th>
			<th>Workshop</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM reception  WHERE cuci=false and express<>0 and kembali=false and packing=false ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);

			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$no</td>
						<td>$data[tgl_input]</td>
						<td>$data[no_nota]</td>
						<td>$data[nama_customer]</td>
						<td>"; if ($data['express']==1) echo 'Express'; else if ($data['express']==2) echo 'Double Express'; else if ($data['express']==3) echo 'Super Express'; echo "</td>
						<td>"; if ($data['workshop']==null) echo 'belum'; else echo $data['workshop']; echo"</td>
						</tr>";
			$no++;
			}
			?>
		</tbody>
	</table>
</div>

<div class="col-xs-12" >
<strong>DATA CUCI</strong>
</div>
<div class="col-xs-12" >
&nbsp;
</div>
<div class="form-group">
<form action="index.php" method="GET">
                                   <label class="control-label col-xs-2" for="voucher">Tanggal Awal</label>
		                <div class="form-group input-group date form_date col-md-2" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="padding-left:0px;">
	                    <input class="form-control" size="10" type="text" name="tgl_awal" id="tgl_awal">
					     <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		                </div>
                                </div>

   				                <div class="form-group">
                                   <label class="control-label col-xs-2" for="voucher">Tanggal Akhir</label>
		                				<div class="form-group input-group date form_date col-md-2" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="padding-left:0px;">
	                    <input class="form-control" size="10" type="text" name="tgl_akhir" id="tgl_akhir">
					     <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		                				</div>
                                </div>
                                <div><input type="submit" value="View" name="submit" class="col-xs-4"></div>
</form>
<div class="col-xs-12" >
&nbsp;
</div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
		<tr>
			<th>No</th>
			<th>Tanggal cuci</th>
			<th>No Nota</th>
		</tr>
		</thead>
		<tbody>
			<?php
			if ((isset($_GET['tgl_awal'])) and (isset($_GET['tgl_akhir']))){
			 if ($_GET['tgl_akhir']==""){
			  $tgl = $_GET['tgl_awal'];
			  $query = "SELECT tgl_cuci,no_nota FROM cuci where op_cuci='$user_id' and tgl_cuci like '%$tgl%' order by tgl_cuci DESC";
			 }
			 else{
			  $tgl = $_GET['tgl_awal'];
			  $tgl1 = $_GET['tgl_akhir'];
			  $query = "SELECT tgl_cuci,no_nota FROM cuci where op_cuci='$user_id' and tgl_cuci between '$tgl' and '$tgl1' order by tgl_cuci DESC";
			 }
			}
			else{
			$query = "SELECT tgl_cuci,no_nota FROM cuci where op_cuci='$user_id' and tgl_cuci like '%$tanggal%' order by tgl_cuci DESC";
			}
			$tampil = mysqli_query($con, $query);

			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$no</td>
						<td>$data[tgl_cuci]</td>
						<td>$data[no_nota]</td>

					  </tr>";
			$no++;
			}
			?>
		</tbody>
	</table>
</div>
<?php
}
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/jquery-1.11.0.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="../js/sb-admin-2.js"></script>

<script type="text/javascript" src="../admin/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../admin/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
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
