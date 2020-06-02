<!DOCTYPE html>
<html lang="en">

<head>
	<?php 
	include '../../configurasi/koneksi.php';
$ot='mojokerto';
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
           <?php 
             include 'nav.php';
           ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tables SPK</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                           Belum Di SPK
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        
                     

	<table id="belumkembali" class="display">
		<thead>
		<tr>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Nama Customer</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query =$mysqli->query("SELECT id, tgl_input,no_nota,nama_customer FROM reception where nama_outlet='$ot' and ambil=false and packing=false and kembali=false and spk=false and cuci=false and setrika=false ORDER BY tgl_input DESC") ;
				while($data =$query->fetch_array()){
					
					?>
				
				<tr id="<?php echo $data['id']; ?>">
				
				<td>
				<?php echo $data['tgl_input']; ?></td>
				<td><?php echo $data['no_nota']; ?></td>
				<td><?php echo $data['nama_customer']; ?></td>
				<td align="center">
			
				<a class="btn btn-sm btn-danger" id="ttt" name="ttt" href="detail_spk.php?id=<?php echo $data['id']; ?>">pilih</a>
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
            
                <div class="col-lg-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                           Belum Di SPK Karena Belum Lunas
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                              
                              
                            <table id="belumspk" class="display">
		<thead>
		<tr>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
<th>Rcp</th>
			
		</tr>
		</thead>
		<tbody>
			<?php
			$query =$mysqli->query( "SELECT id, tgl_input,no_nota,nama_customer,lunas,nama_reception FROM reception where nama_outlet='$ot' and ambil=false and packing=false and kembali=false and lunas=false and spk=false and cuci=false ORDER BY tgl_input DESC" );
				while($data =$query->fetch_array()){
					
					?>
				
				<tr">
			
				<td>
				<?php echo $data['tgl_input']; ?></td>
				<td><?php echo $data['no_nota']; ?></td>
				<td><?php echo $data['nama_customer']; ?></td>
<td><?php echo $data['nama_reception']; ?></td>
				</tr>
				<?php } 
				?>
		</tbody>
	</table>

                              
                              
                              
                              
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

  <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading" align="center">
<strong>                          EDIT SPK</strong>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                              
                              
                          <table id="tbl_edit_spk" class="display">
	<thead>
		<tr>
		<th>Tgl Masuk</th>
			<th>No Nota</th>
			<th>Nama</th>
			<th>Tgl SPK</th>
			<th>RCP</th>
			<th>Pilih</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query =$mysqli->query( "SELECT * FROM reception WHERE spk='1' and packing=false and kembali=false and ambil=false and nama_outlet='mojokerto'");
		
				while($r =$query->fetch_array()){
				?><tr >
				<td><?php echo $r['tgl_input']; ?></td>	
				<td><?php echo $r['no_nota']; ?></td>
				<td><?php echo $r['nama_customer']; ?></td>
				<td><?php echo $r['tgl_spk']; ?></td>
				<td><?php echo $r['rcp_spk']; ?></td>
				<td style="text-align:center;width:200px">
				<a class="btn btn-sm btn-danger" href="edit_spk.php?no_nota=<?php echo $r['no_nota']; ?>">pilih</a>
				</td>
				</tr>
					<?php } 
					?>
		</tbody>
		</table>

                              
                              
                              
                              
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

<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-green">
                        <div class="panel-heading" align="center">
<strong>                          Daftar SPK</strong>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                              
                              
                          <table id="tbl_spk" class="display">
	<thead>
		<tr>
		<th>Tgl Masuk</th>
			<th>No Nota</th>
			<th>Nama</th>
			<th>Tgl SPK</th>
			<th>RCP</th>
			<th>Pilih</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query =$mysqli->query( "SELECT * FROM reception WHERE spk='1' and nama_outlet='mojokerto'");
		
				while($r =$query->fetch_array()){
				?><tr >
				<td><?php echo $r['tgl_input']; ?></td>	
				<td><?php echo $r['no_nota']; ?></td>
				<td><?php echo $r['nama_customer']; ?></td>
				<td><?php echo $r['tgl_spk']; ?></td>
				<td><?php echo $r['rcp_spk']; ?></td>
				<td style="text-align:center;width:200px">
				<a class="btn btn-sm btn-danger" href="rincian_spk.php?no_nota=<?php echo $r['no_nota']; ?>">pilih</a>
				</td>
				</tr>
					<?php } 
					?>
		</tbody>
		</table>

                              
                              
                              
                              
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
			$('#belumkembali').dataTable();
			$('#belumspk').dataTable();
$('#tbl_spk').dataTable();	
$('#tbl_edit_spk').dataTable();
		});
		</script>
		

		


</html>
