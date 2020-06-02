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
session_start();
$user_id= $_SESSION['user_id'];
$workshop = $_SESSION['workshop'];

date_default_timezone_set('Asia/Makassar');

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
	
include 'manifest_driver.php';		
	
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
	            </a><button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
                    <span class = "icon-bar"></span>
                  <span class = "icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse navHeaderCollapse">
                    <ul class="nav navbar-nav navbar-right" style="font-size: 15pt;color: #ff0000;">
<li><a href="index.php">Home</a></li>
<li><a href="antrian_cuci_kiloan.php">Antri Kiloan</a></li>
<li><a href="antrian_cuci_potongan.php">Antri Potongan</a></li>
<!--             		<li><a href="cari_nota_cuci.php">Cuci</a></li>   -->
                    		<li><a href="cari_nota_pengering.php">Kering</a></li>
             			<li><a href="cari_nota_setrika.php">Strika Potongan</a></li>
<li><a href="../corporate/index.php" target="_new">Hotel</a></li>
<li><a href="setrika_hotel.php">Setrika Hotel</a></li>
<li><a href="packing_hotel.php">Packing Hotel</a></li>
<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Form<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
<li><a href="cari_rincian.php">Cek Data</a></li>
                  	<li><a href="f_rijeck.php">Form Rijeck</a></li> 
<li><a href="lap_operator.php">Laporan</a></li>

                  </ul>
                </li>




<li> <a data-id='0' data-toggle="modal" href="#" data-target="#tambah-data"> Ubah Password</a></li>
				<li><a href="act_log_pulang.php">Log Out</a></li> 

						
                    </ul>
                </div>
            </div>
</div>
<div  style="width:90%; margin:0 auto; position:relative;">
<strong> <?php echo strtoupper("Selamat Datang : ".$user_id); ?></font></strong>
<marquee behavior=alternate  style="font-size: 25px;color: #ff0000" onmouseover="this.stop()" onmouseout="this.start()">
<a href="index.php">Lihat Express</a></marquee></div>
<marquee style="font-size: 25px;color: #0215fd" align="center" behavior="Scroll" >Jika ada rijeck input di form->form rijeck</MARQUEE>
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

</body>
   <script src = "../lib/js/jquery-2.1.3.min.js"></script>
   <script src = "../lib/js/bootstrap.min.js"></script>
   <script type="text/javascript" language="javascript" src="../lib/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.columnFilter.js"></script>
<script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.yadcf.js"></script>
   
<footer>
            
   </footer>
   
   	</html>