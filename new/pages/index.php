<?php 
include '../config.php';
include 'zonawaktu.php';

if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

$outlet = $_SESSION['outlet'];
$cabang = $_SESSION['cabang'];

function rupiah($angka){
	$jadi = number_format($angka,0,'.','.');
	return $jadi;
}

if($_SESSION['user_id']==false){
	header("location: ../");
}



?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>QnC Laundry</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
		<link rel="icon" href="../Logo bulat 2017.png">

		<link rel="stylesheet" href="assets/css/style.css" type="text/css" />


		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/jquery-ui.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/chosen.min.css" />

		
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/b-1.5.0/b-html5-1.5.0/datatables.min.css"/>


        <style type="text/css">
        	.panel {
			  position: relative;
			  background: #ffffff;
			  border-radius: 3px;
			  padding: 5px;
			  -webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
			          box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
			  margin-bottom: 30px;
			  -webkit-transition: all 0.3s ease-in-out;
			  -o-transition: all 0.3s ease-in-out;
			  transition: all 0.3s ease-in-out;
			}

			.widget-box {
			  -webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
			          box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
			  margin-bottom: 30px;
			  -webkit-transition: all 0.3s ease-in-out;
			  -o-transition: all 0.3s ease-in-out;
			  transition: all 0.3s ease-in-out;
			}
			
			td{
				font-size: 12px;
			}

        </style>

    

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script> 

		
		<!-- <![endif]-->
		
	</head>

	<body class="no-skin">
	    <?php 
	        if($_SESSION['level']!="mitra"){
            	include 'pesan_reject.php';
            }
	    ?>
		<div id="navbar" class="navbar navbar-primary ace-save-state" style="background-color: #28a745">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="" class="navbar-brand">
						<small>
							<?php echo strtoupper($cabang).' <small>'.ucwords($outlet).'</small>' ?>
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle" style="background-color: #3dbd5a;">
								<img class="nav-user-photo" src="assets/images/avatar2.png" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo ucwords($_SESSION['user_id']) ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<span style="text-align:center; background-color:#FFF;">
                        	<img style="width: 100%; margin-top: 10px; margin-bottom: 11px " src="../../Logo 2017.png">
                        </span>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<img style="width: 100%; margin-top: 12px; margin-bottom: 13px " src="../../Logo bulat 2017.png">
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="">
						<a href="index.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<?php 
					if($_SESSION['level']!="mitra"){
					   
						?>
						<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-desktop"></i>
								<span class="menu-text">
									Transaction
								</span>

								<b class="arrow fa fa-angle-down"></b>
							</a>

							<b class="arrow"></b>

							<ul class="submenu">

								<li class="">
									<a href="?menu=data-customer">
										<i class="menu-icon fa fa-caret-right"></i>
										Customer Data
									</a>

									<b class="arrow"></b>
								</li>

							</ul>
						</li>

						<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-pencil-square-o"></i>
								<span class="menu-text"> Forms </span>

								<b class="arrow fa fa-angle-down"></b>
							</a>

							<b class="arrow"></b>

							<ul class="submenu">
								<li class="">
									<a href="?form=spk">
										<i class="menu-icon fa fa-caret-right"></i>
										SPK
									</a>

									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="?form=stock_opname">
										<i class="menu-icon fa fa-caret-right"></i>
										Stock Opname
									</a>

									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="?form=workshop">
										<i class="menu-icon fa fa-caret-right"></i>
										Workshop
									</a>

									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="?form=Pembatalan">
										<i class="menu-icon fa fa-caret-right"></i>
										Pembatalan
									</a>

									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="?form=tutup_kasir">
										<i class="menu-icon fa fa-caret-right"></i>
										Tutup Kasir
									</a>

									<b class="arrow"></b>
								</li>
							</ul>
						</li>

						<?php
					}

					?>

							

					<?php 
					if($_SESSION['level']=="mitra" OR ($_SESSION['outlet']=="mojokerto" OR $_SESSION['outlet']=="Medan Utara" OR $_SESSION['outlet']=="Gading Serpong" OR $_SESSION['outlet']=="Cipulir" OR $_SESSION['outlet']=="Casa deParco")){
						?>

						<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-list-alt"></i>
								<span class="menu-text"> Laundry Process </span>

								<b class="arrow fa fa-angle-down"></b>
							</a>

							<b class="arrow"></b>

							<ul class="submenu">
								<li class="">
									<a href="?menu=checkin-workshop">
										<i class="menu-icon fa fa-caret-right"></i>
										Checkin Workshop
									</a>

									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="?menu=antrian_kiloan">
										<i class="menu-icon fa fa-caret-right"></i>
										Kiloan
									</a>

									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="?menu=antrian_potongan">
										<i class="menu-icon fa fa-caret-right"></i>
										Potongan
									</a>

									<b class="arrow"></b>
								</li>							
							</ul>
						</li>
						<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-barcode"></i>
								<span class="menu-text"> Label & Checkout </span>

								<b class="arrow fa fa-angle-down"></b>
							</a>

							<b class="arrow"></b>

							<ul class="submenu">
								<li class="">
									<a href="?menu=checkout-control">
										<i class="menu-icon fa fa-caret-right"></i>
										Checkout Control
									</a>

									<b class="arrow"></b>
								</li>							
							</ul>
						</li>

						<?php
					} 

					if($_SESSION['level']!="mitra"){	?>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-barcode"></i>
							<span class="menu-text"> Label & Checkout </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="?menu=checkout-control">
									<i class="menu-icon fa fa-caret-right"></i>
									Checkout Control
								</a>

								<b class="arrow"></b>
							</li>							
						</ul>
					</li>


					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Tables </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="?menu=laporan_omset">
									<i class="menu-icon fa fa-caret-right"></i>
									Omset
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="?menu=info-reject">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Reject Operator
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="">
								<a href="?menu=marketing_summary">
									<i class="menu-icon fa fa-caret-right"></i>
									Marketing Summary
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>	

					<?php 
					}
					?>				

					
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<h1>
									<?php
				                    if(isset($_GET['menu'])){
				                        $menu = $_GET['menu'];
				                        if($menu=="data-customer"){
				                        	echo "General Transaction ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> Customer Data</small>';                     
				                        } else if($menu=="antrian_kiloan"){
				                        	echo "Laundry Process ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> antrian kiloan</small>';
				                        } else if($menu=="antrian_potongan"){
				                        	echo "Laundry Process ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> antrian potongan</small>';
				                        } else if($menu=="laporan_omset"){
				                        	echo "Omset ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> potongan dan kiloan</small>';
				                        } else if($menu=="checkout-control"){
				                        	echo "Receipt Label ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> checkout Label</small>';
				                        } else if($menu=="checkin-workshop"){
				                        	echo "Checkin ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> Checkin Workshop</small>';
				                        } else if($menu=="info-reject"){
				                        	echo "Info ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> Reject Operator</small>';
				                        } 
				                    }

				                    else if(isset($_GET['transaksi'])){
			                        	echo "General Transaction ";
			                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> order & pembayaran</small>';
			                        }

				                    else if(isset($_GET['form'])) {
				                    	$form = $_GET['form'];
				                    	if($form=="spk") {
				                    		echo "SPK ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> order belum spk</small>';     
				                    	} else if($form=="stock_opname") {
				                    		echo "Stock Opname ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> cucian terakhir</small>';     
				                    	} else if($form=="stock_opname") {
				                    		echo "Stock Opname ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> cucian terakhir</small>';     
				                    	} else if($form=="workshop") {
				                    		echo "Workshop ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> cucian ready</small>';     
				                    	} else if($form=="Pembatalan_order") {
				                    		echo "Pembatalan ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> void dan edit</small>';     
				                    	} else if($form=="tutup_kasir") {
				                    		echo "Tutup Kasir ";
				                        	echo '<small><i class="ace-icon fa fa-angle-double-right"></i> Kasir</small>';     
				                    	}
				                    }
				                    else { 
				                    	if($_SESSION['level']!="mitra")
				                    	{
				                    		?>
				                    		Dashboard
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												overview &amp; stats
											</small>
				                    		<?php
				                    	} else 
				                    	{
				                    		?>
				                    		Dashboard
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												overview
											</small>
				                    		<?php
				                    	}
				                    }
				                    ?>
								</h1>
							</li>
							
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">

							<div class="ace-settings-box clearfix" id="ace-settings-box">
								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<div class="pull-left">
											<select id="skin-colorpicker" class="hide">
												<option data-skin="no-skin" value="#438EB9">#438EB9</option>
												<option data-skin="skin-1" value="#222A2D">#222A2D</option>
												<option data-skin="skin-2" value="#C6487E">#C6487E</option>
												<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
											</select>
										</div>
										<span>&nbsp; Choose Skin</span>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
										<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
										<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
										<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
										<label class="lbl" for="ace-settings-add-container">
											Inside
											<b>.container</b>
										</label>
									</div>
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
										<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
										<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
									</div>
								</div><!-- /.pull-left -->
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->
						
								
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div id="datac" style="margin-bottom: 20px">
									
								</div>

								<?php 
			                    if(isset($_GET['menu'])){ ?>
									<?php 
									$menu = $_GET['menu'];
			                        if($menu=="data-customer"){
			                            include 'form/customer.php';
			                        }
			                        else if($menu=="antrian_kiloan"){
			                        	include 'include/antrian_kiloan.php';
			                        }
			                        else if($menu=="antrian_potongan"){
			                        	include 'include/antrian_potongan.php';
			                        } else if($menu=="test"){
		                        		include 'test.php';
		                        	} else if($menu=="laporan_omset"){
		                        		include 'include/omset.php';
		                        	} else if($menu=="checkout-control"){
		                        		include 'include/checkout_control.php';
		                        	} else if($menu=="checkin-workshop"){
		                        		include 'include/checkin.php';
		                        	} else if($menu=="info-reject"){
		                        		include 'include/reject-opr.php';
		                        	} else if($menu=="marketing_summary"){
		                        		include 'include/marketing_summary.php';
		                        	} 					                        
			                    }

			                    else if(isset($_GET['transaksi'])) {
			                    	$menu = $_GET['transaksi'];				                  
			                        include 'include/transaksi.php';
			                    }

			                    else if(isset($_GET['form'])) {
			                    	$form = $_GET['form'];
			                    	if($form=="spk") {
			                    		include 'form/f_spk.php';    
			                    	} else if($form=="stock_opname") {
			                    		include 'form/f_so.php';    
			                    	} else if($form=="workshop") {
			                    		include 'form/f_workshop.php';    
			                    	} else if($form=="Pembatalan") {
			                    		include 'form/form_pembatalan.php';    
			                    	} else if($form=="tutup_kasir") {
			                    		include 'form/tutup_kasir.php';    
			                    	} 
			                    }

			                    else{ ?>
				                    <!-- <div class="alert alert-block alert-success">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-check green"></i>

										Welcome to
										<strong class="green">
											NEW QNCLAUNDRY
											<small>(v2)</small>
										</strong>
									</div> -->

									<div class="row extra-omset hidden">
										<?php 
										if($_SESSION['level']!="mitra"){
											include 'dash/omset_bulanan.php';
										} else {

										}

										?>
									</div>

									
									<div class="row">
										 <?php 
											if($_SESSION['level']=="reception" && $_SESSION['cabang']=="Mojokerto"){
												 include 'dash/saldo_kasir.php'; 
											}

											?>  
								    </div>

									<div class="panel panel-default">
						                <div class="panel-body">
											<div class="row">  
												<?php 
												if($_SESSION['level']!="mitra"){
													 include 'dash/omset.php'; 

												} else {													
													include 'dash/checkin.php';
												}

												?>                   
								            </div>    
								        </div>
								    </div>   

								    <?php 
									if($_SESSION['level']!="mitra"){
											
										?>									
										
							            <div class="panel panel-default">
							                <div class="panel-body">
							                <b style="font-size:18px">Data Checkin Workshop</b>
							                <?php
							                if($_SESSION['outlet']=="Cinere"){
							                   echo '<p>Catatan :  Tolong dicek terus bahwa semua nota masuk ke dalam sini ketika berada di krisna laundry, dan pastikan semua proses terlaksana dengan baik!</p><b style="color:red">Proses Cuci, Kering, Setrika, dan Packing harus terinput Realtime!</b>';
							                }
							                ?>
							                
							                            	<?php 
															include 'dash/chekin_workshop.php';
															?>   
							                </div>
							            </div>

										<?php
									}  else {								
										include 'dash/chekin_workshop.php';
									}    
						         }
								?>
								

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<!-- <div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">NEW</span>
							QNC Application &copy; 2017
						</span>

						&nbsp; &nbsp;
					</div>
				</div>
			</div> -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		
		<!--[if IE]>
		<script src="assets/js/jquery-1.11.3.min.js"></script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="assets/js/jquery-ui.min.js"></script>
		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<script src="assets/js/jquery.dataTables.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/chosen.jquery.min.js"></script>
		<script src="assets/js/spinbox.min.js"></script>
		
		<!--Datatable-->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/b-1.5.0/b-html5-1.5.0/b-print-1.5.0/datatables.min.js"></script>

		<script type="text/javascript">
			jQuery(function($) {
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true});
				};

				$('#info-pesan').animate({
					top		: "190px",
					width	: "auto",
					opacity	: 0.75
				}, 1000);

				$('a.close').click(function() {
					$(this).parent().slideUp(800);
					return false;
				});
			});

			$('.btn-ombulanan').click(function(){
				$('.extra-omset').removeClass('hidden');
			});

			$(".nav-search-input").keypress(function(event){
				if ( event.which == 13 ) {
				     event.preventDefault();
				     var cari = $('.nav-search-input').val();
						$('#datac').load('include/data_cari.php?key='+cari);
				  }
					
			})
				

		</script>
		

		
	</body>
</html>
