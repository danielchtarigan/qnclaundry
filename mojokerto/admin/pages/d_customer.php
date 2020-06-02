<!DOCTYPE html>
<html lang="en">

<head>
	<?php 
	include '../../configurasi/koneksi.php';

function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QUICK &' CLEAN ADMIN</title>

    <link href="../../../lib/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../dist/css/metisMenu.css" rel="stylesheet">
	
	<link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="../../../lib/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="../../../lib/css/jquery.dataTables_themeroller.css" />
<link rel="stylesheet" type="text/css" href="../../../lib/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="../../../lib/css/dataTables.tableTools.css">

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
                    
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                   
                  
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                  
                
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tables Customer</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Customer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        
 <button class="btn btn-md  btn-success" data-id='0' data-toggle="modal" data-target="#tambah-customer">Tambah Data</button> Tambah customer jika data tidak di temukan. Jika di temukan klik pilih.
 <br /><br />                             
<table id="tbl_cst" class="display">
	<thead>
		<tr>
			<th>Nama</th>
			<th>Alamat</th>
			<th>No Telp</th>
			<th>Member</th>
			<th>Langganan</th>
			<th>Pilih</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = $mysqli->query("SELECT * FROM customer WHERE outlet='mojokerto'");
				while($r =$query->fetch_array()){
				if($r['member']=='1') {
    			$member = $r['jenis_member'];
   				} else {
		      $member = "";
		   }
		   if($r['lgn']=='1') {
    			$lgn = rupiah($r['sisa_kuota']);
   				} else {
		      $lgn = "";
		   }
				?><tr>	<td><?php echo $r['nama_customer']; ?></td>
				<td><?php echo $r['alamat']; ?></td>
				<td><?php echo $r['no_telp']; ?></td>
				<td><?php echo $member ?></td>
				<td><?php echo $lgn ?></td>
				<td style="text-align:center;width:200px">
				
				<a class="btn btn-sm btn-danger" href="tr_customer.php?id=<?php echo $r['id']; ?>">pilih</a>
				</td>
				</tr>
					<?php } 
					?>
		</tbody>
		</table>
                              
                              
                              
                              
                           
                            <!-- /.table-responsive -->
                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                              
                              
                            
                              
                              
                              
                              
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            
                <!-- /.col-lg-6 -->
            </div>
          </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<!-- Modal tambah data -->
	<div id="tambah-customer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Customer</h4>
					</div>

					<div class="modal-body">

						  <fieldset>
							 <div class="form-group">
						      <label for="Notelp">No Telp</label><span id="pesan"></span>
						      <input type="text" autocomplete="off" name="no_telp1" id="no_telp1" class="form-control" placeholder="Masukkan no telp">
						     
						    </div>
						     <span id="user-result"></span>
						    <div class="form-group">
						      <label for="nama_customer">Nama Customer</label>
						      <input type="text" autocomplete="off" name="nama_customer1" id="nama_customer1" class="form-control" placeholder="Masukkan nama customer">
						    </div>

						    <div class="form-group">
						      <label for="alamat">alamat</label>
						      <input type="text" autocomplete="off" name="alamat1" id="alamat1" class="form-control" placeholder="Masukkan Alamat">
						    </div>
					 <div class="form-group">
						      <label for="info">Tau QuicknClean dari?</label>
						      <select name="info" id="info" class="form-control">
						        <option value="">--</option>
						        <option value="brosur">brosur</option>
						        <option value="spanduk">spanduk</option>
     						    <option value="teman">Teman</option>
						      

						      </select>
						    </div>
						   
						</fieldset>

						

					</div>

					<div class="modal-footer">
						<button class="btn btn-success" id="addcustomer" class="btn">Tambah</button>
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
					</div>

			

			</div>
		</div>
	</div>
</body>

	<script src="../../../lib/js/jquery-2.1.3.min.js"></script>
    <script src="../../../lib/js/bootstrap.min.js"></script>
    <script src="../../dist/js/metisMenu.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>

<script type="text/javascript" language="javascript" src="../../../lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="../../../lib/js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="../../../lib/js/dataTables.tableTools.js"></script>

<script type="text/javascript">
		$(document).ready(function(){
			$('#tbl_cst').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../../../swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 5})
	   

$("#no_telp1").change(function(){
                        var no_telp=$("#no_telp1").val();
                        
                        $.ajax({
                            url:"../fungsi/cek_telepon.php",
                            data:"no_telp="+no_telp,
                            success:function(data){
                                if(data==0){
                                    $("#pesan").html('no telp Bisa digunakan');
                                    $("#no_telp1").css('border','3px #090 solid');
                                    $("#addcustomer").removeAttr('disabled','');
                                  
                                }else{
                                    $("#pesan").html('no telp sudah ada');
                                    $("#no_telp1").css('border','3px #c33 solid');
                                    $("#addcustomer").attr("disabled","");
                                    
                                
                                }
                            }
                        });
                    })

	
 $("#addcustomer").click(function()
     	{
  					   
                      
                        nama_customer1=$("#nama_customer1").val();
                        alamat1=$("#alamat1").val();
                        no_telp1=$("#no_telp1").val();
                       info=$("#info").val();
                        
                        
			                 if ( nama_customer1 == "" ){
							alert("Nama Masih Kosong");
							$("#nama_customer1").focus();
							return false;
							} else if ( alamat1 == "" ){
							alert("alamat Masih Kosong");
							$("#alamat1").focus();
							return false;
						}else if ( no_telp1 == "" ){
							alert("no telp Masih Kosong");
							$("#no_telp1").focus();
							return false;
						}else if ( info == "" ){
							alert("info Masih Kosong");
							$("#info").focus();
							return false;
						}
                        
                        $.ajax({
                            url:"../fungsi/tambah_customer.php",
                            data:"nama_customer1="+nama_customer1+"&alamat1="+alamat1+"&no_telp1="+no_telp1+"&info="+info,
                          
                            success:function(msg)
                            {
                            	
                            	$("#tambah-customer").modal('hide');
                            	location.reload();
                       			 
     
                            }
                        })
                      
                    })


	});
	</script>

		


</html>
