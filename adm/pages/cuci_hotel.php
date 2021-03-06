<!DOCTYPE html>
<html lang="en">

<head>
	<?php 
	include '../configurasi/koneksi.php';
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quick &' Clean Admin</title>

    <link href="../bower_components/vendor/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">


        <link rel="stylesheet" type="text/css" href="../../lib/css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="../../lib/css/jquery.dataTables_themeroller.css" />
		<link rel="stylesheet" type="text/css" href="../../lib/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="../../lib/css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../../lib/css/jquery.dataTables.yadcf.css">
<link rel="stylesheet" type="text/css" href="../../lib/css/dataTables.tableTools.css">






    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                                <span class="input-group-btn">
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                         <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i>Laporan Operasional<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li>
                                    <a href="cuci.php">Cuci Ritel</a>
                                </li>
                                <li>
                                    <a href="cuci_hotel.php">Cuci Hotel</a>
                                </li>
                                <li>
                                    <a href="pengering.php">pengering</a>
                                </li>
                                <li>
                                    <a href="setrika.php">Setrika Ritel</a>
                                </li>
                                <li>
                                    <a href="setrika_hotel.php">Setrika Hotel</a>
                                </li>
                                <li>
                                    <a href="packing.php">Packing</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        
                        
                        
                       
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.html">Blank Page</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
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
                    <h1 class="page-header">Tables Cucian Hotel</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Total Cuci Hotel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                              
                        <table id="packing" class="display">
		<thead>
		<tr>
			<th>Tgl cuci</th>
			<th>Operator</th>
			<th>jumlah poin</th>
			
		</tr>
		</thead>
		<tfoot>
            <tr>
                <th colspan="2" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
						<tbody>
				<?php
				$user_query = $mysqli->query("SELECT DATE_FORMAT(tgl_cuci, '%Y/%m/%d') as tgl_cuci,op_cuci,sum(jumlah) as jumlahcuci FROM cuci_hotel GROUP BY tgl_cuci,op_cuci ORDER BY tgl_cuci DESC" )or die(mysqli_error());
				while($r = $user_query->fetch_array()){
						

													?>
						 <tr>
							<td><?php echo $r['tgl_cuci'] ?></td>
							<td><?php echo $r['op_cuci'] ?></td>
						
						<td><?php echo $r['jumlahcuci'] ?></td>
						
						</tr>

				<?php } ?>
</tbody>	

		
	</table>

                              
                              
                              
                              
                            </div>
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
                            Rincian Cuci Hotel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                              
                              
                          	<table id="rinciancucihotel" class="display">
		<thead>
		<tr>
			
			<th>Tgl Cuci</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Operator</th>
			<th>Jumlah</th>
			<th>ket</th>
			<th>Hapus</th>
	   </tr>
		</thead>
		<tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
	
		<tbody>
			<?php
			$query =$mysqli->query( "SELECT * FROM cuci_hotel ORDER BY tgl_cuci DESC") ;
			$no = 1;
			while($data = $query->fetch_array()){
				    ?>
						<tr id="<?php echo $data['id'] ; ?>">
						
						<td><?php echo $data['tgl_cuci']; ?></td>
						
						<td><?php echo $data['no_nota']; ?></td>
						<td><?php echo $data['nama_hotel']; ?></td>
						<td><?php echo $data['op_cuci']; ?></td>
						<td><?php echo $data['jumlah']; ?></td>
						<td><?php echo $data['ket']; ?></td>
						<td>
				<a href="#" class="delete" style="color:#FF0000;"><img alt="" align="absmiddle" border="0"  />hapus</a>
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

<script src = "../../lib/js/jquery-2.1.3.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
<script src="../dist/js/sb-admin-2.js"></script>
<script type="text/javascript" language="javascript" src="../../lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="../../lib/js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="../../lib/js/jquery.dataTables.yadcf.js"></script>
<script type="text/javascript" language="javascript" src="../../lib/js/dataTables.tableTools.js"></script>
<script src="../../lib/js/jquery.form.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$('#packing').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../../swf/copy_csv_xls_pdf.swf",
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
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets": 1 },
                ],

			"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },	
        		"aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 5}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy/mm/dd"
	    },
	   
	    {column_number : 1}

	    
	    ]); 
	    
	    
			$('#rinciancucihotel').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../../swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets": 1 },
                ],
                			"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column(4 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },	

	
				 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 2},	    {column_number : 3}

	    
	    ]);
			
		 
			
						
		});
	</script>
	<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#rinciancucihotel td a.delete').click(function()
		{
			if (confirm("Are you sure you want to delete this row?"))
			{
				var id = $(this).parent().parent().attr('id');
				var data = 'id=' + id ;
				var parent = $(this).parent().parent();

				$.ajax(
				{
					   type: "POST",
					   url: "del_cuci_hotel.php",
					   data: data,
					   cache: false,
					
					   success: function()
					   {
							parent.fadeOut('slow', function() {$(this).remove();});
					   }
				 });				
			}
		});
		
		// style the table with alternate colors
		// sets specified color for every odd row
		$('table#rinciancucihotel tr:odd').css('background',' #FFFFFF');
	});
	
</script>
</html>
