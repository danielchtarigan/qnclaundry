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
           <?php 
             include 'nav.php';
           ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tables Belum Selesai</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           Cucian
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        
                          
<table id="tbl_order" class="display">
		<thead>
		<tr>
			
			<th>Tgl Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Jenis</th>
			<th>Tgl Cuci</th>
			<th>Tgl Setrika</th>
			<th>Tgl Packing</th>
			
		</tr>
		</thead>
		<tbody>
			<?php
			$query =$mysqli->query( "SELECT tgl_input,no_nota,nama_customer,tgl_cuci,tgl_setrika,tgl_packing,jenis FROM reception where nama_outlet='mojokerto' and packing=false  ORDER BY tgl_input") ;
			
			while($data =$query->fetch_array()){
                        ?>
				<tr>
						
						<td><?php echo $data['tgl_input'] ; ?></td>
						<td><?php echo $data['no_nota']; ?></td>
						<td><?php echo $data['nama_customer']; ?></td>
						<td><?php echo $data['jenis']; ?></td>

						<td><?php		       if($data['tgl_cuci']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_cuci'].'';
		       }
		       else
			   {
			   echo '-';
		       };
			  ?>
		       
		      
                                                </td>
						
						<td><?php		       if($data['tgl_setrika']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_setrika'].'';
		       }
		       else
			   {
			   echo '-';
		       };
			  ?></td>
						
						<td><?php		       if($data['tgl_packing']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_packing'].'';
		       }
		       else
			   {
			   echo '-';
		       };
			  ?></td>
						
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
			$('#tbl_order').dataTable({
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
				 "iDisplayLength": 50})
	   


	


	});
	</script>
		


</html>
