<html>
<head>
	
<?php
include "header.php";
include "../config.php"; 
$tgl=$_POST['tgl'];
	   $date = new DateTime($tgl);
	   $newDate = $date->format('Y-m-d');
	   
$tgl2=$_POST['tgl2'];
	   $date2= new DateTime($tgl2);
	   $newDate2 = $date2->format('Y-m-d');
?>
</head>
<body>
<div class="container" style="width:1250px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-top:50px; margin-bottom:50px; color:#000000;">
	<script type="text/javascript">
		$(document).ready(function(){
			$('#express').dataTable({
				dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "50%", "targets": [2] }
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
				"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
				
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	    
	    {column_number : 8},{column_number : 2},{column_number : 10},{column_number : 9}
	    
	    
	    ]);

			
			
			
		});
	</script>
	
<fieldset>
<legend align="center" ><marquee behavior=alternate  width="400"><strong>OTP OPERASIONAL</strong></marquee>

</legend> 
dari tanggal <?php echo $newDate ;?> sampai <?php echo $newDate2; ?>
<table id="express" class="display">
		<thead>
		<tr>
			
			<th>Tanggal Masuk</th>
<th>Tanggal SPK</th>
<th>Tanggal Kembali</th>

<th>Outlet</th>

			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Cuci</th>
			<th>Setrika</th>
			<th>Packing</th>
			<th>OTP Operasional</th>
<th>OTP spk</th>
<th>OTP All</th>
			<th>Jenis</th>
			
		</tr>
		</thead>
		<tbody>
			<?php

			$outlet=$_SESSION['nama_outlet'];

			$query = "SELECT tgl_kembali,tgl_spk,jenis,nama_outlet,tgl_input,tgl_packing,no_nota,nama_customer,tgl_cuci,tgl_setrika,datediff(DATE_FORMAT(tgl_packing, '%Y-%m-%d'),DATE_FORMAT(tgl_spk, '%Y-%m-%d')) as terlambat,datediff(DATE_FORMAT(tgl_spk, '%Y-%m-%d'),DATE_FORMAT(tgl_input, '%Y-%m-%d')) as terlambatspk,datediff(DATE_FORMAT(tgl_kembali, '%Y-%m-%d'),DATE_FORMAT(tgl_input, '%Y-%m-%d')) as otp FROM reception WHERE (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);
			
			
			while($data = mysqli_fetch_array($tampil)){
							
				
				?>
				<tr>           <td><?php echo $data['tgl_input'];?></td>
<td><?php echo $data['tgl_spk'];?></td>
<td><?php echo $data['tgl_kembali'];?></td>
						<td><?php echo $data['nama_outlet'] ;?> </td>
						
						<td><?php echo $data['no_nota'];?></td>
						<td><?php echo $data['nama_customer'];?></td>
						<td><?php		       if($data['tgl_cuci']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_cuci'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?>
		       
		      
                                                </td>
                                                <td><?php		       if($data['tgl_setrika']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_setrika'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?></td>
			  			<td><?php		       if($data['tgl_packing']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_packing'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?></td>
			  <td><?php echo $data['terlambat'] ?> Hari</td>
<td><?php echo $data['terlambatspk'] ?> Hari</td>
<td><?php echo $data['otp'] ?> Hari</td>
			  <td><?php echo $data['jenis'] ?></td>
			  
						
						</tr>
			
						<?php } 
 ?> 
		</tbody>
	</table>
	</fieldset>
</div>
</body>
</html>