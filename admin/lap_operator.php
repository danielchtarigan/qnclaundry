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
  url: "del_lap_operator.php",
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
            $('.hapus').click(function () {
                $('#konfirm-box').dialog("open");
 //ambil nomor id
                id = $(this).attr('id');
            });
        });
</script>
</head>
<body>

<div class="container-fluid" style="width:100%; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000; margin-top: 50px" >


<div class="row">
                <div class="col-lg-6">
            <fieldset>
dari tanggal <?php echo $newDate ;?> sampai <?php echo $newDate2; ?>
<legend align="center" style="background-color: #ff0000"><strong>Cuci ritel</strong></legend> 
<table id="cuciritel" class="display">
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
					$tot=$r['jumlah'];
				} else{
					$tot=$r['jumlahcuci'];
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
             <div class="col-lg-6">
            <fieldset>
<legend align="center" style="background-color: #46ff00"><strong>Cuci Hotel</strong></legend> 

	<table id="cucihotel" class="display">
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
				$user_query = mysqli_query($con,"SELECT DATE_FORMAT(tgl_cuci, '%Y/%m/%d') as tgl_cuci,op_cuci,sum(jumlah) as jumlahcuci FROM cuci_hotel WHERE (DATE_FORMAT(tgl_cuci, '%Y-%m-%d') between '$newDate' and '$newDate2') GROUP BY tgl_cuci,op_cuci ORDER BY tgl_cuci DESC" )or die(mysqli_error());
				while($r = mysqli_fetch_array($user_query)){
						

													?>
						 <tr>
							<td><?php echo $r['tgl_cuci'] ?></td>
							<td><?php echo $r['op_cuci'] ?></td>
						
						<td><?php echo $r['jumlahcuci'] ?></td>
						
						</tr>

				<?php } ?>
</tbody>	

		
	</table>

	</fieldset>
</div>
</div>
<div class="row">
                <div class="col-lg-6">
                <fieldset>
<legend align="center" style="background-color: #f0da0f"><strong>Pengering Ritel</strong></legend> 

	<table id="pengeringritel" class="display">
		<thead>
		<tr>
			<th>Tgl Pengering</th>
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
				$user_query = mysqli_query($con,"SELECT DATE_FORMAT(pengering.tgl_pengering, '%Y/%m/%d') as tgl_pengering,pengering.op_pengering as op_pengering ,sum(pengering.jumlah) as jumlahkering,count(pengering.jumlah) as jumlah, reception.jenis as jenis FROM pengering INNER JOIN reception WHERE pengering.no_nota=reception.no_nota and reception.op_pengering <>'' GROUP BY tgl_pengering,jenis,op_pengering ORDER BY tgl_pengering DESC" )or die(mysqli_error());
				while($r = mysqli_fetch_array($user_query)){
						if ($r['jenis']=='k'){
					$tot=$r['jumlah'];
				} else{
					$tot=$r['jumlahkering'];
				}

													?>
						 <tr>
							<td><?php echo $r['tgl_pengering'] ?></td>
							<td><?php echo $r['op_pengering'] ?></td>
							<td><?php echo $tot ?></td>
						<td><?php echo $r['jenis'] ?></td>
						
						</tr>

				<?php } ?>
</tbody>	

		
	</table>

	</fieldset>
                </div>
</div>
	
<div class="row">
                <div class="col-lg-6">
                <fieldset>
<legend align="center"><strong>SETRIKA Ritel</strong></legend> 

	<table id="setrikaritel" class="display">
		<thead>
		<tr>
			<th>Tgl Setrika</th>
			<th>Setrika</th>
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
				$user_query = mysqli_query($con,"SELECT DATE_FORMAT(setrika.tgl_setrika, '%Y/%m/%d') as tgl_setrika,setrika.user_setrika as user_setrika ,count(reception.jumlah) as jumlah,sum(setrika.berat) as beratsetrika, reception.jenis as jenis FROM setrika INNER JOIN reception WHERE setrika.no_nota=reception.no_nota and reception.user_setrika <>'' GROUP BY tgl_setrika,jenis,user_setrika ORDER BY tgl_setrika DESC" )or die(mysqli_error());
				while($r = mysqli_fetch_array($user_query)){
						if ($r['jenis']=='p'){
					$tot=$r['jumlah'];
				} else{
					$tot=$r['beratsetrika'];
				}

													?>
						 <tr>
							<td><?php echo $r['tgl_setrika'] ?></td>
							<td><?php echo $r['user_setrika'] ?></td>
						<td><?php echo $tot ?></td>
						<td><?php echo $r['jenis'] ?></td>
						
						</tr>

				<?php } ?>
</tbody>	

		
	</table>

	</fieldset>
                </div>
                <div class="col-lg-6">
                <fieldset>
<legend align="center"><strong>Setrika Hotel</strong></legend> 

	<table id="setrikahotel" class="display">
		<thead>
		<tr>
			<th>Tgl Setrika</th>
			<th>Setrika</th>
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
				$user_query = mysqli_query($con,"SELECT DATE_FORMAT(tgl_setrika, '%Y/%m/%d') as tgl_setrika,user_setrika,sum(berat) as beratsetrika FROM setrika_hotel GROUP BY DATE_FORMAT(tgl_setrika, '%Y/%m/%d'), user_setrika ORDER BY tgl_setrika DESC" )or die(mysqli_error());
				while($r = mysqli_fetch_array($user_query)){
						

													?>
						 <tr>
							<td><?php echo $r['tgl_setrika'] ?></td>
							<td><?php echo $r['user_setrika'] ?></td>
						
						<td><?php echo $r['beratsetrika'] ?></td>
						
						</tr>

				<?php } ?>
</tbody>	

		
	</table>

	</fieldset>

                </div>
                
                </div>
<fieldset>
<legend align="center"><strong>Setrika </strong></legend> 
	<table id="setrika" class="display">
		<thead>
		<tr>
			<th>Tgl Setrika</th>
			<th>Setrika</th>
			<th>Berat</th>
			<th>jumlah nota</th>
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
			$query = "SELECT DATE_FORMAT(tgl_setrika, '%Y/%m/%d') as tgl_setrika,user_setrika, FORMAT(sum(berat),2) as berat,count(no_nota) as jumlah FROM setrika WHERE (DATE_FORMAT(tgl_setrika, '%Y-%m-%d') between '$newDate' and '$newDate2') group by user_setrika,DATE_FORMAT(tgl_setrika, '%Y%m%d') ORDER BY tgl_setrika DESC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$data[tgl_setrika]</td>
						<td>$data[user_setrika]</td>
						<td>$data[berat]</td>
						<td>$data[jumlah]</td>
						 </tr>";
						}
			?>
		</tbody>
	</table>
	</fieldset>
	
