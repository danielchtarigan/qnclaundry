<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../lib/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables_themeroller.css" />
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="../lib/css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.yadcf.css">
 <link rel="icon" href="../favicon.png">
<?php
include '../config.php';
		session_start();
$user_id= $_SESSION['user_id'];
$workshop = $_SESSION['workshop'];
if (isset($_SESSION['level']))
{
	// jika level admin
	if ($_SESSION['level'] == "packer")
   {   
  
   }
   else if ($_SESSION['level'] == "operator")
   {
       header('location:../operator/index.php');
   }
   else if ($_SESSION['level'] == "reception")
   {
       header('location:../reception/index.php');
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
if (!isset($_SESSION['user_id']) and !isset($_SESSION['level']) and !isset($_SESSION['nama_outlet'])){
	header('location:../index.php');
}
date_default_timezone_set('Asia/Makassar');
$endate = date("Y-m-d");
$qhit = mysqli_query($con, "select avg(harum) as avg_harum, count(harum) as c_harum, sum(harum) as t_harum from (select harum from quality_audit a, reception b where a.no_nota=b.no_nota and a.tgl_input between '2016-04-01' and '$endate' and b.user_packing='$_SESSION[user_id]' order by a.id desc limit 100) as subt");
											//select *, avg(harum) as avg_harum from quality_audit a, reception b where a.no_nota=b.no_nota and b.user_packing='$rcustomer[name]' and a.tgl_input between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]'
											$rhit = mysqli_fetch_array($qhit);											 
											$poin = round($rhit['avg_harum'],2);	
		
	
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



</head>
	<body>
	 <div class="navbar navbar-default" style="background-color: #e075f7;">
            <div class="container">
                <a class="navbar-brand" style="font-size: 20pt;color: #030204;" href="index.php">
                    QnCLaundry.com

	            </a>
	            
                <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
                    <span class = "icon-bar"></span>
                  <span class = "icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse navHeaderCollapse">
                    <ul class="nav navbar-nav navbar-right" style="font-size: 15pt;color: #ff0000;">
<li><a href="d_setrika.php">Daftar Setrika</a></li>
<li><a href="input_daftar_setrika_admin.php">Input Admin</a></li>

             			
<li><a href="antrian_packing.php">Antrian Packing</a></li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Manifest<span class="caret"></span></a>
  <ul class="dropdown-menu" role="menu">
    <li><a href="form_outsource.php">Form Outsource</a></li>
  </ul>
</li>
  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cek<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
             			<li><a href="terlambat.php">Cek Terlambat</a></li>
<li><a href="cari_rincian.php">Cari Data</a></li> 
				<li><a href="view_all.php">Cari</a></li> 
                    
<li><a href="lap_packer.php">Laporan</a></li> 
                    
                  </ul>
                </li>
<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Akun<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
             			<li> <a data-id='0' data-toggle="modal" href="#" data-target="#tambah-data"> Ubah Password</a></li>
						      <li><a href="act_log_pulang.php">Log Out</a></li> 
                  </ul>
                </li>


						
                    </ul>
                </div>
            </div>
        </div>
        <div  style="width:350px; margin:0 auto; position:relative;">
<marquee behavior=alternate  style="font-size: 25px;color: #ff0000" > <?php echo "Hai: ".$user_id.' ('.$poin.' poin) ';
						
						?>
						                    <div align="left" style="background-image:url(../operator/image/star_back.jpg); background-position:left; background-repeat:no-repeat; padding-top:0px; padding-left:0px;" width="130px;" heigh="25px;">
                                            <?php
											if ($poin>5) $poin=5;
												$persen = $poin/5;
												
											if ($poin>0){
												$panjang = $persen*130;
												?>
												<table><tr>
                                                <td style="width:<?php echo $panjang; ?>px; text-align:left; float:left; background-image:url(../operator/image/star_show.jpg); height:25px; margin-left:0px;">&nbsp;
                                                </td><td style="width:<?php echo 150-$panjang;?>px;"></td><td><?php if ($rhit['c_harum']<100) echo '--P--';?></td>
												</tr></table>
                                                <?php
											}
                                            ?>
                                            </div>

</MARQUEE>
        <marquee behavior=alternate  style="font-size: 25px;color: #ff0000" onmouseover="this.stop()" onmouseout="this.start()">
<a href="index.php">Lihat Express</a></marquee></div> 
<marquee behavior=alternate   onmouseover="this.stop()" onmouseout="this.start()">
<b style="font-size:25px">Khusus DAYA :</b> <a style="font-size:20px;color:green" href="mterima.php"><u>klik tulisan ini, terima kiriman cucian dari Toddopuli atau buka <b>Manifest Transfer Masuk</b></u></font></marquee> 
<marquee style="font-size: 20px;color: #0215fd" align="center" behavior="Scroll">buka <b>Manifest Serah Outlet</b> untuk kirim cucian bersih perOutlet</MARQUEE>

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
   <script type="text/javascript" language="javascript" src="../lib/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.yadcf.js"></script>
   
   
   	</body>
</html>