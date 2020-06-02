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
//	if (isset($_SESSION['level']))
//	{
//		if ($_SESSION['level'] == "reception")
//		{   
//		}
//			else if ($_SESSION['level'] == "operator")
//			{
//			header('location:../operator/index.php');
//			}
//				else if ($_SESSION['level'] == "packer")
//				{
//				header('location:../packer/index.php');
//				}
//				}	
//					if (!isset($_SESSION['user_id']) and !isset($_SESSION['level']) and !isset($_SESSION['nama_outlet']))
//					{
//					header('location:../index.php');
//	}
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
                <a class="navbar-brand" href="index.php">
                  <img src="../logo.png"/></a>
<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
                   <span class = "icon-bar"></span>
                  <span class = "icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse navHeaderCollapse">
                    <ul class="nav navbar-nav navbar-right" style="font-size: 15pt;color: #ff0000;">
               
<li class=""><a class="glyphicon glyphicon-home" href="index.php"></a></li>
				<li><a href="in_order.php">Input</a></li>
             	<li><a href="cari_nota_cuci.php">Cuci Hotel</a></li>
                <li><a href="cari_nota_setrika.php">Setrika Hotel</a></li> 
                <li><a href="cari_nota_packer.php">Packing Hotel</a></li> 
				<li><a href="../logout.php">Log Out</a></li> 
						
                    </ul>
                </div>
            </div>
            </div>
            <div  style="width:300px; margin:0 auto; position:relative;">

        <marquee behavior=scroll style="font-size: 25px;color: #ff0000" > <?php echo "Hai: ".$user_id?>||<?php echo $ot ?></MARQUEE></div> 
        <marquee behavior=alternate  style="font-size: 25px;color: #0600ff">
        Jika ada yang error segera hubungi agil
        </marquee>
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

   
   	
   	</body>
</html>