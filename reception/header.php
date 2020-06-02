<?php
include '../config.php';
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	       <link href="../lib/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables_themeroller.css" />
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="../lib/css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.yadcf.css">
	<link rel="stylesheet" type="text/css" href="../lib/css/dataTables.tableTools.css">
 <link rel="icon" href="../favicon.png">
<?php	
		session_start();
	$user_id= $_SESSION['user_id'];
	$ot= $_SESSION['nama_outlet'];
if (isset($_SESSION['level']))
{
	
	if ($_SESSION['level'] == "reception")
   {   
  
   }
  
   
   else if ($_SESSION['level'] == "operator")
   {
       header('location:../operator/index.php');
   }
   else if ($_SESSION['level'] == "packer")
   {
       header('location:../packer/index.php');
   }
}

if (!isset($_SESSION['user_id']) and !isset($_SESSION['level']) and !isset($_SESSION['nama_outlet']))
{
	header('location:../index.php');
}
	
if ($_SESSION['nama_outlet']=='')
{
	header('location:../index.php');
}		
	
?>
	
	<title>QNCLAUNDRY</title>

<script>
					function kirim_form1()
					{
						 
    		     	    $('#pesan_kirim1').html('Loading ...');
			   			$('#pesan_kirim1').slideDown('slow');
	  					  
	  					  var passbaru=$('#passbaru').val();
	                      var passbaru1=$('#passbaru1').val();
	                      var passlama=$('#passlama').val();
	                      
	                      
			            if ( passlama == "" ){
						alert("password lama Masih Kosong");
						$("#passlama").focus();
						return false;
						} else if ( passbaru == "" ){
						alert("passport baru Masih Kosong");
						$("#passbaru").focus();
						return false;
						}else if ( passbaru !== passbaru1 ){
						alert("passporttidak sama Masih Kosong");
						$("#passbaru").focus();
						return false;
						}
					
			
                        
                        $.ajax({
                        	url:'../gantip.php',
					        type     : 'POST',
					        dataType : 'html',
					        data:'passbaru='+passbaru+'&passlama='+passlama+'&passbaru1='+passbaru1,
                          	success  : function(respons){
                         	
                       		 $('#pesan_kirim1').html(respons);
                       		 $('#passbaru').val("");
                        	 $('#passbaru1').val("");
                        	 $('#passlama').val("");

                            }
                        })
                    }
                    
     </script>
     <style>
        .navbar-default .navbar-nav>li>a {
                color: #85B92E;
        }
        .navbar-default:hover .navbar-nav>li>a:hover {
                color: #85B92E;
                border-bottom:#85B92E 2px solid;
        }
        .navbar-default:focus .navbar-nav>li>a:focus {
                color: #85B92E;
        }
        .btn-success {
            color: #fff;
            background-color: #85B92E;
            border-color: #85B92E;
        }
        .btn-success.active, .btn-success.focus, .btn-success:active, .btn-success:focus, .btn-success:hover, .open>.dropdown-toggle.btn-success {
            color: #85B92E;
            background-color: rgba(255,255,255,0);
            border-color: #85B92E;
        }
        .ui-widget-header {
            border: 1px solid #85B92E;
            background: #85B92E url("images/ui-bg_gloss-wave_55_5c9ccc_500x100.png") 50% 50% repeat-x;
            color: #ffffff;
            font-weight: bold;
        }
        .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
            color: #FFFFFF;
        }
        .dataTables_wrapper .dataTables_paginate .fg-button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0.5em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            color: #FFFFFF !important;
            border: 1px solid transparent;
        }
        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
            border: 1px solid #85B92E;
            background: #85B92E url("images/ui-bg_glass_85_dfeffc_1x400.png") 50% 50% repeat-x;
            font-weight: bold;
            color: #46690D;
        }
        input,select{
            color:#46690D;
        }
        hr{
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(133,185,46,0.75), rgba(0, 0, 0, 0));
        }
        span.textbox.textbox-readonly.textbox-invalid{
            border:none;
        }
        span.textbox.textbox-readonly{
            border:none;
        }
        
        .navbar-collapse.navHeaderCollapse.collapse.in{
            border:none;
            min-width: 200px;
        }
        #alert_modal{
            position:fixed;
            color:rgba(0,0,0,0);
            top:0;
            bottom:0;
            left:0;
            right:0;
            display:none;
            z-index: 9999999999999999999999;
        }
        
        #alert{
            min-width: 500px;
            position:absolute;
            height:auto;
            left:50%;
            top:50%;
            transform: translate(-50%,-50%);           
            border:none; margin:0 auto; padding: 20px;  border:3px solid rgba(0,0,0,0); -webkit-border-radius:0px; -moz-border-radius:0px; border-radius:0px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);   margin-bottom:20px; color:#000000;
            background:#fff;
            border-radius: 5px;
        }
     </style>  
	</head>
	<body>
            <div id="alert_modal" style="display:none;">
                <div id="alert">
                    <center>
                        <strong style="color:#85B92E;font-size:18px;">
                            Informasi
                        </strong>
                    </center>
                    <hr>
                    <div style="text-align:center;" id="alert_data">                        
                    </div>
                </div>
            </div>  
            
            
	 <div class="navbar navbar-default" style="background-color: #fff;border:none; margin:0 auto; padding: 20px; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:0px; -moz-border-radius:0px; border-radius:0px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);   margin-bottom:20px; color:#000000;min-height:200px;">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                  <img src="../logo.png"/></a>
