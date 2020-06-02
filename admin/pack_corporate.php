<?php
include 'head.php';
include '../config.php';

$tgl = $_POST['tgl'];
	$date = new DateTime($tgl);
	$newDate = $date->format('Y/m/d');
$tgl2 = $_POST['tgl2'];
	$date2 = new DateTime($tgl2);
	$newDate2 = $date2->format('Y/m/d');


?>	

<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#pack td a.delete').click(function()
		{
			if (confirm("Yakin Anda ingin menghapus ini?"))
			{
				var id = $(this).parent().parent().attr('id');
				var data = 'id=' + id ;
				var parent = $(this).parent().parent();

				$.ajax(
				{
					   type: "POST",
					   url: "act/d_pack_corp.php",
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
	});
	
</script>

<div class="row">
   <div class="col-lg-12">
        <div class="panel panel-succes">
            <div class="panel-body">			
				<div class="col-lg-12 col-md-offset-0">
					<div class="panel panel-primary">
						<div class="panel-heading">Packing Corporate</div>
							<div class="panel-body">							
								<div class="table-responsive">
									<table class="table table-condensed table-stripped table-bordered" id="pack">
										<thead>
											<tr>
												<th>Tanggal Masuk</th>
												<th>Nama Hotel</th>
												<th>Packed By</th>
												<th>Nomor Packing</th>
												<th style="text-align:right">Jumlah Item</th>
												<th></th>												
											</tr>
										</thead>
										
										<tbody>
										
										<?php
														$q1 = mysqli_query($con, "select * from corp_hotel_table");
														while($rq1 = mysqli_fetch_array($q1)){
														$opr = mysqli_query($con, "select * from corp_user");													
														while ($ropr = mysqli_fetch_array($opr)){
																
																
												$ord = mysqli_query($con, "select DATE_FORMAT(created, '%Y/%m/%d') as tgl,packing_number,id,id_hotel,creator_id from corp_packing_list where (DATE_FORMAT(created, '%Y/%m/%d') between '$newDate' and '$newDate2') and id_hotel='$rq1[id]' and creator_id='$ropr[id]' group by created,id_hotel");							
												$rord = mysqli_num_rows($ord);
												if ($rord>0){										
												while($nord = mysqli_fetch_array($ord)){
												$hotel = $rq1['name'];
												$user = $ropr['username'];
												$tanggal =$nord['tgl'];
												$numb = $nord['packing_number'];																					
												
											?>
											 <tr  id="<?php echo $nord['id'] ; ?>">
												<td><?php echo $tanggal;?></td>
												<td><?php echo $hotel;?></td>										
												<td><?php echo $user;?></td>
												<td><?php echo $numb;?></td>
												<td style="text-align:right"><?php 
												$jitem = mysqli_fetch_array(mysqli_query($con, "select sum(quantity) as jumlah from corp_packing_item where id_packing_list='$nord[id]' "));										
												echo $jitem['jumlah'];?></td>
												<td style="text-align:right">
												<a href="#" class="delete" style="color:#FF0000;"><img alt="" align="absmiddle" border="0"  />Delete</a>
												</td>
										
											</tr>
											<?php
																
															}
														
														}
														}
														}
														
														
												
												?>
															
										</tbody>
									</table>
								</div>
							</div>
						<div class="panel-footer"></em><i>&copy; corp.qnclaundry.com</i></em></div>
					</div>
				</div>					
		</div>
		
				 
			
						
<script type="text/javascript">
$(document).ready(function(){
			$('#pack').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4],
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
            $( api.column( 4 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },	
        		"aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 15}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy/mm/dd"
	    },
	   
	    {column_number : 1},	    {column_number : 2}

	    
	    ]); 
		
		

		});
	</script>
		