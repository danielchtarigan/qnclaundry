<head>
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id'];
$tgl=$_POST['tgl'];
	   $date = new DateTime($tgl);
	   $newDate = $date->format('Y-m-d');
	   
$tgl2=$_POST['tgl2'];
	   $date2= new DateTime($tgl2);
	   $newDate2 = $date2->format('Y-m-d');

function rupiah($angka)
    {
        $jadi = "Rp.".number_format($angka,0,',','.').',00';
        return $jadi;
    }
?>	
</head>
<body>
<div class="container-fluid" style="width:750px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
<fieldset>
<legend align="center"><strong>Cuci Ritel</strong></legend> 
dari tanggal <?php echo $newDate ;?> sampai <?php echo $newDate2; ?>
	<table id="cuci" class="display">
		<thead>
		<tr>
			<th>Tgl Cuci</th>
			<th>Operator</th>
			<th>jumlah poin</th>
			<th>jenis</th>
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
				$user_query = mysqli_query($con,"SELECT DATE_FORMAT(cuci.tgl_cuci, '%Y/%m/%d') as tgl_cuci,cuci.op_cuci as op_cuci ,sum(cuci.jumlah) as jumlahcuci,count(cuci.jumlah) as jumlah, reception.jenis as jenis FROM cuci INNER JOIN reception WHERE cuci.no_nota=reception.no_nota and reception.op_cuci <>'' and (DATE_FORMAT(cuci.tgl_cuci, '%Y-%m-%d') between '$newDate' and '$newDate2') GROUP BY tgl_cuci,jenis,op_cuci ORDER BY tgl_cuci DESC" )or die(mysqli_error());
				while($r = mysqli_fetch_array($user_query)){
						if ($r['jenis']=='k'){
					$tot=$r['jumlah']/2;
				} else{
					$tot=$r['jumlahcuci']/2;
				}

													?>
						 <tr>
							<td><?php echo $r['tgl_cuci'] ?></td>
							<td><?php echo $r['op_cuci'] ?></td>
							<td><?php echo $tot ?></td>
						<td><?php echo $r['jenis'] ?></td>
						
						</tr>

				<?php } ?>
</tbody>	

		
	</table>

	</fieldset>

	
</div>
<div class="container-fluid" style="width:1600px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  color:#000000;">
<fieldset>
<legend align="center"><strong>Detail Cuci ritel</strong></legend> 
	<table id="rincian" class="display">
		<thead>
		<tr>
			
			<th>Tgl Cuci</th>
			<th>No Nota</th>
			<th>Operator</th>
			<th>Jumlah rcp</th>
			<th>Jumlah Op</th>
			<th>Jenis</th>
			<th>Harga</th>
			<th>Express</th>
			<th>Priority</th>
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
			$query = "SELECT reception.tgl_cuci as tgl_cuci,reception.no_nota as no_nota,reception.op_cuci as op_cuci,reception.jumlah as jumlah,cuci.jumlah as jumlahcuci,reception.express as express,reception.total_bayar as total_bayar, reception.jenis as jenis, priority FROM cuci INNER JOIN reception WHERE  cuci.no_nota=reception.no_nota and reception.op_cuci <>'' and (DATE_FORMAT(reception.tgl_cuci, '%Y-%m-%d') between '$newDate' and '$newDate2') ORDER BY tgl_cuci DESC" ;
			$tampil = mysqli_query($con, $query);
			while($data = mysqli_fetch_array($tampil)){
				?>
				
					<tr><td><?php echo $data['tgl_cuci'] ?></td>
						<td><?php echo $data['no_nota'] ?></td>
						<td><?php echo $data['op_cuci'] ?></td>
						<td><?php echo $data['jumlah'] ?></td>
						<td><?php echo $data['jumlahcuci'] ?></td>
						<td><?php if ($data['jenis']=='k') echo 'Kiloan'; else if ($data['jenis']=='p') echo 'Potongan'; ?></td>
						<td><?php echo $data['total_bayar'] ?></td>
						<td><?php if ($data['express']==1) echo 'Express'; else if ($data['express']==2) echo 'Double Express'; else if ($data['express']==3) echo 'Super Express'; ?></td>
						<td><?php if($data['priority']==1) echo "Priority"; else echo "" ?></td>
						</tr>
						<?php  }
 ?>
		</tbody>
	</table>
</fieldset>
</div>
</body>
<script type="text/javascript">
		$(document).ready(function(){
			$('#cuci').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
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
	   
	    {column_number : 1},	    {column_number : 3}

	    
	    ]); 
	    $('#packingpacking').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
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
	   
	    {column_number : 1},	    {column_number : 3}

	    
	    ]);    
	   
			$('#rincian').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7,8],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7,8],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5,6,7,8],
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
	   
	    {column_number : 2},	    {column_number : 5}, {column_number: 7}, {column_number: 8}

	    
	    ]);
		

        $('#error').dataTable({
            "lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
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
       
        {column_number : 1}, {column_number : 5}, {column_number : 6}

        
        ]);	

        $("#show").click(function(){
            $("#p").slideDown();
        }); 
			
						
		});
	</script>
    <br>

    <div class="" style="text-align: center" id="show"><button type="button"  class="btn btn-danger" value=""><p style="font-weight: bold">Tampilkan Nota yang tidak terinput Cuci di sistem dan sudah kembali ke Outlet</p></button>
        <div id="p" style="display: none">
        <div class="container-fluid" style="width:1300px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
            <fieldset>
            <legend align="center"><strong>Belum Terinput Cuci</strong></legend> 
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover table-striped" id="error">
                        <thead>
                            <tr>
                                <th>Tanggal SPK</th>
                                <th>Workshop</th>
                                <th>No Nota</th>
                                <th>Jumlah Item</th>
                                <th>Jenis</th>
                                <th>Harga</th>
                                <th>Express</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php 
                                    $query = mysqli_query($con, "select *from reception where (DATE_FORMAT(tgl_spk, '%Y-%m-%d') between '$newDate' and '$newDate2') and kembali=true and op_cuci='' and nama_outlet<>'mojokerto' ");
                                    while($data = mysqli_fetch_array($query)){?>
                                        <td><?php echo $data['tgl_spk']; ?></td>
                                        <td><?php if($data['tgl_workshop']=="0000-00-00 00:00:00") echo "Belum"; else echo $data['tgl_workshop'] ?></td>
                                        <td>
                                            <a href="header.php?aksi=input_cuci&nota=<?php echo $data['no_nota'] ?>&jl=<?php echo $data['jumlah'] ?>"><?php echo $data['no_nota'] ?></a>               
                                        </td>
                                        <td><?php echo $data['jumlah'] ?></td>
                                        <td><?php if($data['jenis']=='k') echo "Kiloan"; else echo "Potongan"; ?></td>
                                        <td><?php echo rupiah ($data['total_bayar']) ?></td>
                                        <td><?php if($data['express']==1) echo "Express"; else if($data["express"]==2) echo "Double Express"; else if($data['express']==3) echo "Super Express" ?></td>                                
                            </tr>   
                            <?php
                                    }
                                ?>                 
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
        </div>
    </div>