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
?>	
</head>
<body>
<div class="container-fluid" style="width:1200px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  color:#000000;">
<fieldset>
<legend align="center"><strong>TUTUP KASIR</strong></legend> 
	<table id="rincianpacking" class="display">
		<thead>
		<tr>
			
			<th>Tanggal</th>
			<th>Outlet</th>
			<th>Reception</th>
			<th>Setoran Bersih</th>
			<th>EDC Bri</th>
			<th>EDC Mandiri</th>
			<th>EDC BCA</th>
			<th>Jumlah Pengeluaran</th>
			<th>Untuk</th>
			<th>Ijin</th>
			<th>Bank</th>
			<th>Tanggal Setor</th>
			<th>Keterangan</th>
			<th>cash</th>
<th>selisih</th>	   
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
			$query = "SELECT tanggal,outlet,reception,setoran_bersih,edc_bri,edc_mandiri,edc_bca,pengeluaran,untuk,ijin,bank,tgl_setor,ket,DATE_FORMAT(tanggal,'%Y-%m-%d') as tgl1 FROM tutup_kasir WHERE (DATE_FORMAT(tanggal, '%Y-%m-%d') between '$newDate' and '$newDate2') ORDER BY tanggal DESC" ;
			$tampil = mysqli_query($con, $query);
			while($data = mysqli_fetch_array($tampil)){
			$tgl=$data['tgl1'];
			?>
			<tr>	
			<td><?php echo $data['tanggal'];?></td>
						<td><?php echo  $data['outlet'];?></td>
						<td><?php echo  $data['reception'];?></td>
						<td><?php echo  $data['setoran_bersih'];?></td>
						<td><?php echo  $data['edc_bri'];?></td>
						<td><?php echo  $data['edc_mandiri'];?></td>
						<td><?php echo  $data['edc_bca'];?></td>
						<td><?php echo  $data['pengeluaran'];?></td>
						<td><?php echo  $data['untuk'];?></td>
						<td><?php echo  $data['ijin'];?></td>
						<td><?php echo  $data['bank'];?></td>
						<td><?php		       if($data['tgl_setor']<>"0000-00-00")
		       {
			   echo ''.$data['tgl_setor'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
						
						?></td>
						<td><?php echo  $data['ket'];?></td>
						<td><?php

						$sql4=mysqli_query($con,"SELECT nama_outlet,cara_bayar,DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') as tgl_transaksi,rcp,sum(total) as jumlah FROM faktur_penjualan where DATE_FORMAT(tgl_transaksi,'%Y-%m-%d')='$tgl' and rcp='$data[reception]' and cara_bayar='cash'   group by rcp,DATE_FORMAT(tgl_transaksi, '%Y-%m-d'),cara_bayar,nama_outlet ORDER BY tgl_transaksi ASC
");
$s2=mysqli_fetch_array($sql4);
$nama=$s2['jumlah'];
echo $nama ;?>
					</td>
<td>
					<?php
					$A=$data['setoran_bersih'];
					$B=$nama;
					$d=$data['pengeluaran'];

					$C=($A-$B)+$d;
					 echo $C ;
					
					?>
						
					</td>
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
				   
			$('#rincianpacking').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../swf/copy_csv_xls_pdf.swf",
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