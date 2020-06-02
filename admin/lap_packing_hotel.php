<head>
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id'];
?>	
</head>
<body>
<div class="container-fluid" style="width:750px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
<fieldset>
<legend align="center"><strong>packing_hotel Hotel</strong></legend> 

<table id="packing_hotel" class="display">
		<thead>
		<tr>
			<th>Tgl packing</th>
			<th>Packer</th>
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
$user_query = mysqli_query($con,"SELECT DATE_FORMAT(packing_hotel.tgl_packing, '%Y/%m/%d') as tgl_packing,packing_hotel.packer as packer ,sum(packing_hotel.jumlah) as jumlahpacking,count(packing_hotel.jumlah) as jumlah FROM packing_hotel GROUP BY packer ORDER BY tgl_packing DESC"  )or die(mysqli_error());
while($r = mysqli_fetch_array($user_query)){
    
        ?>
         <tr>
            <td><?php echo $r['tgl_packing'] ?></td>
            <td><?php echo $r['packer'] ?></td>
            <td><?php echo $r['jumlahpacking'] ?></td>
        
        </tr>

				<?php } ?>
</tbody>	

		
	</table>

  </fieldset>

	
</div>
<div class="container" style="width:800px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);   margin-bottom:20px; color:#000000;">
  <script type="text/javascript">
		$(document).ready(function(){
			oTable = $('#belumkembali').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 50
				
			});
			oTable = $('#express').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 50
				
			});

			
			
			
		});
	</script>
  <fieldset>
    <legend align="center" ><strong>Detail Packing ritel</strong></legend>
    <table id="express" class="display">
      <thead>
        <tr>
          <th>Tgl Pakcing</th>
          <th>No Nota</th>
          <th>Packer</th>
          <th>Jumlah</th>
          
        </tr>
      </thead>
      <tbody>
        <?php
    $query = "SELECT packing_hotel.tgl_packing as tgl_packing,packing_hotel.no_nota as no_nota,packing_hotel.packer as packer,packing_hotel.jumlah as jumlah,packing_hotel.jumlah as jumlahpacking_hotel FROM packing_hotel ORDER BY tgl_packing DESC" ;
    $tampil = mysqli_query($con, $query);
    while($data = mysqli_fetch_array($tampil)){
		?>
    <tr>
        <td><?php echo $data['tgl_packing'] ?></td>
        <td><?php echo $data['no_nota']?></td>
        <td><?php echo $data['packer'] ?>-</td>
        <td><?php echo $data['jumlah'] ?></td>
    </tr>
        <?php } 
 ?>
      </tbody>
    </table>
  </fieldset>
</div>
</body>
<script type="text/javascript">
$(document).ready(function(){
	$('#packing_hotel').dataTable({
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

	$('#rincianpacking_hotel').dataTable({
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
	
 
	
				
});
</script>