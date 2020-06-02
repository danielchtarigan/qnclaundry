 <?php
session_start();
include "validasi.php";
$cek = val_session();
if( $cek != 3 )
{
	header("location:../../index.php");
	exit();
}
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">
				Toggle navigation
			</span>
			<span class="icon-bar">
			</span>
			<span class="icon-bar">
			</span>
			<span class="icon-bar">
			</span>
		</button>
		<a class="navbar-brand" href="index.php">
			QNC LAUNDRY
		</a>
	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">


		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-user fa-fw">
				</i><?php echo $_SESSION['name'];?> (<?php echo $_SESSION['nama_outlet'];?> )
				<i class="fa fa-caret-down">
				</i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li>
					<a href="#">
						<i class="fa fa-user fa-fw">
						</i>User Profile
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-gear fa-fw">
						</i>Settings
					</a>
				</li>
				<li class="divider">
				</li>
				<li>
					<a href="../../logout.php">
						<i class="fa fa-sign-out fa-fw">
						</i>Logout
					</a>
				</li>
			</ul>
			<!-- /.dropdown-user -->
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li class="sidebar-search">
					<div class="input-group custom-search-form">


					</div>
					<!-- /input-group -->
				</li>
				<li>
					<a href="index.php">
						<i class="fa fa-dashboard fa-fw">
						</i>Dashboard
					</a>
				</li>

				<li>
					<a href="#">
						<i class="fa fa-table fa-fw">
						</i>Reception
						<span class="fa arrow">
						</span>
					</a>
					<ul class="nav nav-second-level">
						<li>
							<a href="customer.php">
								Input Data
							</a>
						</li>
						<li>
							<a href="belum_spk.php">
								SPK
							</a>
						</li>
						<li>
							<a href="workshop.php">
								Dari Workshop
							</a>
						</li>
						<li>
							<a href="ambil_customer.php">
								Pengambilan
							</a>
						</li>

						<li>
							<a href="tutup_kasir.php">
								Tutup Kasir
							</a>
						</li>
						<li>
							<a href="setoran_bank.php">
								setoran bank
							</a>
						</li>
						<li>
							<a href="stok_opname.php">
								Stok Opname
							</a>
						</li>
						<li>
							<a href="cari.php">
								Cari
							</a>
						</li>           
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li>
					<a href="#">
						<i class="fa fa-table fa-fw">
						</i>Operasional
						<span class="fa arrow">
						</span>
					</a>
					<ul class="nav nav-second-level">
						<li>
							<a href="cuci.php">
								Cuci
							</a>
						</li>

						<li>
							<a href="pengering.php">
								pengering
							</a>
						</li>
						<li>
							<a href="setrika.php">
								Setrika Ritel
							</a>
						</li>

						<li>
							<a href="packing.php">
								Packing
							</a>
						</li>
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li>
					<a data-toggle="collapse" data-target="#login">
						<i class="fa fa-table fa-fw"></i>
						Admin
						<span class="fa arrow"></span>
					</a>

				<div id="login" class="collapse">
					<div class="container">
						<div class=="row">
							<div class="col-xs-0 col-sm-0"></div>
							
							<div class="col-xs-2 col-sm-2">
								<form method="POST" action="ceklogin.php"><br>									
									<div class="form-group">
										<input type="text" id="user" name="user" class="form-control" placeholder="username" required>
									</div>
									<div class="form-group">
										<input type="password" id="password" name="password" class="form-control" placeholder="sandi" required>
									</div></br>
									<div class="form-group">
										<button class="btn btn-sm btn-primary btn-block" type="submit">Login</button>
									</div>
								</form>
								
								<div class="col-xs-2 col-sm-2"></div>
							</div>
						</div>
					</div>
				</div>
				</li>

				<li>
					<a href="#">
						<i class="fa fa-files-o fa-fw">
						</i>Laporan
						<span class="fa arrow">
						</span>
					</a>
					<ul class="nav nav-second-level">

						<li>
							<a href="lap_order.php">
								Laporan Order
							</a>
						</li>
						<li>
							<a href="lap_operasional.php">
								Laporan Operasional
							</a>
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