<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
                   <span class = "icon-bar"></span>
                  <span class = "icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse navHeaderCollapse">
                    <ul class="nav navbar-nav navbar-right" style="font-size: 15pt;color: #ff0000;margin-top: 60px;">
               
             	<li><a href="index.php">Home</a></li>
				
				<li><a href="terlambat.php">Cek Terlambat</a></li>
				<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Form<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
<li><a href="belum_spk.php">SPK</a></li> 
<li><a href="cari_ambil.php">Pengambilan</a></li>
<li><a href="index.php?menu=pembatalan">Pembatalan Transaksi</a></li>
<li><a href="f_so.php">Stok Opname</a></li>
<li><a href="cari_complain.php">Komplain</a></li>
<li><a href="index.php?menu=setoran_bank">Setoran Bank</a></li>
<li><a href="index.php?menu=audit">Quality Audit</a></li>
<li><a href="cetak_label_box.php">Cetak Label box</a></li>
<!--<li><a href="f_voucher2.php">Voucher Referall</a></li>-->


                  </ul>
                </li>

<li><a href="data_delivery.php">Delivery</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Laporan<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">

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

<li><a href="cari_lap_tutup_kasir.php">Lap Tutup Kasir</a></li>
<li><a href="lap_piutang.php">Lap Piutang</a></li>
<li><a href="cari_lap_cs.php">Customer baru</a></li>
<li><a href="cari_tidak_tk.php">Tidak Tutup Kasir</a></li>
</ul>
                </li>
                                <li><a href="input_daftar_setrika_admin.php">Input Admin</a></li> 
				<li> <a data-id='0' data-toggle="modal" href="#" data-target="#tambah-data"> Ubah Password</a></li>
                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= ucfirst($user_id) ?><span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a>(<?= ucfirst($ot) ?>)</a></li>
                                        <li><a href="../logout.php">Log Out</a></li>
                                    </ul>
                                </li>  
						
                    </ul>
                </div>
            </div>
            </div>
            <div  style="height:50px; position:relative;"></div> 

<div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		
		<div class="modal-content">

<form  action="" method="post" class="form-horizontal"><br>
<h4  align="center"><strong>Ganti Pasword</strong></h4><br> 
<div id="pesan_kirim1" style="display:none"></div>
           <div class="form-group"><label for="no_nota" class="control-label col-xs-3">Password Lama</label><div class="col-xs-4">
              <input type="password" placeholder="password lama" id="passlama" name="passlama" class="form-control">
            </div></div>
            <div class="form-group"><label for="no_nota" class="control-label col-xs-3">Password Baru</label><div class="col-xs-4">
              <input type="password" placeholder="password baru" id="passbaru" name="passbaru" class="form-control">
            </div></div>
            <div class="form-group"><label for="no_nota" class="control-label col-xs-3">Ulangi Password Baru</label><div class="col-xs-4">
              <input type="password" placeholder="passbaru" class="form-control" id="passbaru1" name="passbaru1">
            </div></div>
            
            
           			<div class="modal-footer">
           			<input type="button" value="Simpan"  onclick="kirim_form1();" class="btn btn-success">
				
					<button class="btn btn-default" data-dismiss="modal">Tutup</button>		</div>

				</form>
			</div>
		</div>
	</div>


 <script src = "../lib/js/jquery-2.1.3.min.js"></script>
   <script src = "../lib/js/bootstrap.min.js"></script>

	<script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.yadcf.js"></script>
<script type="text/javascript" language="javascript" src="../lib/js/jquery.autoSave.min.js"></script>
<script type="text/javascript" language="javascript" src="../lib/js/dataTables.tableTools.js"></script>
  <script src="../lib/js/jquery.form.js"></script>

        <script>
            $(document).ready(function(){               
                    $(document).on("click","#alert_modal",function(){
                        //$(this).slideUp();
                        alert("Maaf anda belum mengaktifkan vocer referal untuk member, Silahkan tekan tombol Aktifkan Vocer.");
                        return false;
                    });
                    $(document).on("click","#alert",function(){
                        return false;
                    });
            });
         </script>    
   	
    </body>
        
</html>