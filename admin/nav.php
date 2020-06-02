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
                                    <a href="index.php?menu=deposit_subagen">Deposit Subagen</a>
                                </li>  
                                <li>
                                    <a href="index.php?menu=Data Terlambat">Data Terlambat</a>
                                </li>
                                <li><a href="data_delivery.php">Data Delivery</a></a></li>
                                <li>
                                    <a href="express.php">Data Express</a>
                                </li>  
                                <li>
                                    <a href="index.php?menu=sms_promo">SMS Promo Broadcast</a>
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
                                <li><a href="index.php?menu=prioritycontrol">Label Priority</a></li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Halaman<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../accounting/">Accounting</a>
                                </li>
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
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> KPI<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="kerja_operasional.php"> Input Kerja Operasional</a>
                                </li>
                                <li>
                                    <a href="#"> Input Kerja Corporate</a>
                                </li>
                                <li>
                                    <a href="kerja_reception.php"> Input Kerja Reception</a>
                                </li>
                                <li>
                                    <a href="#"> Input Kerja Delivery</a>
                                </li>
                                <li>
                                    <a href="kpi_operasional.php"> Riwayat KPI Terkunci</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Voucher & Promo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li><a href="?menu=VoucherPromoSMS">Voucher Promo SMS</a></li>
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
                                 <li><a href="mahasiswa.php">Mahasiswa</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Accounting<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="laporan.php?menu=Master Table">Master Table</a></li>
                                 <li><a href="laporan.php?form=Setoran">Setoran Bank dan Apotik</a></li>
                                 <li><a href="laporan.php?menu=Saldo Kas Resepsionis">Saldo Resepsionis</a></li>
                                 <li><a href="laporan.php?menu=Tabel_order">Tabel Order</a></li>
                                 <li><a href="cari_lap_omset.php">Laporan Omset/Order</a></li>
                                 <li><a href="laporan.php?menu=omset">Laporan Omset 2</a></li>
                                 <li><a href="index.php?menu=laporan penjualan">Laporan Penjualan</a></li>
                                 <li><a href="laporan.php?menu=Omset Subagen">Rekap Order Subagen</a></li>
                                 <li><a href="cari_lap_member.php">Member/Lgn</a></li>
                                 <li><a href="laporan.php?menu=cara_bayar_retail">Cara Bayar Retail</a></li>
                                 <li><a href="cari_lap_cash.php">Laporan Pemasukan</a></li>
                                 <li><a href="lap_tutup_kasir.php">Lap Tutup Kasir</a></li>
				                 <li><a href="header.php?laporan=tutup-kasir-sistem">Lap Tutup Kasir Baru</a></li>
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
                				<li><a href="laporan_customer.php">Marketing Summary</a></li>
                				<li><a href="https://admin.qnclaundry.com/?process-point">Titik Proses Cucian</a></li>
                				<li><a href="index.php?menu=referensi">Customer Referensi</a></li>
                				<li><a href="d_customer.php">Daftar Customer</a></li>
                				<li><a href="index.php?menu=setoran_bank">Setoran Bank</a></li>
                				<li><a href="index.php?menu=quality_audit">Rating Quality Audit</a></li>
                				<li><a href="cari_so_rcp.php">Stock Opname Reception</a></li>
                				<li><a href="absen_rcp.php">Data Absensi Reception</a></li>
                				<li><a href="log_workshop.php">Data Absensi Workshop</a></li>
                				<li><a href="cari_lap_operator.php">Laporan Operator</a></li>
                				<li><a href="cari_lap_cuci.php">Laporan Cuci</a></li>
                				<li><a href="cari_lap_pengering.php">Laporan Pengering</a></li>
                				<li><a href="cari_lap_setrika.php">Laporan Setrika</a></li>
                				<li><a href="cari_lap_packing.php">Laporan Packing</a></li>
                				<li><a href="index.php?menu=void_dan_reject">Data Void dan Reject</a></li>
                                <li><a href="laporan.php?menu=Delivery">Laporan Delivery</a></a></li>
                				<li><a href="lap_otp_operasional_cari.php">Lap OTP</a></li>
                				<li><a href="lap_spk.php">Lap SPK</a></li>
                				<!--<li><a href="lap_vocer.php">Lap Pemilik Voucher Diskon</a></li>-->
                				<li><a href="lap_vocer_r.php">Lap Pemilik Voucher Referral</a></li>
                				<li><a href="lap_vocer_user.php">Lap Pengguna Voucher</a></li>
                				<!--<li><a href="lap_vocer_r_user.php">Lap Pengguna Voucher Referral</a></li>-->
                				<li><a href="inventory.php">Inventory</a></li>
                				<li><a href="cari_lap_customer.php">Lap Customer</a></li>
                                <li><a href="index.php?menu=log_rcp">Laporan Log Reception</a></li>
                                <!--<li><a href="bonus_spk.php">Bonus SPK NEW</a></li>-->
                                <li><a href="denda_cucian_telat.php">Denda Operasional</a></li>
                                <li><a href="laporan.php?menu=QualityAudit">Laporan Quality Audit</a></a></li>
                                <li><a href="laporan.php?menu=langganan">Daftar Langganan</a></a></li>
                                <li><a href="laporan.php?menu=Komplain Customer">Komplain Customer</a></a></li>
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
       
