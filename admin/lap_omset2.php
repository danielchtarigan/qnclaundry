<html>
<head>
	
<?php

date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d");
function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}

include "../config.php"; 
$tgl     = $_POST['tgl'];
	$date    = new DateTime($tgl);
	$newDate = $date->format('Y-m-d');

	$tgl2    = $_POST['tgl2'];
	$date2   = new DateTime($tgl2);
	$newDate2= $date2->format('Y-m-d');
?>
</head>
<body>


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
                            "mColumns": [0,1,2,3],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1,2,3],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1,2,3],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"4px",
                    },  { "width": "5px", "targets": [0] },{ "width": "5px", "targets": 1 },
                ],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
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
        }
	
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },

	   
	    {column_number : 1},{column_number : 3}
	    
	    
	    ]);
$('#rincian').dataTable({
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12,13],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12,13],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"10%",
                    },  { "width": "5px", "targets": [2] },{ "width": "20%", "targets": 1 },
                ],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
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
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                ''+ pageTotal +' ( '+ total +' total)'
            );
        }

				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },

	   
	    {column_number : 1},  {column_number : 9}, {column_number : 10}, {column_number : 11}, {column_number : 12},
	    
	    
	    ]);
			
			
			
		});
	</script>
<div class="container" style="width:800px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-top:50px; margin-bottom:50px; color:#000000;">	
<fieldset>
<legend align="center" ><marquee behavior=alternate  width="800"><strong>Lap Omset/Order</strong></marquee></legend> 
<table id="cuci" class="display">
		<thead>
		<tr>
			<th>Tgl</th>
			<th >outlet</th>
			<th>Jumlah</th>			
			<th>Reception</th>
			
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
			$query = "SELECT nama_outlet,DATE_FORMAT(tgl_input, '%Y-%m-%d') as tgl_input,sum(total_bayar) as jumlah,nama_reception FROM reception   WHERE (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') group by nama_reception,nama_outlet,DATE_FORMAT(tgl_input, '%Y%m%d') ORDER BY tgl_input ASC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
			
				?>
				
					<tr>
					<td><?php echo $data['tgl_input'];?></td>
					<td><?php echo $data['nama_outlet'];?></td>
					<td><?php echo $data['jumlah'];?></td>					
					<td><?php echo $data['nama_reception'];?></td>
					</tr>
			
				<?php } 
 ?>
		</tbody>
		
		
		
		
		
		
		
			
	</table>
	</fieldset>
</div>
<div class="container" style="width:100%; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-top:50px; margin-bottom:50px; color:#000000;">
<fieldset>
<legend align="center" ><marquee behavior=alternate  width="800"><strong>Rincian Omset/Order</strong></marquee></legend> 
<table id="rincian" class="display">
	<thead>
		<tr>
			
			<th>Tgl Masuk</th>
			<th>Outlet</th>
			<th>No Nota</th>
			<th>ID CST</th>
			<th>Nama</th>					
			<th>Total bayar</th>
			<th>Faktur</th>
			<th>Voucher</th>
			<th>Diskon</th>
			<th>RCP</th>
			<th>Lunas</th>
			<th>Cara Bayar</th>
			<th>Jenis</th>
			<th>Berat</th>
			<th>Cabang</th>
			
		</tr>
		</thead>
		<tfoot>
            <tr>
                <th colspan="5" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
		<tbody>
			<?php
			$query = "SELECT jenis,nama_outlet,tgl_input,no_nota,id_customer,nama_customer,no_faktur,total_bayar,voucher,diskon,nama_reception,berat,cabang,cara_bayar,lunas FROM reception  WHERE (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') ";
			$tampil = mysqli_query($con, $query);
				while($r = mysqli_fetch_array($tampil)){
				?><tr >
				
				<td><?php echo $r['tgl_input']; ?></td>	
				<td><?php echo $r['nama_outlet']; ?></td>	
				<td><?php echo $r['no_nota']; ?></td>
				<td><?php echo $r['id_customer']; ?></td>
				<td><?php echo $r['nama_customer']; ?></td>
				<td><?php echo $r['total_bayar']; ?></td>
				<td><?php echo $r['no_faktur']; ?></td>
				<td><?php echo $r['voucher']; ?></td>
				<td><?php echo $r['diskon']; ?></td>				
				<td><?php echo $r['nama_reception']; ?></td>
				<td><?php echo $r['lunas']; ?></td>
				<td><?php echo $r['cara_bayar']; ?></td>
				<td><?php echo $r['jenis']; ?></td>
				<td><?php echo $r['berat'] ?></td>
				<td><?php echo $r['cabang']; ?></td>
				
				</tr>
					<?php } 
					?>
		</tbody>
		</table>
	</fieldset>
</div>


</body>
</html>