<fieldset>
<legend align="center"><strong>Packing ritel</strong></legend> 
	<table id="packing" class="display">
		<thead>
		<tr>
			<th>Tgl Packing</th>
			<th>Packer</th>
			<th>jumlah nota</th>
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
			$query = "SELECT DATE_FORMAT(tgl_packing, '%Y/%m/%d') as tgl_packing,user_packing,count(no_nota) as jumlah FROM reception WHERE (DATE_FORMAT(tgl_packing, '%Y-%m-%d') between '$newDate' and '$newDate2') group by user_packing,DATE_FORMAT(tgl_packing, '%Y%m%d')" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$data[tgl_packing]</td>
						<td>$data[user_packing]</td>
						<td>$data[jumlah]</td>
						 </tr>";
						}
			?>
		</tbody>
	</table>
	</fieldset>
	
</div>
<div class="container-fluid" style="width:800px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  color:#000000;">

<fieldset>
<legend align="center"><strong>Rincian Cuci ritel</strong></legend> 
<table id="rinciancuci" class="display">
		<thead>
		<tr>
			
			<th>Tgl Cuci</th>
			<th>No Nota</th>
			<th>Operator</th>
			<th>Jumlah</th>
			
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT tgl_cuci,no_nota,op_cuci,jumlah FROM reception WHERE (DATE_FORMAT(tgl_cuci, '%Y-%m-%d') between '$newDate' and '$newDate2') ORDER BY tgl_cuci DESC" ;
			$tampil = mysqli_query($con, $query);
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						
						<td>$data[tgl_cuci]</td>
						<td>$data[no_nota]</td>
						<td>$data[op_cuci]</td>
						<td>$data[jumlah]</td>
					
						
						 </tr>";
		
			}
			?>
		</tbody>
	</table>



