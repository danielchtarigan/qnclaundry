<?php
include 'head.php';
include '../config.php';

$tgl = $_POST['tgl'];
	$date = new DateTime($tgl);
	$newDate = $date->format('Y-m-d');
$tgl2 = $_POST['tgl2'];
	$date2 = new DateTime($tgl2);
	$newDate2 = $date2->format('Y-m-d');


?>	

<div class="container" style="width:auto; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin: -10px -15px; padding-top:20px; color:#000000;">
<div class="col-lg-12 col-md-offset-0">
					    <legend align="center">Tagihan/Order Piutang</legend>
							 <div class="table-responsive" style="overflow-x:auto;">								
								<div class="table-responsive">
									<table class="table table-bordered table-hover table-condensed table-stripped" id="tagihan">
										<thead>
											<tr>
												<th>Tanggal Masuk</th>												
												<th>Nama Customer</th>
												<th>Alamat</th>
												<th>Keterangan</th>
												<th>Nota Order</th>												
												<th style="text-align:right">Total Harga</th>
												<th>Order Oleh</th>
												<th>Outlet</th>
												<th>Pilih Cetak</th>
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
														
														
																
												$qtgh = mysqli_query($con, "SELECT DATE_FORMAT(tgl_input, '%Y-%m-%d') as date,id_customer,no_nota,no_faktur,total_bayar,nama_reception,nama_outlet,nama_customer,ket FROM reception WHERE (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') and lunas=0 and nama_outlet<>'mojokerto'");																	
												while($ntgh = mysqli_fetch_array($qtgh)){
													
													
												
											?>
											 <tr class="odd gradeX">
												<td><?php echo $ntgh['date'];?></td>
												<td><?php echo $ntgh['nama_customer'];?></td>
												<td><?php 
													$qcust = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM customer WHERE id='$ntgh[id_customer]'"));
													echo $qcust['alamat'];?></td>
												<td><?php echo $ntgh['ket'];?></td>	
												<td><?php echo $ntgh['no_nota'];?></td>								
												<td style="text-align:right"><?php echo $ntgh['total_bayar'];?></td>
												<td><?php echo $ntgh['nama_reception'];?></td>
												<td><?php echo $ntgh['nama_outlet'];?></td>
												<td>												
													<a href="struk/struk.php?no_nota=<?php echo $ntgh['no_nota']; ?>" target="_blank">cetak
												</td>
										
											</tr>
											<?php											
															
														
														}
																										
														
												
												?>
															
										</tbody>
									</table>
								</div>
								
								

							</div>						
					</div>
</div>	

			
						
<script type="text/javascript">
$(document).ready(function(){
			$('#tagihan').dataTable({
			"bJQueryUI" : true,
			"sPaginationType" : "full_numbers",
			"iDisplayLength": 10,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5,6,7],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "20%", "targets": [2] },{ "width": "10%", "targets": 1 },{ "width": "5%", "targets": 7 }
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
	   
	    {column_number : 5},	    {column_number : 6}

	    
	    ]); 
		
		

		});
	</script>
	</div>
		