<head>
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id'];
?>	
</head>
<body>
<div class="container-fluid" style="width:1200px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  color:#000000;">
<fieldset>
<legend align="center"><strong>TUTUP KASIR</strong></legend> 
 <div id="konfirm-box"> Apakah Anda yakin akan menghapus ini?</div>
	<table id="rincianpacking" class="display">
		<thead>
		<tr>
			
			<th>Tanggal</th>
			<th>Outlet</th>
			<th>Reception</th>
			<th>Setoran Bersih</th>
			<th>EDC Bri</th>
                        <th>EDC Bni</th>
			<th>EDC Mandiri</th>
			<th>EDC BCA</th>
			<th>Jumlah Pengeluaran</th>
			<th>Untuk</th>
			<th>Ijin</th>
			<th>aksi</th>
	   </tr>
		</thead>
		<tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
	
		<tbody>
		
		
		
		
		
		
		
		
		

			<?php
			$query = "SELECT * FROM tutup_kasir ORDER BY tanggal DESC" ;
			$tampil = mysqli_query($con, $query);
			while($data = mysqli_fetch_array($tampil)){
			echo "<tr id='$data[id]' >	
			<td>$data[tanggal]</td>
						<td>$data[outlet]</td>
						<td>$data[reception]</td>
						<td>$data[setoran_bersih]</td>
						<td>$data[edc_bri]</td>
                                                <td>$data[edc_bni]</td>
						<td>$data[edc_mandiri]</td>
						<td>$data[edc_bca]</td>
						<td>$data[pengeluaran]</td>
						<td>$data[untuk]</td>
						<td>$data[ijin]</td>
						<td><a class='hapusorder' id='$data[id]' style='cursor: pointer;'>void order</a></td>
						</tr>";
			
			}
			?>
		</tbody>
	</table>
</fieldset>
</div>
</body>
<script>
	 $(function () {
//Box Konfirmasi Hapus
            $('#konfirm-box').dialog({
                modal: true,
                autoOpen: false,
                show: "Bounce",
                hide: "explode",
                title: "Konfirmasi",
                buttons: {
  
                    "Ya": function () {
  jQuery.ajax({
  type: "POST",
  url: "dell_tutup_kasir.php",
  data: 'id=' +id,
  success: function(){
  $('#'+id).animate({ backgroundColor: "#fbc7c7" }, "fast")
  .animate({ opacity: "hide" }, "slow");
  }
  });
                    $(this).dialog("close");
                    },
 
                    "Batal": function () {
  //jika memilih tombol batal
                    $(this).dialog("close");
   
                    }
                }
            });
 
//Tombol hapus diklik
            $('.hapusorder').click(function () {
                $('#konfirm-box').dialog("open");
 //ambil nomor id
                id = $(this).attr('id');
            });
        });
</script> 
<script type="text/javascript">
		$(document).ready(function(){
				   
			$('#rincianpacking').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9],
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
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column(3 ).footer() ).html(
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
	   
	    {column_number : 2},	    {column_number : 1}

	    
	    ]);
			
		 
			
						
		});
	</script>