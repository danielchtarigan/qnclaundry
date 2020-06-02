<!DOCTYPE html>
<html lang="en">

<head>
<?php

include '../../../config.php';
session_start();
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QUICK &' CLEAN ADMIN</title>

    <link href="../../../lib/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../dist/css/metisMenu.css" rel="stylesheet">
	<link href="../../dist/css/timeline.css" rel="stylesheet">
	<link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" type="text/css" href="../../../lib/themes/bootstrap/easyui.css">
<link rel="stylesheet" type="text/css" href="../../../lib/themes/icon.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                 
              
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i><?php echo $_SESSION['name'];?>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i>Reception<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li>
                                    <a href="d_customer.php">Input Data</a>
                                </li>
                                <li>
                                    <a href="workshop.php">Dari Workshop</a>
                                </li>
                               <li>
                                    <a href="ambil_customer.php">Pengambilan</a>
                                </li>
                               
                                <li>
                                    <a href="tutup_kasir.php">Tutup Kasir</a>
                                </li>
                                <li>
                                    <a href="setoran_bank.php">setoran bank</a>
                                </li>
                                <li>
                                    <a href="stok_opname.php">Stok Opname</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                          <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i>Operasional<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li>
                                    <a href="cuci.php">Cuci</a>
                                </li>
                                
                                <li>
                                    <a href="pengering.php">pengering</a>
                                </li>
                                <li>
                                    <a href="setrika.php">Setrika Ritel</a>
                                </li>
                                
                                <li>
                                    <a href="packing.php">Packing</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        
                        
                        
                        
                        
                        
                         <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Laporan Reception<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               
                                <li>
                                    <a href="setoran_bank.php">Setoran Bank</a>
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
      
<div align="center">
	<h2>FORM TUTUP KASIR</h2>
	<div class="easyui-panel" title="Tutup Kasir" align="center" style="width:500px;padding:10px;">
		<form id="ff" action="../fungsi/p_tutup_kasir.php" method="post" class="form-horizontal">
			<table>
		

		<div class="form-group">
  		<label class="control-label col-xs-3" for="nama_customer">Jumlah Pengeluaran</label>
  		 <div class="col-xs-8" >
  		<input type="number" autocomplete="off" class="form-control" min="0" step="1"  name="pengeluaran" id="pengeluaran"   onkeydown="return tabOnEnter(this,event)"required/>
		</div>
		</div>
		<div class="form-group">
  		<label class="control-label col-xs-3" for="nama_customer">Pengeluaran Untuk</label>
  		 <div class="col-xs-8" >
  		<input type="text" autocomplete="off" class="form-control" name="untuk" id="untuk"   onkeydown="return tabOnEnter(this,event)"required/>
		</div>
		</div>
		<div class="form-group">
  		<label class="control-label col-xs-3" for="nama_customer">Ijin Oleh</label>
  		 <div class="col-xs-8" >
  		<input type="text" autocomplete="off" class="form-control" name="ijin" id="ijin"   onkeydown="return tabOnEnter(this,event)"required/>
		</div>
		</div>
		
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">EDC MANDIRI</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="edc_mandiri" id="edc_mandiri"   onkeydown="return tabOnEnter(this,event)"required/>
  		</div>
		</div>
		
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">EDC BCA</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="edc_bca" id="edc_bca"   onkeydown="return tabOnEnter(this,event)"required/>
  		</div>
		</div>
		
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">EDC BRI</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="edc_bri" id="edc_bri"   onkeydown="return tabOnEnter(this,event)"required/>
  		</div>
		</div>
		
		
		
		
		
		
		
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">Setoran Bersih</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="setoran_bersih" id="setoran_bersih"   onkeydown="return tabOnEnter(this,event)"required="true"/>
  		</div>
		</div>
		<tr>
					<td></td>
Pastikan Anda mengisi sesuai pecahan uang yang diterima yang dimasukkan ke amplop!! Jika selisih menyetor di bank, akan dikenakan sanksi pemotongan gaji! Setelah melakukan submit, segala kekurangan kas akan ditagihkan langsung ke Resepsionis dan kelebihan kas akan disimpan dalam akun tersendiri
					<td><input type="submit" name="test" id="test" value="Submit"></input></td>
				</tr>
			</table>
		</form>
	</div>
	</div>





          
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="../../../lib/js/jquery-2.1.4.min.js"></script>
    <script src="../../../lib/js/bootstrap.min.js"></script>
    <script src="../../dist/js/metisMenu.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
      <script src="../../../lib/js/jquery.form.js"></script>
      <script type="text/javascript" src="../../../lib/js/jquery.easyui.min.js"></script>
 
</body>
<style scoped>
		.f1{
			width:200px;
		}
	</style>
	<script type="text/javascript">
		$(function(){
			$('#ff').form({
				success:function(data){
					$.messager.alert('Info', data, 'info');
				$('#ff').form('clear');
				}
			});
		});
	</script>
	<script type="text/javascript">

	$(document).ready(function()
	{
		$('#test').click(function()
		{
			var jumlah = $('#setoran_bersih').val();
				
    		
			if (confirm("Simpan Data?"+"Jumlah :"+jumlah))
			{
				
			}else{
				return false;
			}
		});
		
		
	});
	
</script>

</html>