</fieldset>


<fieldset>

<legend align="center"><strong>Rincian Pengering ritel</strong></legend> 
	<table id="rincianpengering" class="display">
		<thead>
		<tr>
		
			<th>Tgl Pengering</th>
			<th>No Nota</th>
			<th>Operator</th>
			<th>Jumlah</th>
			
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT tgl_pengering,no_nota,op_pengering,jumlah FROM reception WHERE (DATE_FORMAT(tgl_pengering, '%Y-%m-%d') between '$newDate' and '$newDate2') ORDER BY tgl_PENGERING DESC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						
						<td>$data[tgl_pengering]</td>
						<td>$data[no_nota]</td>
						<td>$data[op_pengering]</td>
						<td>$data[jumlah]</td>
						
						 </tr>";
		
			}
			?>
		</tbody>
	</table>
	</fieldset>
	<fieldset>

<legend align="center"><strong>Detail Setrika</strong></legend>
<div id="konfirm-box"> Apakah Anda yakin akan menghapus ini?</div> 
	<table id="rinciansetrika" class="display">
		<thead>
		<tr>
			
			<th>Tgl Setrika</th>
			
			<th>No Nota</th>
			<th>Setrika</th>
			<th>Berat</th>
			<th >Hapus</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM setrika WHERE (DATE_FORMAT(tgl_setrika, '%Y-%m-%d') between '$newDate' and '$newDate2') ORDER BY tgl_setrika DESC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){?>
				
					<tr id="<?php echo $data['id'];?>" >
					<td><?php echo $data['tgl_setrika'];?></td>
					
					<td><?php echo $data['no_nota'];?></td>
					<td><?php echo $data['user_setrika'];?></td>
					<td><?php echo $data['berat'];?></td>
					<td >
    <a class="hapus" id="<?php echo $data['id'];?>" style="cursor: pointer;">hapus</a>
      </td>
				</tr>
			
				<?php } 
 ?>
		</tbody>
	</table>
	
	</fieldset>

<fieldset>
<legend align="center"><strong>Detail Packing ritel</strong></legend> 
	<table id="rincianpacking" class="display">
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
			$query = "SELECT tgl_packing,no_nota,user_packing,jumlah FROM reception WHERE (DATE_FORMAT(tgl_packing, '%Y-%m-%d') between '$newDate' and '$newDate2') ORDER BY tgl_packing DESC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						
						<td>$data[tgl_packing]</td>
						<td>$data[no_nota]</td>
						<td>$data[user_packing]</td>
						<td>$data[jumlah]</td>
						
						 </tr>";
			
			}
			?>
		</tbody>
	</table>
	</fieldset>





</div>
</body>
<script type="text/javascript">
		$(document).ready(function(){
			$('#cuciritel').dataTable({
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
	   
	    {column_number : 1}
	    
	    ]);
	        
	   
			$('#pengeringritel').dataTable({
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
				"iDisplayLength": 5
				

				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy/mm/dd"
	    },
	   
	    {column_number : 1}
	    
	    ]);
	   $('#setrikaritel').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3],
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
	     $('#setrikahotel').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3],
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
	        
	    	$('#packing').dataTable({
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
	   
	    {column_number : 1}
	    
	    ]);    
	   
	  $('#rinciancuci').dataTable({
	  			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
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
	   
	    {column_number : 2}
	    
	    ]);
		
		
		$('#rincianpengering').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
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
	   
	    {column_number : 2}
	    
	    ]);
			$('#rinciansetrika').dataTable({
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
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
	   
	    {column_number : 2}
	    
	    ]);
			$('#rincianpacking').dataTable({
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
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
	   
	    {column_number : 2}
	    
	    ]);
			
		 
			$('#cucihotel').dataTable({
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
	   
	    {column_number : 1}

	    
	    ]); 
	   
						
		});
	</script>
